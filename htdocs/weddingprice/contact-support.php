<?php
require_once 'config/config.php';
require 'includes/securePasswordChange.php';
require_once 'includes/recaptchalib.php';
$notice = isset($_POST['name']) ? $_POST['name'] : "";
$name = isset($_POST['name']) ? $_POST['name'] : "";
$subject = isset($_POST['subject']) ? $_POST['subject'] : "";
$email = isset($_POST['sender_email']) ? $_POST['sender_email'] : "";
$message = isset($_POST['message']) ? $_POST['message'] : "";
$notice = "";
$error = "";
if(isset($_POST['name'],$_POST['sender_email'],$_POST['subject'],$_POST['message'],$_POST['recaptcha_challenge_field'],$_POST['recaptcha_response_field'])){
	$name = htmlentities($_POST['name']);
	$subject = trim(htmlentities($_POST['subject']));
	$email = trim(htmlentities($_POST['sender_email']));
	$message = trim(htmlentities($_POST['message']));
	if($name == "" || $email == "" || $subject == "" || $message == ""){
		$error .= "-Required Fields can't be empty";
	}
	require_once 'classes/Validator.php';
	$validator = new Validator();
	if(!$validator->isValidEmail($email) && $email!=""){
		$error .= "<br/>-Invallid Email";
	}
	if(strlen($message)>1000){
		$error .= "<br/>-Message exceeds maximum charachter limit of 1000";
	}
	$privatekey = "6LcUusYSAAAAANHedbmlAyOEj2xyHR3lesghrR-M";
	$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

	if (!$resp->is_valid) {
		$error .= "<br/>-" . 'Incorrect Captcha Solution';
	}
	if($error == ""){
		require_once 'classes/Mail.php';
		require_once 'classes/database/objects/class.database.php';
		require_once 'classes/database/objects/class.emailtemplate.php';
		$mail = new Mail();
		$mail->sendContactSupportEmail($name, $email, $subject, $message);
		$notice .= "Your support request have been recieved. You will be contacted soon.";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title>Wedding Price</title>

        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/validationEngine.jquery.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/template.css"/>

        <!--[if lt IE 8]>

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

<div class="wrapper">
    <div class="content help_contents">
        <h1 class="pageTitle pageTitleHelp">
<a href="#">
    <span>Customer Support</span>
</a>
        </h1>
        <br style="clear: both;"/>
        <div id="leftCol">
<div class="aside">
    <h2>HELP QUICK LINKS</h2>
    <ul>
         <li><a href="<?php echo  URL;?>/help.php">Help Resources</a></li>
		 <li><a href="<?php echo  URL;?>/faq.php">Frequently Asked Questions</a></li>
		 <li style="background:none;"><strong><a href="<?php echo  URL;?>/contact-support.php">Contact Support</a></strong></li>
    </ul>
</div>
<div class="aside">
    <h2>Question or Concern</h2>
    <p>Contact Customer Support</p>
    <p><a href="<?php echo  URL;?>/contact-support.php" class="support-button">Contact Support</a></p>
</div>
        </div><!--leftCol-->
        <div id="rightCol" class="rightCol">
              	 
			  <h2 class='orangeh2'>How can we help you?</h2>
				
	  		
			<p>Please use the form below if you have a question. Select the subject that best fits your topic. You might want to first check out our <a href="/help/">Frequently Asked Questions</a> section for a quick answer. </p>	  
              <!-- ============= Contact Support =============  -->

              <div id="faq-show" style="display:none">
              	Perhaps one of these FAQs may help answer your question?
              	<br>
              	<div id="questions">
                </div>
			  </div>
				<div id="contact-support">
				<?php
					if($notice != ""){
						echo "<div class='message' style='clear:both;'>" . $notice  . "</div>";
					}
					else if($error!=""){
						echo "<div class='error_message'  style='clear:both;'>" . $error  . "</div>";
					}
				?>
              <form name="support_form" action="<?php echo URL;?>/contact-support.php" method="post" id="contact-support-form">
			  <label>Name:</label> <span><input type="text" name="name" id="name" value="<?php echo $error==""?"":$name;?>" class='input-text validate[required,minSize[4],maxSize[30]]'/></span>			  
			  <label>Email Address:</label> <span>
				<input type="text" name="sender_email" id="sender_email" class='input-text validate[required,custom[email]]' value="<?php echo $error==""?"":$email;?>"	/>
			   </span>			  
			  <label>Subject:</label><span><input type="text" name="subject" id="subject" value="<?php echo $error==""?"":$subject;?>" class='input-text validate[required,minSize[8],maxSize[30]]'></span>		    
			  <label>Message:</label> <textarea rows="" name="message" id="message" cols="" class="validate[required,minSize[10],maxSize[400]]"><?php echo $error==""?"":$message;?></textarea>
			  <div class='recaptchaContainer'>
				  <script type="text/javascript">
					 var RecaptchaOptions = {
						theme : 'clean'
					 };
				 </script>
				  <?php
					$publickey = "6LcUusYSAAAAANOpeGApdGiTkVuG_yp5zBepB9QC"; // you got this from the signup page
					echo recaptcha_get_html($publickey);			  
				  ?>
			  </div>
			  <input type="submit" name="submit" value="Submit" class="btn"/>
			  <div class="clear"></div>
			  </form>
			<div id="additional-support">
					                <h2 class='orangeh2'>Need Additional Help?</h2>
	                <p>Want a quick answer to a question and don't want to contact support?  Our FAQ answers many commonly asked questions and concerns.  You can get to the FAQ section by <a href="<?php echo URL;?>/faq.php">clicking here</a>.</p>
	                </div>
	</div><!-- contact-support -->
</div>
		<br/>


        <br style="clear: both;"/>
    </div>
</div>

        </div>

       <?php require 'includes/footer.php'?>
	<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
   <script src="<?php echo URL;?>/js/jquery.validationEngine-en.min.js" type="text/javascript"></script>
   <script src="<?php echo URL;?>/js/jquery.validationEngine.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>
    </body>

</html>

