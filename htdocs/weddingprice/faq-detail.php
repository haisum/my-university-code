<?php
require_once 'config/config.php';
require 'includes/securePasswordChange.php';
require 'classes/database/objects/class.database.php';
require 'classes/database/objects/class.faqcategory.php';
require 'classes/database/objects/class.faq.php';

$categoryId = 1;
if(isset($_GET['category']) && is_numeric($_GET['category'])){
	$categoryId =  $_GET['category'];
}
$faq = new Faq();
$faqList = $faq->GetList(array(array('faqcategoryid', '=' , $categoryId)), 'position', true, '');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title>Wedding Price</title>

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
       <li><a href="<?php echo  URL;?>/help.php">Help Resources</a></li>
		 <li><strong><a href="<?php echo  URL;?>/faq.php">Frequently Asked Questions</strong></a></li>
    </ul>
</div>
<div class="aside">
    <h2>Question or Concern</h2>
    <p>Contact Customer Support</p>
    <p><a href="<?php echo  URL;?>/contact-support.php" class="support-button">Contact Support</a></p>
</div>
        </div><!--leftCol-->
        <div id="rightCol" class='rightCol'>
		<?php foreach($faqList as $faqObj){ ?>
			<h2  id="<?php echo $faqObj->faqId; ?>" class="orangeh2"><?php echo $faqObj->question;?></h2>
			<div class="response">
                <p>
					<?php echo $faqObj->answer;?>
				</p>
                <a href="#">Back To Top</a>
            </div>
		<?php } ?>
		</div>
		<br/>


        <br style="clear: both;"/>
    </div>
</div>

        </div>

       <?php require 'includes/footer.php'?>
    </body>

</html>

