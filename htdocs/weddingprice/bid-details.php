<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureBuyer.php';
//die('this page has got some bugs to get fixed!');
if(!isset($_GET['token'])){
	echo "<script type='text/javascript'>window.location.href='" . URL . "/my-weddings.php'</script>";
	//echo 'boo';
	exit();
}
require_once 'classes/Cipher.php';
$cipher = new Cipher('bodyguard');
$weddingId = $cipher->decrypt(str_replace(' ', '+', $_GET['token']));
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.wedding.php';
$buyerId = $_SESSION['buyerId'];
$weddingObj = new Wedding();
$weddingList = $weddingObj->GetList(array(
	array('weddingid','=',$weddingId),
	array('buyerId','=',$buyerId)
));
if(count($weddingList) != 1){
	//echo $buyerId . " " . $weddingId;
	echo "<script type='text/javascript'>window.location.href='" . URL . "/my-weddings.php'</script>";
	exit();
}
$wedding = $weddingList[0];
require_once 'classes/database/objects/class.category.php';
require_once 'classes/database/objects/class.supplier.php';
require_once 'classes/database/objects/class.weddingcategory.php';
$cat = new Category();

$categoryList = $cat->GetList(array(
	array(' categoryid IN (select categoryid from weddingcategory where weddingid=' . $weddingId . ') ')
));
mysql_connect(HOST, USER, PASSWORD);
mysql_select_db(DBNAME);
$query = 'select avg(amount) as averageBid , count(amount) as totalBids, (select supplierid from bid where weddingid=' . $weddingId . ' order by bidid desc limit 1) as supplierId from bid where weddingid = '. $weddingId .';';
//echo $query;
$totalWeddingSummary = mysql_query($query);
$totalBids = null;
$averageBid = null;
$supplierId = null;
while($row = mysql_fetch_array($totalWeddingSummary)){
	$averageBid = $row['averageBid'];
	$totalBids = $row['totalBids'];
	$supplierId = $row['supplierId'];
}

require_once 'classes/database/objects/class.bid.php';
$bid = new Bid();
$bidList = $bid->GetList(array(
	array('supplierid', '=' , $supplierId),
	array('weddingid', '=' , $weddingId)
), '', true, 1);
$bidId = $bidList[0]->bidId;
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
                   	include('includes/category-bidder-links.php');
				?>
                </div>
				<div id='bidDetailContainer'>
					<div id='summaryContainer'>
						<div id="rightCol" style='float:left;margin-left:20px;width:380px;'>
							<h1 class="myTitle">Bidding Summary</h1>					
							<div style="clear:both;"></div>
							<table class='bidSummaryTable'>
								<tbody>
									<tr class='bidSummaryTr'>
										<td class='bidSummaryTdLeft'>Wedding Posted On:</td>
										<td class='bidSummaryTdRight'><?php echo date("d-M-Y", strtotime($wedding->postedDate)); ?></td>
									</tr>
									<tr class='bidSummaryTr'>
										<td class='bidSummaryTdLeft'>Bid Deadline:</td>
										<td class='bidSummaryTdRight'><?php echo date("d-M-Y", strtotime($wedding->bidDeadline)); ?></td>
									</tr>
									<?php if(is_null($totalBids) || is_null($averageBid)|| is_null($supplierId)){ ?>
										<tr class='bidSummaryTr'>
											<td class='bidSummaryTdLeft' colspan='2'>
												No bids on this wedding yet!
											</td>
										</tr>
									<?php } else{ ?>
										<tr class='bidSummaryTr'>
											<td class='bidSummaryTdLeft'>Total Bids Upto Now:</td>
											<td class='bidSummaryTdRight'><?php echo $totalBids; ?></td>
										</tr>
										<tr class='bidSummaryTr'>
											<td class='bidSummaryTdLeft'>Average Bid Amount:</td>
											<td class='bidSummaryTdRight'>$<?php echo intval($averageBid); ?></td>
										</tr>							
										<tr class='bidSummaryTr'>
											<td class='bidSummaryTdLeft'>Latest bid by:</td>
											<td class='bidSummaryTdRight'> 
												<?php $supplier = new Supplier();
													  $supplier->Get($supplierId);
												?>
												<a href='javascript:showSupplierBids(<?php echo "$supplierId, $bidId, $weddingId, " . $categoryList[0]->categoryId; ?>);'><?php if($supplier->name != ''){echo ucfirst($supplier->name);} else {echo 'Anonymous User';}?></a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="perCategoryDetail">
						<h1 class="myTitle summaryPerCategory" style='margin-bottom:25px;'>Summary Per Category</h1>					
						<div style="clear:both;"></div>
						<?php foreach($categoryList as $category){ ?>
						<div class='bidSummaryCategory' id='bidSummaryCategory<?php echo $category->categoryId;?>'>
						<strong><?php echo ucfirst($category->name); ?></strong>
						<?php
							$query = 'select avg(amount) as averageBid , count(amount) as totalBids, min(amount) minimumBid, (select supplierId from bid where bidid = (select bidid from bid where amount=(select min(amount) from bid where weddingid= ' . $weddingId . ' and categoryid=' . $category->categoryId . ' ) AND weddingid=' . $weddingId . ' AND categoryid = ' . $category->categoryId . ' LIMIT 1) AND weddingid = ' . $weddingId . ') as supplierId from bid where weddingid = ' . $weddingId . ' and categoryid = ' . $category->categoryId . ';';
							//echo $query;
							$result = mysql_query($query);
							$totalBids = null;
							$averageBid = null;
							$supplierId = null;
							$minimumBid = null;
							while($row = mysql_fetch_array($result)){
								$averageBid = $row['averageBid'];
								$totalBids = $row['totalBids'];
								$minimumBid = $row['minimumBid'];
								$supplierId = $row['supplierId'];
							}
							$bid = new Bid();
							$bidList = $bid->GetList(array(
								array('supplierid', '=' , $supplierId),
								array('weddingid', '=' , $weddingId)
							), '', true, 1);
							$bidId = $bidList[0]->bidId;
						?>
						<table class='bidSummaryTable'>
							<tbody>
								<?php if(is_null($totalBids) || is_null($averageBid)|| is_null($minimumBid) || is_null($supplierId)){ ?>
									<tr class='bidSummaryTr'>
										<td class='bidSummaryTdLeft' colspan='2'>
											No bids on this category yet!
										</td>
									</tr>
								<?php } else{ ?>
								<tr class='bidSummaryTr'>
									<td class='bidSummaryTdLeft italic'>Total Bids Upto Now:</td>
									<td class='bidSummaryTdRight'><?php echo $totalBids; ?></td>
								</tr>
								<tr class='bidSummaryTr'>
									<td class='bidSummaryTdLeft italic'>Average Bid Amount:</td>
									<td class='bidSummaryTdRight'>$<?php echo intval($averageBid);?></td>
								</tr>							
								<tr class='bidSummaryTr'>
									<td class='bidSummaryTdLeft italic'>Minimum Bid Amount:</td>
									<td class='bidSummaryTdRight'>$<?php echo $minimumBid;?> by 
										<?php 
											$supplier = new Supplier();
											$supplier->Get($supplierId);
											//echo 'id:' . $supplier->supplierId . '<br/>' . $query;
										?>
										<a href='javascript:showSupplierBids(<?php echo "$supplierId, $bidId, $weddingId, " . $category->categoryId; ?>);'>
											<?php if($supplier->name != ''){echo ucfirst($supplier->name);} else {echo 'Anonymous User';}?>
										</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						</div>
						<?php } ?>
					</div>
					</div>
					
					<div id='ajaxContent' style='display:none;'>
					</div>
				</div>
				<div style="clear:both;"></div>
              </div>
			  <div style="clear:both;"></div>
              </div>
                <br style="clear: both;"/>
            </div><!-- wrapper -->
        </div>
       <div id='summaryBackup' style='display:none;'>
	   </div>
	   <input type='hidden' id='buyerId' value='<?php echo $buyerId;?>' />
 <?php require 'includes/footer.php'; ?>
	<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo URL;?>/js/jquery-ui-1.8.16.custom.min.js"></script>	
     <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>
	 <script type="text/javascript" src="<?php echo URL;?>/js/bid-details.js"></script>
    </body>
</html>

