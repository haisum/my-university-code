<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplier.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.supplier.php';
require_once 'classes/database/objects/class.region.php';
require_once 'classes/database/objects/class.bid.php';
$supplier = new Supplier();
$supplierId = $_SESSION['supplierId'];
$supplier->Get($supplierId);
$bids = require_once 'includes/bidData.php';
$messageCount = $bids['messageCount'];
unset($bids['messageCount']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Wedding Price Sample Buyer Account - Bid Details</title>

		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/jqpaginate.css"/>
		
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/weddings.css"/>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->	
        <!--[if lte IE 7]>
            <link rel="stylesheet" type="text/css" href="css/lteie7.css"/>
            <script defer type="text/javascript" src="js/pngfix.js"></script>
            <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>
        <![endif]-->
		<script type='text/javascript' >
			var totalRecords = <?php echo $bids['bidCount'];unset($bids['bidCount']); ?>;
			var limit = <?php echo BIDSPERPAGE; ?>;
		</script>
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
					<h1 class="myTitle">My Bids</h1>
                    <div class="clear"></div>
					<div id="SettingsPage_Content">										
						<table class='wtable' border='0'>							
							<thead>								
								<tr>
									<th style='width:100px;'>
										Bid Date
									</th>
									<th style='width:95px;'>
										Title
									</th>
									<th style='width:90px;'>										
										Wedding Date
									</th>									
									<th style='width:75px;'>										
										Contact Person
									</th>
									<th style='width:65px;'>
										Region
									</th>
									<th style='width:35px;'>
										Amount
									</th>
									<th style='width:90px;'>
										Category
									</th>									
									<th style='width:90px;'>
										Last Modified
									</th>
									<th style='width:30px;'>
										Status
									</th>	
									<th style='width:35px;'>
										<?php $hasMessage = $messageCount > 0; ?>
										<a href='#' title='<?php if($hasMessage) echo $messageCount . ' unread message(s)'; else echo 'No new messages' ;?>'>
											<div class='<?php if($hasMessage) echo 'newMessage';?>' style='height:12px;width:30px;background:url(img/mail.png) no-repeat;background-position: 8px -1px;'></div>
										</a>
									</th>
								</tr>
							</thead>
							<tbody>
							<?php if(count($bids) == 0) { ?>
							<tr class='editTr' id="editTrNotice">
									<td colspan='8' style="padding:0px;">
										<div id='noWedding' class='signup_txt weddingNotice'>
											You haven't bid on any wedding yet. <a href="<?php echo URL . '/list-weddings.php' ?>">Click here</a> to browse a list of biddable weddings.
										</div>
									</td>
							</tr>
							<?php } ?>
							</tbody>
							<tbody id='lister' style=''>
								<?php require 'includes/my-bid-list.php'; ?>
							</tbody>
							<tbody>
								<tr id='paginationTr'>
									<td id='paginationTd' colspan='8'>
										<div style="width: 250px;margin:0 auto;text-align:center;">
											<div id='paginationDiv'>
											</div>
											Showing Records <span id='startRecs'>0</span> to <span id='endRecs'>0</span> of <span id='totalRecs'>0</span>.
										</div>
									</td>
								</tr>
							</tbody>
						</table>	
					</div>
                </div><!-- rightCol -->
                <br style="clear: both;"/>
            </div>
            </div>
        </div>
		 <?php require 'includes/footer.php'; ?>
		<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>	
		<script src="<?php echo URL;?>/js/jquery.paginate.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo URL;?>/js/myBid.js"></script>
		
	</body>
</html>
