<?php

require 'weixin_api.php';


define('TOKEN','wxdraw');
$echostr = $_GET['echostr'];


$appId='wxa85616e0b605a739';
$appsecret='2c90af3f16602db626aef0a396386f11';
//实例化
$wx=new WeiXin($appId,$appsecret);

if(isset($_GET['echostr'])) {
	$wx->valid();

}else{
	$wx->responseMsg();
}
?>

