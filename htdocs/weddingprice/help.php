<?php
require_once 'config/config.php';
require 'includes/securePasswordChange.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title>Wedding Price Sample - Help</title>

        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->
		<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>

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
        <li><strong><a href="<?php echo  URL;?>/help.php">Help Resources</a></strong></li>
		 <li><a href="<?php echo  URL;?>/faq.php">Frequently Asked Questions</a></li>
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
<p>Welcome to WeddingPrice Customer Support area, we have a variety of methods to contact our support department.  We've assembled the most frequently
  		asked questions and put them in the FAQ at your disposal.  If you can't find your answer there, we also have LiveHelp and support requests.</p>


<div class="h-content">
    <div class="h-icon">
        <img src="img/faqs-icon.jpg" alt=""/>
    </div><!--help-icon-->

    <div class="h-right">
        <h3 class="help">Frequently Asked Questions</h3>
        <p>For immediate assistance, read our knowledge database by viewing our <a href="<?php echo URL;?>/faq.php">FAQ Section.</a> It is the fastest and answers most questions!</p>
<p></p>
    </div><!--help-right-->
</div><!--h-content-->

<div class="h-content">
    <div class="h-icon">
        <a href="#"><img src="img/email-icon.jpg" border="0" alt=""/></a>
    </div><!--help-icon-->
    <div class="h-right">
        <h3 class="help">Email a Support Request</h3>
        <p>You can submit a ticket and we&#39;ll get back to you as soon as possible. You might want to first check out our <a href="<?php echo URL;?>/faq.php">Frequently Asked Questions</a> section for your answer.</p>
        <p><a class='btn' style='display:inline-block;float:none;' href="<?php echo URL;?>/contact-support.php">Click Here</a></p>
    </div><!--help-right-->
</div><!--h-content-->


        </div><!-- rightCol -->
        <br/>


        <br style="clear: both;"/>
    </div>
</div>

        </div>

       <?php require 'includes/footer.php'?>
    </body>

</html>

