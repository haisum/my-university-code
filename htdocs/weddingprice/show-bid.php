<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplier.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.supplier.php';
require_once 'classes/database/objects/class.buyer.php';
require_once 'classes/database/objects/class.region.php';
require_once 'classes/database/objects/class.bid.php';
require_once 'classes/database/objects/class.wedding.php';
require_once 'classes/database/objects/class.weddingcategory.php';
require_once 'classes/database/objects/class.category.php';
require_once 'classes/database/objects/class.message.php';
require_once 'classes/Cipher.php';
$supplier = new Supplier();
$supplierId = $_SESSION['supplierId'];
$supplier->Get($supplierId);
$bid = array();
if(!isset($_GET['bid']) && !is_numeric($_GET['bid'])){
	header('Location: ' . URL . '/page-not-found.php');
	exit;
}
$bidId = intval($_GET['bid']);
$b = new Bid();
$b->Get($bidId);
$cipher = new Cipher('dirtoo');
$wedCid = urlencode($cipher->encrypt($b->weddingcategoryId));
if($b->supplierId != $supplierId){
	header('Location: ' . URL . '/page-not-found.php');
	exit;
}

 $wed = new Wedding(); $wed->Get($b->weddingId);
 
	$buyer = new Buyer();
	$buyer->Get($wed->buyerId);
 $messageObj = new Message();
	$messageList = $messageObj->GetList(array(
			array('weddingid','=', $wed->weddingId),
			array('fromid','=', $wed->buyerId),
			array('toid','=', $supplierId),
			array('isread', '=' , 'NO')
	));
	$unreadCount = count($messageList);
if(isset($_POST['status']) && $b->status == 'ACCEPTED'){	
	if($_POST['status'] == 'CONFIRMED'){
		$b->status = 'CONFIRMED';
	}
	else if($_POST['status'] == 'REJECTED'){
		$b->status = 'REJECTED';
	}
	$b->Save();
	if($buyer->recieveQuotes == 'Yes'){	
		require_once 'classes/database/objects/class.emailtemplate.php';
		require_once 'classes/Mail.php';		
		$link = URL . '/show-bid-details.php?bid=' . $b->bidId . '&token=' . $wedCid;
		$mail = new Mail();
		$mail->requestStatusChange($buyer->contactEmail, $link);
	}
	/*
	require_once 'classes/database/objects/class.message.php';
	$message = new Message();
	$message->toId = $buyer->buyerId;
	$message->fromId = $supplierId;
	$message->isRead = 'NO';
	$message->status = 'SHOW';
	$message->weddingId = $wed->weddingId;
	$message->date = date('Y-m-d H:i:s', time());
	$message->content = 'Your bid status was changed visit <a href="' . URL . '/show-bid-details.php?bid=' . $b->bidId . '&token=' . $wedCid . '">bid summary page</a> to view details.';
	$message->Save();
	*/
}
$reviewError = '';
if(isset($_POST['reviewDetail'], $_POST['rating']) && $b->status == 'REVIEWDONE'){
	$detail = trim(htmlspecialchars($_POST['reviewDetail'], ENT_QUOTES));
	$rating = intval($_POST['rating']);
	if($rating == 0){
		$reviewError .= '-You must give a rating to buyer<br/>'	;
	}
	if($detail == '' || strlen($detail) < 20){
		$reviewError .= '-You must at least provide a 20 charachter review for buyer<br/>'	;
	}
	if($reviewError == ''){
		$b->status = 'REVIEWRESPONDED';
		$b->Save();
		require_once 'classes/database/objects/class.review.php';
		$review = new Review();
		$review->toId =$wed->buyerId;
		$review->fromId = $b->supplierId;
		$review->status = 'SHOW';
		$review->content = $detail;
		$review->date = date('Y-m-d H:i:s', time());
		$review->rating = $rating;
		$review->weddingId = $b->weddingcategoryId;
		$review->from = 'Supplier';
		$review->Save();
		
		if($buyer->recieveQuotes == 'Yes'){	
			require_once 'classes/database/objects/class.emailtemplate.php';
			require_once 'classes/Mail.php';		
			$link = URL . '/show-bid-details.php?bid=' . $b->bidId . '&token=' . $wedCid;
			$mail = new Mail();
			$mail->requestStatusChange($buyer->contactEmail, $link);
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Wedding Price Supplier Account - Bid Details</title>	
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/ui-lightness/jquery-ui-1.8.16.custom.css"/>		
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/weddings.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/bidDetails.css"/>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->	
        <!--[if lte IE 7]>
            <link rel="stylesheet" type="text/css" href="css/lteie7.css"/>
            <script defer type="text/javascript" src="js/pngfix.js"></script>
            <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>
        <![endif]-->
	</head>
	<body>
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
                <div class="content">
                <div id="leftCol">
                    <?
                    	include('includes/my-account-left-links.php');
					?>
                </div>
				<div id="rightCol">
                    <div class="clear"></div>
					<div id="tabs" style='float:left;width:700px;'>
						<ul>
							<li>
								<a href='#summaryContainer'>Summary</a>
							</li>
							<li>
								<a href='<?php echo URL . '/ajax/bid-details-supplier/buyer-info.php?weddingId=' . $wed->weddingId . '&bidId=' . $b->bidId ;?>'>Buyer's Information</a>
							</li>
							<li>
								<a href='<?php echo URL . '/ajax/bid-details-supplier/messages.php?weddingId=' . $wed->weddingId ;?>'><span id='messagesSpan' >Messages</span></a>
							</li>
							<?php if( $b->status == 'REVIEWDONE') { ?>		
								<li>
									<a id='messageTab' href="#addResponse">
										Respond to Review
									</a>
								</li>
							<?php } ?>
						</ul>
						<?php if( $b->status == 'REVIEWDONE') { ?>		
						<div id='addResponse'>
							<div id='addReview'>
							<?php if($reviewError != ''){ ?>
								<div class='error'><?php echo $reviewError; ?></div>
							<?php } ?>
							<form action='show-bid.php?<?php echo $_SERVER['QUERY_STRING']; ?>#addResponse' method='post'>
								
								<div>
									<?php
										require_once 'classes/database/objects/class.review.php';
										$rev = new Review();
										$rList = $rev->GetList(array(
											array('fromid' ,'=' , $buyer->buyerId),
											array('toid' ,'=' , $supplier->supplierId),
											array('weddingid' ,'=' , $b->weddingcategoryId)
										));
										$review = $rList[0];
									?>
									<label  style='float:left;width:150px;clear:left;margin-top:20px;font-style:italic;'>Buyer's Response:</label><br/>
									<div style='float:left;display:inline;margin-top:20px;clear:left;' title='<?php echo $review->rating; ?>' class='stars'></div>
									<div style='padding:10px; float:left;clear:left;background:none;width:480px;' class='success'>
										<?php echo $review->content; ?>
									</div>
								</div>
								<div style='float:left;clear:both;'>
									<label style='float:left;width:100px;margin-top:20px;font-style:italic;'>Rating</label>
									<div style='float:left;display:inline;margin-top:20px;' class='rStars'></div>
									<input type='hidden' value='0' name='rating' id='rating'/>
								</div>
								<div>
									<label  style='float:left;width:100px;clear:left;margin-top:20px;font-style:italic;' for='reviewDetail'>Your Response</label><br/>
									<textarea  name='reviewDetail' style='float:left;width:500px;clear:left;height:250px;margin-top:10px;'  id='reviewDetail'><?php if(isset($_POST['reviewDetail'])) echo $_POST['reviewDetail'];?></textarea>
								</div>
								<div>
									<button class='btn' style='float:left;margin-top:20px;margin-bottom:20px;'>Post Response</button>
								</div>
							</form>
							</div>	
						</div>
						<?php } ?>
						<div id='summaryContainer' style=''>
						  <h1 class="myTitle" style='margin-top:20px;'>Request Summary</h1>
						  <div style="clear:both;"></div>
						  <table style='float:left;' class='bidSummaryTable'>
							<tbody>
							   
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Request For:</td>
								<td class='bidSummaryTdRight'>
									<?php $cat = new Category(); $cat->Get($b->categoryId); echo $cat->name; ?>
								</td>								
							  </tr>	
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Groom &amp; Bride:</td>
								<td class='bidSummaryTdRight'><?php echo str_replace('(#)', '&amp;' , $wed->title); ?></td>
							  </tr>
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Wedding Date:</td>
								<td class='bidSummaryTdRight'><?php  echo date("d-M-Y", strtotime($wed->weddingDate)); ?></td>
							  </tr>
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Contact Person:</td>
								<td class='bidSummaryTdRight'><?php $buyer = new Buyer(); $buyer->Get($wed->buyerId); echo $buyer->contactPerson;?></td>
							  </tr>
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Region:</td>
								<td class='bidSummaryTdRight'><?php $reg = new Region(); $reg->Get($wed->regionId); echo $reg->name;?></td>
							  </tr>
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Last Modified:</td>
								<td class='bidSummaryTdRight'><?php $wc = new WeddingCategory(); $wc->Get($b->weddingcategoryId); echo date("d-M-Y", strtotime($wc->lastModified)); ?></td>
							  </tr>
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Budget:</td>
								<td class='bidSummaryTdRight'> $<?php echo $wc->budgetFrom; ?> to $<?php echo $wc->budgetTo; ?></td>
							  </tr>
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Description:</td>
								<td class='bidSummaryTdRight'> <?php echo $wc->detail; ?></td>
							  </tr>
							</tbody>
						  </table>
						  <img style='float:right;margin-right:10px;' src='<?php echo URL . '/img/weddingcats/' . $b->weddingcategoryId . '.jpg' ?>' alt='image'/>
						  
						  <h1 class="myTitle" style='margin-top:20px;clear:both;'>Bid Summary</h1>
						  <div style="clear:both;"></div>
						  <table style='float:left;' class='bidSummaryTable'>
							<tbody>
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft bigger'>Bid Posted On:</td>
								<td class='bidSummaryTdRight'><?php echo date("d-M-Y", strtotime($b->date)); ?></td>
							  </tr>
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Last Modified:</td>
								<td class='bidSummaryTdRight'><?php echo $b->lastModified; ?></td>
							  </tr>
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Amount:</td>
								<td class='bidSummaryTdRight'> $<?php echo $b->amount; ?></td>
							  </tr>
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Description:</td>
								<td class='bidSummaryTdRight'> <?php echo $b->bidDescription; ?></td>
							  </tr>
							  <tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft'>Status:</td>
								<td class='bidSummaryTdRight'>
								<?php switch($b->status){
									case 'PENDING' : 
										echo 'Waiting for buyer\'s response';
										break;
									case 'ACCEPTED' : 
										echo 'Buyer accepted this bid, waiting for your confirmation.';
									break;
									case 'DISCARDED' : 
										echo 'Buyer discarded this bid.';
										break;
									case 'REJECTED' : 
										echo 'You rejected this request.';
										break;
									case 'CONFIRMED' :
										echo 'You have won this bid! Use contact information in buyer\'s information tab to contact him/her.';
										break;
									case 'COMPLETEDBUYER' : 
										echo 'This request has been completed by buyer\'s side.';
										break;
									case 'REVIEWDONE' : 
										echo 'You have got a review by buyer to response click button below.';
										break;
									case 'REVIEWRESPONDED' : 
										echo 'Review has been responded.';
										break;
								} ?>								
								</td>
							  </tr>
							</tbody>
						  </table>
						<?php if($b->status == 'ACCEPTED'){ ?>	
						<form  action='show-bid.php?<?php echo $_SERVER['QUERY_STRING']; ?>' method='post' style='clear:both;display:inline-block;'>
							<button class='btn rejectBtn'>Confirm</button>
							<input type='hidden' name='status' value='CONFIRMED' />
						</form>
						<form action='show-bid.php?<?php echo $_SERVER['QUERY_STRING']; ?>' method='post' style='clear:both;display:inline-block;'>
							<button class='btn rejectBtn'>Reject</button>
							<input type='hidden' name='status' value='REJECTED' />
						</form>
						<?php  } else if($b->status == 'REVIEWDONE') { ?>													
								<button class='btn rejectBtn' onclick='$("#tabs").tabs("select", 3);'>Respond to Review</button>
						<?php } ?>
						</div>
					</div>
                </div><!-- rightCol -->
                <br style="clear: both;"/>
            </div>
            </div>
        </div>
		 <?php require 'includes/footer.php'; ?>
		<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo URL;?>/js/jquery-ui-1.8.16.custom.min.js"></script>	
		<script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>	
		<script src="<?php echo URL;?>/js/jquery.paginate.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo URL;?>/js/showBid.js"></script>
		
	</body>
</html>
