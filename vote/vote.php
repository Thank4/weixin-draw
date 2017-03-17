<?php


require_once '../weixin_api.php';
$appId='wxa85616e0b605a739';
$appsecret='2c90af3f16602db626aef0a396386f11';

//实例化
$wx=new WeiXin($appId,$appsecret);
$redirect_uri="http://gala.jinsz.net//vote/vote.php";
$result=$wx->snsapi_userinfo($redirect_uri);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>太湖国际微盘年会投票</title>
	<!-- meta使用viewport以确保页面可自由缩放 -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 引入 jQuery Mobile 样式 -->
	<link rel="stylesheet" href="http://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<!-- 引入 jQuery 库 -->
	<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
	<!-- 引入 jQuery Mobile 库 -->
	<script src="http://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

</head>
<body>
<div data-role="page">
	<div data-role="header">
		<h1>表演节目投票</h1>
	</div>

	<div data-role="main" class="ui-content">
		<div class="center">欢迎您，<span class="username"><?php echo $_SESSION['username'] ?></span>!<img class="userimg" src="<?php echo $_SESSION['headimgurl']?>" width="40" height="40" style="display: none">
		</div>
		<fieldset data-role="controlgroup">
			<legend>请选择您的选项：</legend>
			<label for="01">节目01(第八套广播体操)</label>
			<input type="radio" name="gender" checked id="01" value="01">
			<label for="02">节目02(小品: 甄嬛后传)</label>
			<input type="radio" name="gender" id="02" value="02">
			<label for="03">节目03(舞蹈：爵士串烧)</label>
			<input type="radio" name="gender" id="03" value="03">
			<label for="04">节目04(独唱 恋人心)</label>
			<input type="radio" name="gender" id="04" value="04">
			<label for="05">节目05(小品：赤壁)</label>
			<input type="radio" name="gender" id="05" value="05">
			<label for="06">节目06(舞曲 青花瓷)</label>
			<input type="radio" name="gender" id="06" value="06">
			<label for="07">节目07(舞蹈:咋了爸爸)</label>
			<input type="radio" name="gender" id="07" value="07">
			<label for="08">节目08(苏州评弹 唐僧遇妖)</label>
			<input type="radio" name="gender" id="08" value="08">
			<label for="09">节目09(小品：腊月奇迹)</label>
			<input type="radio" name="gender" id="09" value="09">
			<label for="10">节目10(独唱 遥远的她)</label>
			<input type="radio" name="gender" id="10" value="10">
			<label for="11">节目11(小品：碰瓷)</label>
			<input type="radio" name="gender" id="11" value="11">
			<label for="12">节目12(舞蹈:Till The World Ends(直到世界的尽头))</label>
			<input type="radio" name="gender" id="12" value="12">
			<label for="13">节目13(话剧：礼轻礼重)</label>
			<input type="radio" name="gender" id="13" value="13">
			<label for="14">节目14(大合唱(感恩的心))</label>
			<input type="radio" name="gender" id="14" value="14">
		</fieldset>
		<span>tips:每人仅有一次投票机会，请选择好在投票！</span>
		<input type="button" id="voteBtn" value="投票" >


	</div>

	<div data-role="popup" id="myPopup" data-position-to="window" class="ui-content">
		<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">关闭</a>
		<p id="alertContent"></p>
	</div>

</div>
<script>
	$("#voteBtn").on("tap",function(){
		var val=$("input[type='radio']:checked").val();
		var userimg=$(".userimg").attr("src");
        $.ajax({
			type:'GET',
			url:'boallot.php',
			data:{
				num:val,
				username:userimg
			},
			success:function(response,status,xhr){
				alert(response);
			}
		});

	})
</script>

</body>
</html>
