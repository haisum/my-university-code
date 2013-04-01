<?php
    require_once 'config/config.php';	
	require 'includes/secureNoLogin.php';	
	require_once  'classes/Random.php';
	require_once 'classes/database/objects/class.database.php';
	require_once 'classes/database/objects/class.user.php';
	$loginError = null;
	if(isset($_POST['email_login'])){		
		$user = new User();
		$userList = $user->GetList(array(array('email' , '=', $_POST['email_login']), array('deleted', '=', 'No')), '', true, 1);
		if($userList[0]->password == sha1($_POST['password'])){
			$_SESSION['userId'] = $userList[0]->userId;
			$_SESSION['isActive'] = $userList[0]->isActive;
			$_SESSION['type'] = $userList[0]->type;
			$userList[0]->lastLogin = strftime("%y-%m-%d %H:%M:%S");
			if($userList[0]->type == 'Supplier'){
				require_once 'classes/database/objects/class.supplier.php';
				$supplierObj = new Supplier();
				$supplierList = $supplierObj->GetList(array(
						array('userid' , '=', $userList[0]->userId)
				), '', true, 1);
				$_SESSION['supplierId'] = $supplierList[0]->supplierId;
				$_SESSION['sAccountType'] = $supplierList[0]->accountType;
			}
			else if($userList[0]->type == 'Buyer'){
				require_once 'classes/database/objects/class.buyer.php';
				$buyerObj = new Buyer();
				$buyerList = $buyerObj->GetList(array(
						array('userid' , '=', $userList[0]->userId)
				), '', true, 1);
				$_SESSION['buyerId'] = $buyerList[0]->buyerId;
			}
			$userList[0]->Save();
			$url = $_SESSION['page'] != '' ? $_SESSION['page'] : URL . '/account.php';	
			$_SESSION['page'] = '';
			if (headers_sent()) {
				 echo "<script type='text/javascript'>document.location.href='". $url ."';</script>"; }
			else {
				header("Location: " . $url);
			}
			exit();
		}
		else{
			$loginError = "Incorrect Email/Password combination. If you forgot your password you may use <a style='color: #0486C9;' href='" . URL ."/forgot-password.php'>Forgot Password</a> page to reset it.";
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
			
	<h1 class="pageTitle"><a href="#"><span class='loginTitle'>Login</span></a></h1>
	<br style="clear: both;">
        <div class="left-half">
          <h2>New to WeddingPrice?</h2>
          <p>WeddingPrice is an intelligent system that saves you time and money by immediately matching your job request to the right service provider. We give customers the power to choose from the quotes provided and help businesses to find more work. </p>
		<form action="<?php echo URL;?>/login.php" method='post' id="reg-form">
		<input type="text" name="email_reg" id="email_reg" class='text registerTxt' value="Your Email Address" onfocus="if(this.value=='Your Email Address'){this.value='';}"
				onblur="if(this.value==''){this.value='Your Email Address';}"
		/>
		
         <input type="submit" class="button" value="Register Now!" id="register-now"/>
		 </form>
	<?php	 
		 if(isset($_POST['email_reg'])){
	require_once 'classes/Validator.php';
	$validate = new Validator();
	$email = $_POST['email_reg'];
	$error = null;
	if(!$validate->isValidEmail($email)){
		$error .= "<br/>-Invalid Email Id";
	}
	if($email == ""){
		$error .= "<br/>-Email Can't be empty";
	}	
	$user = new User();
	$userList = $user->GetList(array(array('email', '=' , $email)), '', true, 1);
	if(count($userList)>0){
		$error .= "<br/>-Email already Registered. <a href='" . URL . "/forgot-password.php' style='color:#000;text-decoration:underlinel'>Forgot Password?</a>";
	}
	if($error != null){
?>
	<div class="error_message reg_error">Following Errors Occured while performing registration process:
	<?php echo $error; ?>
	</div>
<?php	
	}
	else{	
			$password = Random::getRandom(14);
			$to      = htmlentities($email);
			$linkUrl = URL . '/login.php';
			try{				
				$user = new User();
				require_once 'classes/database/objects/class.emailtemplate.php';
				require 'classes/Mail.php';	
				$emailObj = new Mail();
				$emailObj->sendRegisterationEmail($password, $linkUrl, $to);
				echo "<div class='message'>An Email containing your password has been sent to you on <strong style='color:#000;'>{$email}</strong>. You may use it to login and complete registeration process.</div>";
				$user->email = $email;
				$user->isActive = 'No';
				$user->type = 'Normal';
				$user->lastLogin = strftime("%y-%m-%d %H:%M:%S");
				$user->registrationDate = strftime("%y-%m-%d %H:%M:%S");
				$user->password = sha1($password);
				$user->Save();
			}
			catch(Exception $e){
				echo "<div class='error_message reg_error'>An error occured while sending mail. Message: {$e->getMessage()}</div>";
			}
	}
}
?>
		</div>
        <div class="right-half">
		<?php 
if($loginError!=null){
	echo "<div class='error_message'>{$loginError}</div>";
}
?>
        <div class="login">
          <form method="post" action="<?php echo URL;?>/login.php" id="login-form">
		  <input type="hidden" name="a" value="login">
          <input type="hidden" name="return" value="#">       
		  <div class="error"> 
				<strong>Please login to continue.</strong>
          </div>
		<p class="username">
			<label for="email">Email:</label>
			<input type="text" name="email_login" id="email_login" class="text validate[required,custom[email]]">
		</p>
		<p class="password-section">
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" class="text validate[required,minSize[6],maxSize[20]]">
		</p>
		<div class="wraps">
			<ul class="login-links">
				<li><a href="<?php echo URL;?>/forgot-password.php">Forgot Password?</a></li>
				<!--<li>Remember me <input style='float:none;width:auto;padding:0;margin:0;border:none;clear:none;' type='checkbox' name='remember'/></li>-->
			</ul>
			<div class="button-box"><!-- required for chrome -->
				<input type="submit" class="btn" id="loginButton" value="Login"/>
			</div>
		</div>
	  </form>
          <br class="clear">
          <br>
                          </div>
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

