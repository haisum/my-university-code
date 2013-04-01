<?php
    require 'config/config.php';
	require 'includes/secureNoLogin.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>
   
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

   <title>Wedding Price</title>

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
			
	<h1 class="pageTitle"><a href="#"><span class='loginTitle'>Forgot Password</span></a></h1>
	<br style="clear: both;">
        <div class="left-half">
          <h2>New to WeddingPrice?</h2>
          <p>WeddingPrice is an intelligent system that saves you time and money by immediately matching your job request to the right service provider. We give customers the power to choose from the quotes provided and help businesses to find more work. </p>
		<form action="<?php echo URL;?>/login.php" method='post' id="register-login-form">
		<input type="text" name="email_reg" id="email_reg" class='registerTxt' value="Your Email Address" onfocus="if(this.value=='Your Email Address'){this.value='';}"
				onblur="if(this.value==''){this.value='Your Email Address';}"
		/>
		
         <input type="submit" class="button" value="Register Now!" id="register-now"/>
		 </form>

		</div>
  <div class="right-half">
  <?php
  if(isset($_POST['email_reset'])){
	require 'classes/database/objects/class.database.php';
	require 'classes/database/objects/class.user.php';
	//require 'classes/Cipher.php';
	$email = htmlentities($_POST['email_reset']);
	$user = new User();
	$userList = $user->GetList(array(array('email' , '=', $email)), '', true, '1');
	if($userList[0]->email == $email){
		require 'classes/Random.php';	
		$key = Random::getRandom(20);
		//$cipher = new Cipher($key);
		$userList[0]->forgotPassword = $key;
		$userList[0]->Save();
		require 'classes/database/objects/class.emailtemplate.php';
		require 'classes/Mail.php';
		$mailer = new Mail();
		$mailer->sendPasswordResetMail($email, base64_encode($key));
		echo "<div class='message'>Check your email address for details.</div>";
	}
	else{
		echo "<div class='message'>An error occured while trying to reset your password</div>";
	}
  }
  ?>
	<div id="login-form" class="login">
          <form method="post" action="<?php echo URL;?>/forgot-password.php" id="forgot-pass-form">
            <strong>Reset Password</strong>
                        
			<p>If you have misplaced your login details, please enter your email address below that is linked to your account. An email will be sent immediately which will allow you to reset your password.
            </p>

            <label>Email Address:</label>
			<input type="text" name="email_reset" id="email_reset" class="validate[required,custom[email]]">
				<div class="button-box"><!-- required for chrome -->
		            <input type="submit" id="resetBtn"	class="btn" value="Reset My Password"/>
		        </div>
          </form>
          <br class="clear">
        </div>
        
        <div class="clear"></div>
        <br><div style="height: 20px;">&nbsp;</div>
        <div class="clear"></div>
        	

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

