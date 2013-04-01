<?php
    require_once 'config/config.php';
	require_once 'includes/secureLogin.php';
	require_once 'includes/secureNormal.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>
   
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

   <title>Wedding Price Sample - Register Type</title>

   <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
   <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->
   <script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>

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
		<div class="content" style="border: 2px solid #55B4FD; float:none;">	
			<div class="upper_sign_up">
				<div class="upper_sign_up_text">
					<span>It's just a one time procedure</span>
					<p>To get started, please select an account type:</p>
				</div>
				
          <div class="upper_sign_up_boxes"> 
            <ul>
              <li class="upper_sign_up_vendor"> <span>I need to hire Wedding Vendors 
                and I want to post my Wedding jobs.</span> 
                 <p><a href="<?php echo URL;?>/register-buyer.php" class="button next">Next</a></p>
              </li>
              <li class="upper_sign_up_bride"> <span>I want to provide my Wedding 
                service or product to Brides and Grooms.</span> 
                <p><a href="<?php echo URL;?>/register-supplier.php" class="button next">Next</a></p>
              </li><li> 
            </li></ul>
				</div>
			</div>
			<br style="clear: both;">
		</div>
	</div>
 <?php require 'includes/footer.php'; ?>

    </body>

</html>

