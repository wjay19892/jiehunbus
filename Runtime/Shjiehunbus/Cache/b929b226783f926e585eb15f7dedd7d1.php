<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo C("sysconfig.site_name");?></title>
<link href="__PUBLIC__/dwz/themes/css/login.css" rel="stylesheet" type="text/css" />
<script src="__PUBLIC__/dwz/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script language="JavaScript">
<!--
function fleshVerify(type){ 
	//重载验证码
	var timenow = new Date().getTime();
	if (type){
		$('#verifyImg').attr("src", '__URL__/verify/adv/1/'+timenow);
	}else{
		$('#verifyImg').attr("src", '__URL__/verify/'+timenow);
	}
}

$(document).ready(function(){
	$('input[name="account"]').focus();
});
//-->
</script>
</head>
<body>
<div id="login">
	<div id="login_header">
		
	</div>
	<div id="login_content">
		<div class="loginForm">
			<form method="post" action="__URL__/checkLogin/">
				<p>
					<label>帐号：</label>
					<input type="text" name="account" style="width:145px;" class="login_input" />
				</p>
				<p>
					<label>密码：</label>
					<input type="password" name="password" style="width:145px;" size="20" class="login_input" />
				</p>
				<p>
					<label>验证码：</label>
					<input class="code" name="verify" type="text" style=" width:50px; *margin-left:3px;" />
					<span><img id="verifyImg" SRC="__URL__/verify/" onClick="fleshVerify()" border="0" alt="点击刷新验证码" style="cursor:pointer;" align="absmiddle"></span>
				</p>
                <div class="jvf_cl"></div>
				<div class="login_bar">
					<input class="sub" type="submit" value=" " />
				</div>
			</form>
		</div>
		<div class="login_banner"><img src="__PUBLIC__/dwz/themes/default/images/login_banner.jpg" /></div>
		<div class="login_main">

		</div>
	</div>
	<div id="login_footer">
		<?php echo C("sysconfig.site_powerby");?>
	</div>
</div>

</body>
</html>