<?php

require_once '../weixin_api.php';

$appId='wxce300ad82db464c2';
$appsecret='f8b3035d0492309f1d1d52270209955d';

$wx=new WeiXin($appId,$appsecret);

$td=$wx->getAccessToken();



$post='{
        "button":[
        {
        "type":"view",
        "name":"太湖国际微盘",
        "url":"http://jinsz.net"
        }
        ]
          }';


$result=$wx->menu_create($post);
print_r($result);
