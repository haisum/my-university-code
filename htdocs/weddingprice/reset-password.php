<?php
    require_once 'config/config.php';
	require 'includes/secureNoLogin.php';
	require 'classes/database/objects/class.database.php';
	require 'classes/database/objects/class.user.php';
	if(!isset($_GET['ticket'],$_GET['email'])){
		echo "<script type='text/javascript'>window.location.href='" . URL . "/page-not-found.php'</script>";
		exit();
	}	
	$ticket = $_GET['ticket'];	
	$email = $_GET['email'];
	$user = new User();
	$error = null;
	$userList = $user->GetList(array(array('email' , '=', $email)));
	if(count($userList)!=1){
		echo "<script type='text/javascript'>window.location.href='" . URL . "/page-not-found.php'</script>";
		exit();
	}	
	//$cipher = new Cipher($userList[0]->forgotPassword);
	if(!(base64_decode($ticket) == $userList[0]->forgotPassword)){
		echo "<script type='text/javascript'>window.location.href='" . URL . "/page-not-found.php'</script>";
		exit();
	}
	if(isset($_POST['new_pass'], $_POST['confirm_pass'])){
		if(trim($_POST['new_pass']) == ""){
			$error = "Password field can't be empty";
		}
		else if(strlen($_POST['new_pass']) < 6){
			$error = "Password must be atleast 6 charachter long.";
		}
		else if($_POST['new_pass'] == $_POST['confirm_pass']){
			$userList[0]->forgotPassword = "";
			$userList[0]->isActive = 1;
			$userList[0]->password = sha1($_POST['new_pass']);
			$userList[0]->Save();
		}
		else{
			$error = "Password mismatch";
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>
   
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

   <title>Wedding Price</title>

   <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/login.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/validationEngine.jquery.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/template.css"/>
   <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->

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
			
	<h1 class="pageTitle"><a href="#"><span class='loginTitle'>Reset Password</span></a></h1>
	<br style="clear: both;">
        <div class="left-half">
		<?php if($error!=null && isset($_POST['new_pass'],$_POST['confirm_pass'])){ ?>
			<div class='error_message reg_error'><?php echo "$error";?></div>
		<?php } 
			  else if($error==null && isset($_POST['new_pass'],$_POST['confirm_pass'])){
		?>
			<div class='message'><?php echo "Your password has been reset you may <a href='" . URL . "/login.php'>login</a> now.";?></div>
		<?php 
			}
			else{
		?>
          <div id="login-form" class="login" style="clear:both;">
          <form method="post" action="<?php echo URL;?>/reset-password.php?email=<?php echo $email;?>&ticket=<?php echo $ticket;?>" id="reset-form">
			<label style='padding-top:8px;'>New Password:</label>
			<input type="password" name="new_pass" id="new_pass" value="" class="validate[required,minSize[6],maxSize[20]]">			
			<label style='padding-top:8px;'>Confirm Password:</label>
			<input type="password" name="confirm_pass" id="confirm_pass" value="" class="validate[required,minSize[6],maxSize[20],equals[new_pass]]">
				<div class="button-box"><!-- required for chrome -->
		            <button id="resetBtn" type="submit" class="btn">Reset</button>
		        </div>
          </form>
          <br class="clear">
        </div>    
		<?php } ?>
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

