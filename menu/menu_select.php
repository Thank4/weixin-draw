<?php

require_once '../weixin_api.php';

$appId='wxce300ad82db464c2';
$appsecret='f8b3035d0492309f1d1d52270209955d';

$wx=new WeiXin($appId,$appsecret);

$menu=$wx->menu_get();
print_r($menu);