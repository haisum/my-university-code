<?php
    require_once 'config/config.php';
	require_once 'includes/secureLogin.php';
	if($_SESSION['isActive']==1){
		header('Location: ' . URL .'/account.php');
	}
	require 'classes/database/objects/class.database.php';
	require 'classes/database/objects/class.user.php';
	$error = null;
	if(isset($_POST['new_pass'],$_POST['confirm_pass'])){
		if(trim($_POST['new_pass']) == '' || trim($_POST['confirm_pass']) == ''){
			$error = "-Password fields can't be empty.<br/>";
		}
		if($_POST['new_pass'] != $_POST['confirm_pass']){
			$error .= '-Passwords don\'t match.<br/>';
		}
		if(strlen($_POST['new_pass']) < 6){
			$error .= '-Password must atleast contain 6 characters.';
		}		
		if($error == null){
			$userx = new User();
			$userid = intval($_SESSION['userId']);
			$userx = $userx->Get($userid);
			$userx->password = sha1($_POST['new_pass']);
			$userx->isActive = 'Yes';
			$userx->Save();			
			$_SESSION['isActive'] = 'Yes';
		}
	}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>
   
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

   <title>Wedding Price Sample - Change Password</title>

   <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/login.css"/>
   <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->
   <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/validationEngine.jquery.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/template.css"/>

   <!--[if lte IE 7]>

  <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/lteie7.css"/>

  <script defer type="text/javascript" src="<?php echo URL;?>/js/pngfix.js"></script>

  <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>

   <![endif]-->   

    </head>

    <body>
		<?php require_once 'includes/header.php';?>

   <div id="main_navigation_container">

  <div id="main_navigation">


 <div id="navbar">
<?
                    	include('includes/main-navigation.php');
					?>
 </div>

    
  </div>

   </div>

   <div id="background">

  <div class="wrapper login_wrapper">
	 <div class="content">
			
	<h1 class="pageTitle"><a href="#"><span class='loginTitle'>Change Password</span></a></h1>
	<?php if($error!=null && isset($_POST['new_pass'],$_POST['confirm_pass'])){ ?>
			<div style='width:80%;margin:10px auto;' class='error_message reg_error'><?php echo "$error";?></div>
		<?php } 
			  else if($error==null && isset($_POST['new_pass'],$_POST['confirm_pass'])){
		?>
			<div class='message' style='float:left;margin:10px auto;'><?php echo "Your password has been changed you may continue to use site now.";?></div>			
			<script type='text/javascript'>
				window.setTimeOut(function(){
					window.location.href = <?php echo URL . '/register-type.php'; ?>;
				}, 500);
			</script>
		<?php 
			}
	?>
	<br style="clear: both;">
        <div class="left-half">		
		<?php if($_SESSION['isActive']== 'No'){ ?>
			<h2 class='orangeh2'>
				<p class="signup_txt" style="font-weight:normal;margin-left:0px;">It seems like you have logged in for first time. Kindly change your password to continue using site.</p>
			</h2>
		
          <div id="login-form" class="login" style="clear:both;">
          <form method="post" action="<?php echo URL;?>/change-password.php" id="change-pass-form">
			<label style='padding-top:8px;'>New Password:</label>
			<input type="password" name="new_pass" id="new_pass" class="validate[required,minSize[6],maxSize[20]]">			
			<label style='padding-top:8px;'>Confirm Password:</label>
			<input type="password" name="confirm_pass" id="confirm_pass" class="validate[required,minSize[6],maxSize[20],equals[new_pass]]">
				<div class="button-box"><!-- required for chrome -->
		            <button type="submit" id="changePassBtn" class="btn">Change My Password</button>
		        </div>
          </form>
		  <?php }?>
          <br class="clear">
        </div>        
        <div class="clear"></div>
        <br><div style="height: 20px;">&nbsp;</div>
        <div class="clear"></div>

		</div>
  <div class="right-half">       	

</div>
			<br style="clear: both;">
		</div>

 </div>

  </div>

 <?php require 'includes/footer.php'; ?>
<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
   <script src="<?php echo URL;?>/js/jquery.validationEngine-en.min.js" type="text/javascript"></script>
   <script src="<?php echo URL;?>/js/jquery.validationEngine.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>
    </body>

</html>

