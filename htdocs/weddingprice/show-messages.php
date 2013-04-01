<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplierBuyer.php';
if(!isset($_GET['token'])){
	header('Location: ' . URL . '/messages.php');
	exit();
}

require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.supplier.php';
require_once 'classes/database/objects/class.buyer.php';
require_once 'classes/database/objects/class.wedding.php';
require_once 'classes/Cipher.php';
$cipher = new Cipher('weddingpricemessages');
$otherid = $cipher->decrypt(str_replace(' ', '+', $_GET['token']));
if(!is_numeric($otherid)){
	header('Location: ' . URL . '/messages.php');
	exit();
}

$userid = 0;
$usertable = 'Supplier';
$othertable = 'Buyer';
if($_SESSION['type'] == 'Buyer'){
	$userid = $_SESSION['buyerId'];
	
	$usertable = 'Buyer';
	$othertable = 'Supplier';
	}
else{
	$userid = $_SESSION['supplierId'];
	}
$other = new $othertable();
$other->Get($otherid);	
mysql_connect(HOST, USER, PASSWORD);
mysql_select_db(DBNAME);
$query = "update message set isread='YES' where (toid =$userid AND fromid = $otherid)";
mysql_query($query);
$query = "select * from message where (toid =$userid AND fromid = $otherid) or (toid=$otherid AND fromid=$userid) order by date desc";
$messages = mysql_query($query);
if(mysql_num_rows($messages) == 0){
	header('Location: ' . URL . '/messages.php');
	exit();
}
$wedding = new Wedding();
if(isset($_SESSION['buyerId'])){
	$wl = $wedding->GetList(array(
		array('buyerId', '=', $userid)
	));
	$wedding = $wl[0];
}
else{
	$wl = $wedding->GetList(array(
		array('buyerId', '=', $otherid)
	));
	$wedding = $wl[0];
}
//echo $query; exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Wedding Price - Messages</title>		
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/messages.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/bidDetails.css"/>
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
						<?php require_once 'includes/messages-menu.php';?>
				</div>
				<div id="rightCol">
					<h1 class="myTitle">Conversations between You and <?php echo ucwords($other->name); ?></h1>
                    <div style='clear:both;'></div>
						
					<table class='reviewTable'>
						<tbody>
							<tr class='reviewWordTr info messageYouTr'>
								<td class='reviewWordTd messageTdLeft' colspan='2'>
									<textarea class='myMessageTextArea'></textarea><br/>
									<a class='bidLink sendButton' href='javascript:sendMessage(<?php echo $userid . ' , ' . $otherid . ' ,' . $wedding->weddingId;?>);'>Send</a>
								</td>
							</tr>							
							<?php while($row = mysql_fetch_array($messages)){
							?>
							<tbody>
								<tr class='reviewSeparator'>
									
								</tr>																	
							</tbody>	
							<tbody class='reviewTr  triangle-isosceles  <?php if($row['fromid'] == $otherid) echo 'messageHimTr success triangle-right'; else echo 'messageYouTr info triangle-left'; ?>' >	
								<tr >
									<td style='width: 375px;' class='reviewTdLeft messageTdLeft'>
										<img style='margin-right:10px;float:left;' src='<?php if($row['fromid'] == $otherid){echo URL . '/img/'. strtolower($othertable) . '/' .  $otherid .'_thumb.jpg';} else {echo URL . '/img/'. strtolower($usertable) . '/' .  $userid .'_thumb.jpg';} ?>' alt='profile'>
										<span style='float:left;padding-top:10px;'><?php if($row['fromid'] == $otherid) { if($other->name !='') echo ucwords($other->name); else echo 'Anonymous User';} else echo 'You';?></span>
									</td>
									<td class='reviewTdRight messageTdRight'><?php echo date('d-M-Y', strtotime($row['date']));?></td>
								</tr>	
								<tr>
									<td class='reviewWordTd messageTdLeft' colspan='2'><?php
									echo $row['content'];?></td>
								</tr>
							</tbody>
							<?php } ?>												
						</tbody>
					</table>
					
                </div><!-- rightCol -->
                <br style="clear: both;"/>
            </div>
            </div>
        </div>
		 <?php require 'includes/footer.php'; ?>
		 <script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
		 <script src="<?php echo URL;?>/js/messages.js" type="text/javascript"></script>
		
	</body>
</html>
