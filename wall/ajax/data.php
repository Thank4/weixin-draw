<?php

require_once '../functions.php';
$mysql=new SaeMysql();
$sql="SELECT * FROM userinfo ORDER BY subscribe_time DESC ";
$data=$mysql->getData($sql);
$str="";
$arr=array();
function getCity(){
    global $city;
    if(!empty($city)){
        return  $city;
    }else{
        return '未知地区';
    }
};

if($data){
    foreach ($data as $v){
        @$city=$v['city'];
        $result=getCity();
        $str.="<li>";
        $str.="<div class=\"useinfo\"><img class=\"layui-circle\"  src= " . $v['headimgurl'].' '.'width="70" height="70"'.'>';
        $str.='<p class="w_name"  href="#">'. $v['nickname'].'</p></div>';
        $str.='<span  class="w_city">'.'来自:'.$result.'</span>';
        $str.='<span class="w_time">'. timespan($v['subscribe_time'],time()).'前加入</span><hr class="hr1">';
        $str.="</li>";
    }

    echo $str.'-*#'.count($data);
}

