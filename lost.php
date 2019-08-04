<?php
require '@/config.php';
require '@/init.php';
if ($user -> LoggedIn())
{
header('Location: index.php');
}
?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
		<script>
		function login()
		{
		var username=$('#username').val();
		var mail=$('#mail').val();
		var scode=$('#scode').val();
		document.getElementById("logindiv").style.display="none";
		document.getElementById("loginimage").style.display="inline";
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("logindiv").innerHTML=xmlhttp.responseText;
			document.getElementById("loginimage").style.display="none";
			document.getElementById("logindiv").style.display="inline";
			if (xmlhttp.responseText.search("Redirecting") != -1)
			{
			setInterval(function(){window.location="index.php"},3000);
			}
			}
		  }
		xmlhttp.open("POST","ajax/login.php?type=lost",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("username=" + username + "&mail=" + mail + "&scode=" + scode);
		}
		</script>
        <meta charset="utf-8">

        <title><?php echo htmlspecialchars($sitename); ?> - 密码提醒</title>
        <meta name="author" content="StrikeREAD">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.png">
        <link rel="apple-touch-icon" href="img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="img/icon180.png" sizes="180x180">
        <link rel="stylesheet" href="css/bootstrap.min.css">
	   <link rel="stylesheet" href="css/plugins.css">
	   <link rel="stylesheet" href="css/main.css">
	   <link rel="stylesheet" href="css/themes.css">
	   <link rel="stylesheet" href="css/themes/amethyst.css" id="theme-link">
		<script src="js/vendor/modernizr-2.8.1.min.js"></script>
	    <script src="/ajax/js/jquery.min.js"></script>
	   <style type="text/css">.jqstooltip { width: auto !important; height: auto !important; position: absolute;left: 0px;top: 0px;visibility: hidden;background: #000000;color: white;font-size: 11px;text-align: left;white-space: nowrap;padding: 5px;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
</head>
<body>
<img src="/img/dedicated-servers.jpg" alt="Full Background" class="full-bg animation-pulseSlow"></img>
<div id="login-container">
<h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
<i class="fa fa-history"></i> <strong>密码提醒</strong>
</h1>
<div id="logindiv" style="display:none"></div>
<div class="block animation-fadeInQuickInv">
<div class="block-title">
<div class="block-options pull-right">
<a href="login.php" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="登录"><i class="fa fa-user"></i></a>
</div>
<h2>密码提醒<img id="loginimage" src="img/jquery.easytree/loading.gif" style="display:none"/></h2>
<p>
    <span style="font-size: 14px; color: rgb(255, 0, 0);">注意:先点确定后.按提示点密码找回页</span>
</p>
</div>
<div class="form-horizontal">
<div class="form-group">
<div class="col-xs-12">
<input type="text" id="username" class="form-control" placeholder="您的用户名..">
</div>
</div>
<div class="form-group">
<div class="col-xs-12">
<input type="mail" id="mail" class="form-control" placeholder="您的邮箱..">
</div>
</div>
<div class="form-group">
<div class="col-xs-12">
<input type="text" id="scode" class="form-control" placeholder="您的私密代码">
</div>
</div>
<div class="form-group form-actions">
<div class="col-xs-12 text-center">
<button onclick="window.open('/lpass.php','','');" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-clipboard"></i>密码找回页</button>
<button type="button" onclick="login()" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i>确定</button>
</div>
</div>
</div>
</div>
<footer class="text-muted text-center animation-pullUp">
<small><span id="year-copy"></span> &copy; <a href="<?php echo htmlspecialchars($sitename); ?>" target="_blank"><?php echo htmlspecialchars($sitename); ?></a></small>
</footer>
</div>
<script src="js/vendor/jquery-2.1.4.min.js"></script>
<script src="js/vendor/bootstrap.min-2.4.js"></script>
<script src="js/plugins.js"></script>
<script src="js/app.js"></script><script src="js/pages/readyLogin.js"></script>
</body>
</html>