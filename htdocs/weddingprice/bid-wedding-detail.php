<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplier.php';
if(!isset($_GET['token'])){
	echo "<script type='text/javascript'>window.location.href='" . URL . "/my-bids.php'</script>";
	//echo $bidId . ' ' . $_GET['token'] . 'as';
	exit();
}
require_once 'classes/Cipher.php';
$cipher = new Cipher('guysoap');
$bidId = $cipher->decrypt(str_replace(' ', '+', $_GET['token']));
if(!is_numeric($bidId)){
	echo "<script type='text/javascript'>window.location.href='" . URL . "/my-bids.php'</script>";
	exit();	
}
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.wedding.php';
require_once 'classes/database/objects/class.bid.php';
require_once 'classes/database/objects/class.message.php';
$supplierId = $_SESSION['supplierId'];
$bid = require_once 'includes/bidData.php';
$bid = $bid[0];
$weddingId = $bid['weddingId'];
$wedding = new Wedding();
$wedding->Get($weddingId);

$messageObj = new Message();
	$messageList = $messageObj->GetList(array(
			array('weddingid','=', $weddingId),
			array('fromid','=', $wedding->buyerId),
			array('toid','=', $supplierId),
			array('isread', '=' , 'NO')
	));
	$unreadCount = count($messageList);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Wedding Price Bid Details</title>
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/bidDetails.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/ui-lightness/jquery-ui-1.8.16.custom.css"/>		
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->
<!--[if lte IE 7]>
            <link rel="stylesheet" type="text/css" href="css/lteie7.css"/>
            <script defer type="text/javascript" src="js/pngfix.js"></script>
            <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>
        <![endif]-->
</head>
<body>
<input id='unreadCount' type='hidden' value='<?php echo $unreadCount;?>'/>
<div class='modalDiv'></div>
<input id='unreadCount' type='hidden' value='<?php echo $unreadCount;?>'/>
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
    <div class="content" style="width:948px;">
      <div id='bidDetailContainer'>
        <div>
          
        </div>
      </div>
      <div style="clear:both;"></div>
    </div>
    <div style="clear:both;"></div>
  </div>
  <br style="clear: both;"/>
</div>
<!-- wrapper -->
</div>
<div id='summaryBackup' style='display:none;'> </div>
<input type="hidden" value="<?php echo $bid['bidId'];?>" id='bidId'/>
<input type="hidden" value="<?php echo $bid['weddingId'];?>" id='weddingId'/>
<?php require 'includes/footer.php'; ?>
<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo URL;?>/js/jquery-ui-1.8.16.custom.min.js"></script>	
<script type="text/javascript" src="<?php echo URL;?>/js/jquery.cookie.js"></script>	
<script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script> 
<script type="text/javascript" src="<?php echo URL;?>/js/viewBid.js"></script> 
<script type="text/javascript" src="<?php echo URL;?>/js/bid-details-supplier.js"></script>
</body>
</html>
