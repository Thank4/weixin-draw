<?php
//接受ajax 处理添加数据库中

$mysql=new SaeMysql();

session_start();

if($_GET['num']&&!isset($_SESSION['votename'])){

	//当第一次接收到节目编号和用户名，存入session,执行投票
	$_SESSION['votename']=$_GET['username'];
	$num=$_GET['num'];
	$add="UPDATE uservote SET ballot = (ballot +1) WHERE num={$num}";
	$mysql->runSql($add);
	if( $mysql->errno() != 0 )
	{
		die( "Error:" . $mysql->errmsg() );
	}
	$mysql->closeDb();
	echo '投票成功！';




}elseif ($_GET['num']&&isset($_SESSION['votename'])){
	echo '您已经投过票了!';
}else{
	exit('ERROE:拒绝访问');
}
