<?php


function https_request($url,$data=null){

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

$mysql=new SaeMysql();
$sql="select num,ballot from uservote ";
$data=$mysql->getData($sql);
$mysql->closeDb();
$channel = new SaeChannel();


$channel->sendMessage("hello", json_encode($data));	//向hello这个Channel发送消息








