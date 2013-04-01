<?php
 session_start();
 if (isset($_SESSION['admin_id'])){
	header('Location: home.php');
	exit;
 } 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 
<!-- Website Title --> 
<title>HERTZ WEB ADMIN</title>

<!-- Meta data for SEO -->
<meta name="description" content=""/>
<meta name="keywords" content=""/>

<!-- Template stylesheet -->
<link rel="stylesheet" href="css/screen.css" type="text/css" media="all"/>
<link href="css/datepicker.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="css/tipsy.css" type="text/css" media="all"/>
<link rel="stylesheet" href="js/jwysiwyg/jquery.wysiwyg.css" type="text/css" media="all"/>
<link href="js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.0.css" media="screen"/>

<!--[if IE 7]>
	<link href="css/ie7.css" rel="stylesheet" type="text/css" media="all">
<![endif]-->

<!--[if IE]>
	<script type="text/javascript" src="js/excanvas.js"></script>
<![endif]-->

<!-- Jquery and plugins -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.img.preload.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.0.js"></script>
<script type="text/javascript" src="js/jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/hint.js"></script>
<script type="text/javascript" src="js/visualize/jquery.visualize.js"></script>
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/browser.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

</head>
<body class="login">
	
	<!-- Begin control panel wrapper -->
	<div id="wrapper">
	
		<div id="login_top">
			<img src="images/logo.png" alt=""/>
		</div>
		
		<br class="clear"/><br/>
	
		<!-- Begin one column box -->
			<div class="onecolumn" style="width:340px;margin:auto">
				
				<div class="header">
				
					<h2>Login</h2>
					
				</div>
			<div class="content">
				<?

if(isset($_REQUEST['error']))
{
?>
<div class="alert_error" style="text-align:center">
<p>
<img src="images/icon_error.png" alt="delete" class="middle"/>
You are not a subscribed user or invalid password.
</p>
</div>
<?
}
?>
	
					<div id="login_info" class="alert_info" style="margin:auto;padding:auto;">
						<p>
							<img src="images/icon_info.png" alt="success" class="middle"/>
						Just click to Login</p>
					</div>
					
					<br class="clear"/>
				
					<form action="submit.php" method="post" id="form_login" name="form_login">
						<p>
							<input type="text" id="uname" name="uname" style="width:285px" title="Username"/>
					  </p>
						<br/>
						<p>
							<input type="password" id="pass" name="pass" style="width:285px" title="******"/>
					  </p>
						<p style="margin-top:30px">
							<input type="submit" class="button_dark" value="Signin"/>	
						</p>
					</form>
				
				</div>
				
			</div>
	
	</div>
	<!-- End control panel wrapper -->
	
</body>
</html>