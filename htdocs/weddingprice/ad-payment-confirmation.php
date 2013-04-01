<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplier.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title>Wedding Price | Special Offer Payment Confirmation</title>
				
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
				<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/weddings.css"/>

        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->	

        <!--[if lte IE 7]>

            <link rel="stylesheet" type="text/css" href="css/lteie7.css"/>

            <script defer type="text/javascript" src="js/pngfix.js"></script>

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
                <div class="content">
                <div id="leftCol">
					<?
                    	include('includes/my-account-left-links.php');
					?>
				</div>
                <div id="rightCol">
					<h1 class="myTitle">Payment Confirmation</h1>
					<div class='success'>
						Thankyou for your payment. Your ads will be on home page as soon as we receive payment confirmation from paypal.
					</div>	
                 </div>
            
                <br style="clear: both;"/>
            </div>
            </div>

        </div>
       
 <?php require 'includes/footer.php'; ?>
	<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
     <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>
    </body>

</html>

