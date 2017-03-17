<?php


require_once 'Draw.class.php';
$token=md5('draw');

if($_POST['token']==$token){

	$mysql=new SaeMysql();
	$sqlDelete="TRUNCATE  TABLE `app_wxdraw`.`userdraw`;";
	$sql = "\n"
		. "\n"
		. "INSERT INTO `app_wxdraw`.`userdraw` SELECT * FROM `app_wxdraw`.`userinfo`;";
	$mysql->runSql($sqlDelete);
	$mysql->runSql($sql);
	if($mysql->errno() != 0 )
	{
		die( "Error:" . $mysql->errmsg());
	}
	$mysql->closeDb();
}else{
	exit('ERROR:非法访问');
}













