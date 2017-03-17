<?php

require_once 'Draw.class.php';

$draw=new Draw();

//获取抽奖人数
$data=$draw->index2();

//传过来的值

if(!$_POST['value']){
	exit("ERROR:拒绝访问！");
}else{
	$num=$_POST['value'];
	$result=$draw->unique($data,$num);               //获取值，并且剔除
	echo json_encode($result);


	//剔除中奖人数;
	for($i=0;$i<$num;$i++){
		$k=$result[$i][1];
		$saeSql=new SaeMysql();
		$sql="DELETE FROM userdraw WHERE openid='{$k}'";
		$saeSql->runSql($sql);
	}

}















/*

*/
