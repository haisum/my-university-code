<?
include("includes/session.php");// database connection details stored here
include("includes/secure.php");
include("lefke/cleanGetPost.php");
$filename2 = str_replace(".php","",basename($_SERVER['SCRIPT_FILENAME']));

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
<style>
div.growlUI { margin-top:100px; background: url(images/check48.png) no-repeat 10px 10px }
div.growlUI h1, div.growlUI h2 {
	
	color: white; padding: 5px 5px 5px 75px; text-align: left;
	font-size:20px;
}
	
	</style>
<!--[if IE 7]>
	<link href="css/ie7.css" rel="stylesheet" type="text/css" media="all">
<![endif]-->

<!--[if IE]>
	<script type="text/javascript" src="js/excanvas.js"></script>
<![endif]-->

<!-- Jquery and plugins -->
<script type="text/javascript" src="js/validation.js"></script>

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
<script type="text/javascript" src="js/jblockui.js"></script>
<?
if(isset($_REQUEST['msg']))
{
	$msg = $_REQUEST['msg'];
?>
<script>
$(document).ready(function() {
       $.growlUI('Notification', 'Password <? echo $msg; ?> successfully!');
 });
</script>
<?
}
?><script>
$(document).ready(function() {
     //  $.growlUI('Growl Notification', 'Have a nice day!');
	$('#change_password').click(function() 
	{
		var error = 0;
		
		if(document.getElementById("pass").value == "")
		{
			error = 1;
		}
		if(document.getElementById("pass2").value == "")
		{
			error = 1;
		}		
		if(document.getElementById("pass").value != document.getElementById("pass2").value)
		{
			error = 2;
		}


		if(error ==1)
		{
			$.blockUI({
				theme:     false,
				title:    'This is your title',
				message:  '<strong><font color=red><p><br>All fields are compulsory.<br><br></p></font</strong>',
				timeout:   2000
			});
			
			return false;
		}
		else if(error ==2)
		{
			$.blockUI({
				theme:     false,
				title:    'This is your title',
				message:  '<strong><font color=red><p><br>New passwords doesnt match.<br><br></p></font</strong>',
				timeout:   2000
			});
			
			return false;
		}
		else
		{
			return true;
		}
	});
});
    
</script>
</head>
<body>
	
	<!-- Begin control panel wrapper -->
	<div id="wrapper">
	
		<!-- Begin top bar -->
		<? include("includes/header.php"); ?>
		<!--End top bar -->
		
		<!-- Begin main menu -->
		<?
		include("includes/menu.php");
		?>
		<!-- End main menu -->
		
		
		<!-- Begin shortcut menu -->
    <?
		include("includes/shortcut.php");
		?>
		<!-- End shortcut menu -->
		
		<br class="clear"/>
		
		<!-- Begin content -->
		<div id="content_wrapper">
		  <ul class="first_level_tab">
				<li>
<a href="" class="active">
						Change Password</a>
</li>
				<li></li>
				<li></li>
			</ul>
            <br class="clear" /><div class="onecolumn">
				
		    <div class="header">
					<div class="description"></div>
					
					<!-- Begin 2nd level tab -->
<ul class="second_level_tab">
						<li></li>
			  </ul>
<!-- End 2nd level tab -->All fields marked with (<strong>*</strong>) are compulsory</div>
				
				<div class="content nomargin">
					
					<!-- Begin example table data -->
					<!-- End example table data -->
					
					
					<!-- Begin pagination -->
					<!-- End pagination -->
					
					<div class="content">
                    <form action="<?=$filename2;?>.pro.php<?php if(isset($_GET['userid'])) echo '?userid=' . intval($_GET['userid']); ?>" method="post">
					  <!-- Begin form elements -->
					  <p>
					    <label>New Password:</label>
					    *<br/>
					    <input type="password" id="pass" name="pass" style="width:97%"/>
				      </p>
					  <br/>
					  <p>
					    <label>Confirm New Password:</label>
				      *                      
				      <input type="password" id="pass2" name="pass2" style="width:97%"/>                      
<br /><br />

					  <input type="submit" id="change_password" class="button_dark" value="Edit Password"/>

					  <!-- End form elements -->
                      
                      </form>
				  </div>
				
			  </div>
				
			</div><!-- Begin one column box -->
			<!-- End one column box -->
			
	  </div>
		<!-- End content -->
		
		<br class="clear"/>
			
		<div id="footer">
			&copy; Copyright <?php echo date("Y") ?> by HERTZ WEB ADMIN All Right Reserved.
		</div>
	
	</div>
	<!-- End control panel wrapper -->
	
</body>
</html>