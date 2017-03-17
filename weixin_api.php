<?php
use sinacloud\sae\Storage as Storage;

// check class
class WeiXin {


	private $appID;
	private $appsecret;

	//构造方法对成员属性进行赋值
	public function __construct($appID="",$appsecret="")
	{
		$this->appID=$appID;
		$this->appsecret=$appsecret;
	}

	//验证判断
	public function valid()
	{
		if ($this->checkSignature()) {
			echo $_GET['echostr'];
		} else {
			echo 'ERROR';
		}
	}

	// check Signature
	public function checkSignature()
	{
		$signature = $_GET['signature'];
		$timestamp = $_GET['timestamp'];
		$nonce = $_GET['nonce'];


		$tmpArr = array(TOKEN, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);

		if ($signature == $tmpStr) {
			return true;
		} else {
			return false;
		}
	}

	//响应消息
	public function responseMsg(){
		//接受xml数据
		$postData=$GLOBALS["HTTP_RAW_POST_DATA"]; //需要设置为全局变量
		$xmlObj=simplexml_load_string($postData,"SimpleXMLElement",LIBXML_NOCDATA);
		$toUserName=$xmlObj->ToUserName;
		$fromUserName=$xmlObj->FromUserName;
		$msgType=$xmlObj->MsgType;


		//根据消息的类型来处理业务
		switch ($msgType){
			case 'event':
				return $this->receiveEvent($xmlObj);
			case 'text':
				echo $this->receiveText($xmlObj);
				break;
			case 'image':
				echo $this->receiveImage($xmlObj);
				break;
			default:
				break;
		}
	}


   //响应事件
	public function receiveEvent($obj){
		switch ($obj->Event){
			case 'subscribe':
				//下发欢迎语
				$replayContent="太湖国际微盘,让你我一起狂欢共渡跨年夜!";
				$replayTextMsg="<xml>
											<ToUserName><![CDATA[%s]]></ToUserName>
											<FromUserName><![CDATA[%s]]></FromUserName>
											<CreateTime>%s</CreateTime>
											<MsgType><![CDATA[text]]></MsgType>
											<Content>".$replayContent."</Content>
											</xml>";
				echo sprintf($replayTextMsg,$obj->FromUserName,$obj->ToUserName,time());

				//请求用户基本信息接口
				$openId=$obj->FromUserName;
				$access_token=$this->getAccessToken();
				$url="https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openId}&lang=zh_CN";
				$userInfo=$this->https_request($url);
				$nickname=$userInfo['nickname'];
				$sex=$userInfo['sex'];
				$city=$userInfo['city'];
				$headimgurl=$userInfo['headimgurl'];
				$subscribe_time = $userInfo['subscribe_time'];
				//save head
				$file=file_get_contents($headimgurl);
				$imgName=$openId.'.jpg';
				$storage=new Storage();//初始化
				$storage->putObject($file,"resource/headimgurl",$imgName);    //存储
				$headimgurl=$storage->getUrl("resource","headimgurl/".$imgName); //读取存储文件地址

				//存储userInfo
				$saeSql=new SaeMysql();
				$sql="INSERT INTO userinfo (openid,nickname,sex,city,headimgurl,subscribe_time) VALUES ('{$openId}','{$nickname}','$sex','{$city}','{$headimgurl}','$subscribe_time')";
				$saeSql->runSql($sql);
				if( $saeSql->errno() != 0 )
				{
					die( "Error:" . $saeSql->errmsg() );
				}

				$saeSql->closeDb();

				break;
			case 'unsubscribe':
				//取消关注事件
				//获取取消关注用户的信息
				$openId=$obj->FromUserName;
				$saeSql=new SaeMysql();
				$sql="DELETE FROM userinfo WHERE openid='{$openId}'";
				$saeSql->runSql($sql);
				if( $saeSql->errno() != 0 )
				{
					die( "Error:" . $saeSql->errmsg() );
				}
				$saeSql->closeDb();

				break;
			case 'CLICK':
				switch ($obj->EventKey){
					case 'MUSIC':
						return $this->replayText($obj,'this is a song');
					break;
				default:
					break;
				}
				break;
			default:
				break;
		}
	}



	//接受文本消息
	public function receiveText($obj){
		$content=trim($obj->Content);     //获取文本消息的内容  ,处理前后空白内容
		switch ($content){
			case '查编号':
				return $this->replayText($obj,'您的唯一编号是:'.md5($obj->FromUserName));
			case '投票':
				return $this->replayText($obj,'投票请<a href="http://gala.jinsz.net/vote/vote.php">点击此链接</a> ');
				break;
			case '单图文':
				return $this->replayNewsMsg($obj);
			    break;
			case '多图文':
				$NewsArr=array(
					array(
						'Title'=>'this is word',
						'Description'=>'这是一段文字描述',
						'picUrl'=>'http://wxdraw.applinzi.com/img/bear.jpg',
						'Url'=>'http://cf.qq.com'
					),
					array(
						'Title'=>'this is text!',
						'Description'=>'这也是一段描述',
						'picUrl'=>'http://wxdraw.applinzi.com/img/bear.jpg',
						'Url'=>'http://cf.qq.com'
					),
					array(
						'Title'=>'this is 444444',
						'Description'=>'这也是一段描述!!!!!',
						'picUrl'=>'http://wxdraw.applinzi.com/img/bear.jpg',
						'Url'=>'http://cf.qq.com'
					)
				);
				return $this->replayNewsMsg($obj,$NewsArr);
			    break;
			default:
				return $this->replayText($obj,$content);
				break;
		}


	}

	//回复文本消息
	public function replayText($obj,$content){
		//回复文本消息内容
		$replayTextMsg="<xml>
							 <ToUserName><![CDATA[%s]]></ToUserName>
							 <FromUserName><![CDATA[%s]]></FromUserName>
							 <CreateTime>%s</CreateTime>
							 <MsgType><![CDATA[text]]></MsgType>
							 <Content><![CDATA[%s]]></Content>；
							 </xml>";
		return sprintf($replayTextMsg,$obj->FromUserName,$obj->ToUserName,time(),$content);
	}



	//接受图片消息
	public function receiveImage($obj){
		$picUrl=$obj->PicUrl;     //获取图片地址
		$mediaId=$obj->MediaId;   //获取图片消息媒体id，可以调用多媒体文件下载接口拉取数据
		$picArr=array('picUrl'=>$picUrl,'mediaId'=>$mediaId);
		return $this->replayImage($obj,$picArr);
		//return $this->replayText($obj,$mediaId);
	}

	//回复图文消息
	public function replayImage($obj,$picArr){

		$replayImageMsg="<xml>
							 <ToUserName><![CDATA[%s]]></ToUserName>
							 <FromUserName><![CDATA[%s]]></FromUserName>
							 <CreateTime>%s</CreateTime>
							 <MsgType><![CDATA[image]]></MsgType>
							 <Image>
							        <MediaId><![CDATA[%s]]></MediaId>
                             </Image>
							 </xml>";
		return sprintf($replayImageMsg,$obj->FromUserName,$obj->ToUserName,time(),$picArr['mediaId']);
	}



	//回复多图文消息
	public function replayNewsMsg($obj,$NewsArr){
		if(is_array($NewsArr)){
			$itemStr='';
		foreach ($NewsArr as $item){
			$itemTpl="<item>
						<Title><![CDATA[%s]]></Title> 
						<Description><![CDATA[%s]]></Description>
						<PicUrl><![CDATA[%s]]></PicUrl>
						<Url><![CDATA[%s]]></Url>
						</item>";
			$itemStr.=sprintf($itemTpl,$item['Title'],$item['Description'],$item['picUrl'],$item['Url']);
		};


		$replayNewsItems="<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[news]]></MsgType>
						<ArticleCount>%s</ArticleCount>
						<Articles>".$itemStr."</Articles>
						</xml>";

		return sprintf($replayNewsItems,$obj->FromUserName,$obj->ToUserName,time(),count($NewsArr));

		}else{
			$replayNews="<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[news]]></MsgType>
						<ArticleCount>1</ArticleCount>
						<Articles>
						<item>
						<Title><![CDATA[%s]]></Title> 
						<Description><![CDATA[%s]]></Description>
						<PicUrl><![CDATA[%s]]></PicUrl>
						<Url><![CDATA[%s]]></Url>
						</item>
						</Articles>
						</xml>";
			$title='hello ,world';
			$description='这是一段描述';
			$picUrl='http://wxdraw.applinzi.com/img/bear.jpg';
			$Url='http://www.jd.cn';
			return sprintf($replayNews,$obj->FromUserName,$obj->ToUserName,time(),$title,$description,$picUrl,$Url);
		}

	}



	//实现https模拟get和post请求
	public function https_request($url,$data=null){

		//初始化curl
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);    //模拟get请求
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); //将页面以为文件流的形式保存


		if(!empty($data)){
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data); //提交post内容
		}

		$output=curl_exec($ch);
		curl_close($ch);
		return json_decode($output,true); //返回数组结果
	}


	//获取access_token
	public function getAccessToken(){

		//首次获取access_token


		$access_token=$this->_memcache_get('access_token');
		if(!$access_token){
			$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appID}&secret={$this->appsecret}";
			$result=$this->https_request($url);
			$this->_memcache_set('access_token',$result['access_token'],7000);
			return $result['access_token'];
		}
		return $access_token;



	}


	//实例化memcache
	public function _memcache_int(){
		//实例化

		$mmc=new Memcache();

		$mmc->connect();           //使用当前应用的memcache

		return $mmc;

	}

	//设置memcache的值
	public function _memcache_set($key,$value,$time=0){

		$mmc=$this->_memcache_int();
		$mmc->set($key,$value,0,$time);
	}

	//获取memcache
	public function _memcache_get($key){

		$mmc=$this->_memcache_int();
		return $mmc->get($key);
	}


	//menu 创建
	public function menu_create($post){
		$access_token=$this->getAccessToken();
		$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
		return $this->https_request($url,$post);
	}

	//menu 查询
	public function menu_get(){
		$access_token=$this->getAccessToken();
		$url="https://api.weixin.qq.com/cgi-bin/menu/get?access_token={$access_token}";
		return $this->https_request($url);

	}

	//menu 删除
	public function menu_delete(){
		$access_token=$this->getAccessToken();
		$url="https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$access_token}";
		return $this->https_request($url);
	}


	//base型授权
	public function snsapi_base($redirect_uri)
	{
		// 1、准备Scope为snsapi_base的网页授权页面URL；
		$redirect_uri = urlencode($redirect_uri);
		$snsapi_base_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appID}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_base&state=123#wechat_redirect";

		// 2、静默授权，获取code；

		// 页面将跳转至 redirect_uri/?code=CODE&state=STATE
		if(!isset($_GET['code']))
		{
			header("Location:{$snsapi_base_url}");
		}

		$code = $_GET['code'];

		// 3、通过code换取网页授权access_token。

		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appID}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code";
		return $this->https_request($url);
	}
	
	
	//userinfo授权
	public function snsapi_userinfo($redirect_uri)
	{

		session_start();
		// 1、准备Scope为snsapi_userinfo的网页授权页面URL；
		$redirect_uri = urlencode($redirect_uri);
		$snsapi_userinfo_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appID}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";

		// 2、用户手动同意授权，获取code；

		// 页面将跳转至 redirect_uri/?code=CODE&state=STATE
		if(!isset($_GET['code']))
		{
			header("Location:{$snsapi_userinfo_url}");
		}

		$code = $_GET['code'];

		// 3、通过code换取网页授权access_token。

		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appID}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code";
		$result = $this->https_request($url);
		$access_token=$result['access_token'];
		$openid=$result['openid'];

		//4、根据上一步获取的access_token和openid拉取用户信息。
		$userinfo_url =  "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
		$userinfo=$this->https_request($userinfo_url);



		//第一次获取信息,存入session
		//$_SESSION['username']=$userinfo['nickname'];
		//$_SESSION['headimgurl']=$userinfo['headimgurl'];

		if(!$userinfo['nickname']){
			//不存在,取出已经存储的session
			$_SESSION['username'];
			$_SESSION['headimgurl'];
			$_SESSION['openid'];
		}else{
			//存在，更新session
			$_SESSION['username']=$userinfo['nickname'];
			$_SESSION['headimgurl']=$userinfo['headimgurl'];
			$_SESSION['openid']=$userinfo['openid'];
		}


	}


}