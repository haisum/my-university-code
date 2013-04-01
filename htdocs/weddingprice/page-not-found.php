<?php
    require_once 'config/config.php';
	if(isset($_SESSION['userId'])){
		header('Location: ' .  URL . '/account.php' );
	}
	else{
		header('Location: ' . URL );
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>
   
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

   <title>Wedding Price Sample - Page Not Found</title>

   <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/login.css"/>

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
			
	<h1 class="pageTitle"><a href="#"><span class='loginTitle contactIcon'>Page Not Found</span></a></h1>
	<br style="clear: both;">
  <div id="auction-listing"> 
        <div id="live-auctions"> 
          <div id="faq-wrap"> 
            <div id="contact-support" style="float:left; width:100%; padding-left:1px;">
              
      <div style="float:left">
      	<img src="<?php echo URL;?>/img/error.jpg">
	  </div>
	  
	  <div id="right-content" style="float:right; width:380px; padding-top:130px;color:#939393;">
	 	  <h1 style="margin:10px 0px; height:32px; font-size:2em;font-weight:bolder;color:#6D6D6D;">Something Bad Happened</h1>
	      <h3 style="margin:0px;">Page Not Found</h3>
	      <p style="margin:0px; padding:0px; width:370px;">The page you are looking for has either been moved, does not exist on our server, or you don't have permissions to access it. You may have reached this page from an outside link or re-direct which is currrently being updated. If this is the case, please feel free to send us your <a style="color:#0486C9;" href="<?php echo URL;?>/contact-support.php">feedback</a>. Thank you.</p>
		  <p style="margin-top:10px; width:370px;">
			You may also <a style="color:#0486C9;" href="javascript:history.go(-1);">Go back to where you came from</a>
		  </p>
	  </div>
	  

	  <!-- ============= End Contact Support =============  -->
  
            </div>
          </div>
          
          <div class="clear"></div>
          <div id="faqs-end-bg"> </div>
        </div>
      </div>
	
			<br style="clear: both;">
		</div>

 </div>

  </div>

 <?php require 'includes/footer.php'; ?>
	<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>
    </body>

</html>
