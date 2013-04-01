<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplierBuyer.php';
require_once 'includes/secureBuyer.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.buyer.php';
require_once 'classes/database/objects/class.supplier.php';
require_once 'classes/database/objects/class.category.php';
require_once 'classes/database/objects/class.wedding.php';
require_once 'classes/database/objects/class.bid.php';
require_once 'classes/database/objects/class.weddingcategory.php';
require_once 'classes/Cipher.php';
$buyer = new Buyer();
$buyerId = $_SESSION['buyerId'];
$buyer->Get($buyerId);
if(!isset($_GET['token'])){
	header('Location: ' . URL . '/add-request.php' );
	exit;
}
if(!isset($_GET['bid'])){
	header('Location: ' . URL . '/show-request.php?token=' . urlencode($_GET['token']) );
	exit;
}
$cipher = new Cipher('dirtoo');
$wedCId = $cipher->decrypt(str_replace(' ', '+', $_GET['token']));
if(!is_numeric($wedCId)){
 header('Location: ' . URL . '/add-request.php' );
 exit;
}
$wedC = new WeddingCategory();
$wedC->Get($wedCId);
$wedding = new Wedding();
$wedding->Get($wedC->weddingId);
if($wedding->buyerId != $buyerId){
 header('Location: ' . URL . '/add-request.php' );
 exit;
}

$bidId = intval($_GET['bid']);
if($bidId < 1){
	header('Location: ' . URL . '/add-request.php' );
 exit;
}
$bid = new Bid();
$bid->Get($bidId);
$supplier = new Supplier();
$supplier->Get($bid->supplierId);
if(isset($_POST['status']) &&  $bid->status != 'COMPLETEDBUYER' ){
	$b = $bid;
	if($b->status == 'PENDING'){
		if($_POST['status'] == 'ACCEPTED'){
			$b->status= 'ACCEPTED';
			$b->Save();
		}
		else if($_POST['status'] == 'DISCARDED'){
			$b->status= 'DISCARDED';
			$b->Save();
		}
	}
	else if($b->status == 'CONFIRMED' && $_POST['status'] == 'COMPLETEDBUYER'){
		$bid->status = 'COMPLETEDBUYER';
		$bid->Save();
	}
	if($supplier->recieveRequests == 'Yes'){	
			require_once 'classes/database/objects/class.emailtemplate.php';
			require_once 'classes/Mail.php';
			$link = URL . '/show-bid.php?bid=' . $bid->bidId;
			$mail = new Mail();
			$mail->bidStatusChange($supplier->salesEmail, $link);
	}
}
$reviewError = '';
if(isset($_POST['reviewDetail'], $_POST['rating']) && $bid->status == 'COMPLETEDBUYER'){
	$detail = trim(htmlspecialchars($_POST['reviewDetail'], ENT_QUOTES));
	$rating = intval($_POST['rating']);
	if($rating == 0){
		$reviewError .= '-You must give a rating to supplier<br/>'	;
	}
	if($detail == '' || strlen($detail) < 20){
		$reviewError .= '-You must at least provide a 20 charachter review for supplier<br/>'	;
	}
	if($reviewError == ''){
		$bid->status = 'REVIEWDONE';
		$bid->Save();
		require_once 'classes/database/objects/class.review.php';
		$review = new Review();
		$review->toId = $bid->supplierId;
		$review->fromId = $buyerId;
		$review->status = 'SHOW';
		$review->content = $detail;
		$review->date = date('Y-m-d H:i:s', time());
		$review->rating = $rating;
		$review->weddingId = $bid->weddingcategoryId;
		$review->from = 'Buyer';
		$review->Save();		
		if($supplier->recieveRequests == 'Yes'){	
			require_once 'classes/database/objects/class.emailtemplate.php';
			require_once 'classes/Mail.php';
			$link = URL . '/show-bid.php?bid=' . $bid->bidId;
			$mail = new Mail();
			$mail->bidStatusChange($supplier->salesEmail, $link);
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Wedding Price | Show Request Details</title>
		
		
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
                <!--<div class="top-nav">	  
                	
                </div>-->
                <div id="leftCol">
                    <?
                    	include('includes/my-account-left-links.php');
					?>
                </div>
				<div id="rightCol">
					<h1 style='float:left;' class="myTitle"><?php $c = new Category(); $c->Get($wedC->categoryId); echo ucwords($c->name) . ' Response Detail'; ?></h1> 	
					<a style='float:right;' href='<?php echo URL . '/show-request.php?token=' . urlencode($_GET['token']); ?>'/>Go back to response list</a>
                    <div class="clear">
					<?php if($error!=null || $error != '') { ?>
						<p class='error'> 
							<?php echo $error; ?>
						</p>
						<?php  } ?>
					</div>
				<?php
				
$bid->Get($bidId);
					$recieverId = $bid->supplierId;
	$weddingId = $bid->weddingId;	
	$senderId = $buyerId;
	$bidId = $bid->bidId;
	$supplierId = $recieverId;
	$categoryId = $bid->categoryId;
	require_once 'classes/database/objects/class.database.php';	
	require_once 'classes/database/objects/class.message.php';
	$messageObj = new Message();
	$messageList = $messageObj->GetList(array(
			array('weddingid','=', $weddingId),
			array('fromid','=', $recieverId),
			array('toid','=', $senderId),
			array('isread', '=' , 'NO')
	));	
	$unreadCount = count($messageList);
	
	$supplier = new Supplier();
	$supplier->Get($recieverId);

				?>
				<input type='hidden' id='unreadCount' value='<?php echo $unread; ?>'/>
				<div style='float:left;margin-top:20px;width:670px;' id='tabs'>
				<?php require_once 'includes/tabbed-navigation.php'; ?>
				<?php if( isset($bid ) && $bid->status == 'COMPLETEDBUYER') { ?>
					<div id='addReview'>
						<?php if($reviewError != ''){ ?>
							<div class='error'><?php echo $reviewError; ?></div>
						<?php } ?>
						<form action='show-bid-details.php?<?php echo $_SERVER['QUERY_STRING']; ?>' method='post'>
							<div>
								<label style='float:left;width:100px;margin-top:20px;font-style:italic;'>Rating</label>
								<div style='float:left;display:inline;margin-top:20px;' class='rStars'></div>
								<input type='hidden' value='0' name='rating' id='rating'/>
							</div>
							<div>
								<label  style='float:left;width:100px;clear:left;margin-top:20px;font-style:italic;' for='reviewDetail'>Review Details</label><br/>
								<textarea  name='reviewDetail' style='float:left;width:500px;clear:left;height:250px;margin-top:10px;'  id='reviewDetail'><?php if(isset($_POST['reviewDetail'])) echo $_POST['reviewDetail'];?></textarea>
							</div>
							<div>
								<button class='btn' style='float:left;margin-top:20px;margin-bottom:20px;'>Post Review</button>
							</div>
						</form>
					</div>					
				<?php } ?>
				<div id='tabs-1'>
					<table class='bidSummaryTable'>
						<tbody>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Bid Posted On:</td>
								<td class='bidSummaryTdRight'><?php  echo date('d-M-Y', strtotime($bid->date));?></td>
							</tr>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Category</td>
								<td class='bidSummaryTdRight'><?php $c->Get($bid->categoryId); echo $c->name;?></td>
							</tr>	
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Amount</td>
								<td class='bidSummaryTdRight'>$<?php echo $bid->amount; ?></td>
							</tr>		
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Bid Description</td>
								<td class='bidSummaryTdRight'><?php echo $bid->bidDescription;?></td>
							</tr>
							<?php if($bid->status == 'DISCARDED') { ?>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Status</td>
								<td class='bidSummaryTdRight'><?php echo 'You discarded this response!';?></td>
							</tr>
							<?php } else if($bid->status == 'ACCEPTED') { ?>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Status</td>
								<td class='bidSummaryTdRight'><?php echo 'You accepted this response, waiting for supplier to accept this request.';?></td>
							</tr>
							<?php }  else if($bid->status == 'CONFIRMED') { ?>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Status</td>
								<td class='bidSummaryTdRight'><?php echo 'Supplier has confirmed this request. You may contact him/her using contact information given below.';?></td>
							</tr>
							<?php }  else if($bid->status == 'REJECTED') { ?>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Status</td>
								<td class='bidSummaryTdRight'><?php echo 'Supplier rejected this request. You may contact other suppliers for this request.';?></td>
							</tr>
							<?php }else if($bid->status == 'REVIEWDONE' || $bid->status == 'REVIEWRESPONDED') { ?>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Status</td>
								<td class='bidSummaryTdRight'><?php echo 'This wedding has been completed and review has been posted.';?></td>
							</tr>
							<?php } else if($bid->status == 'COMPLETEDBUYER') { ?>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Status</td>
								<td class='bidSummaryTdRight'><?php echo 'This wedding has been completed.';?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<?php if($bid->status == 'PENDING'){ ?>
					<form action='show-bid-details.php?<?php echo $_SERVER['QUERY_STRING']; ?>' method='post' style='display:inline-block;'>
						<button class='btn rejectBtn'>Accept</button>
						<input type='hidden' name='status' value='ACCEPTED' />
					</form>
					<form action='show-bid-details.php?<?php echo $_SERVER['QUERY_STRING']; ?>' method='post' style='display:inline-block;'>
						<button class='btn rejectBtn'>Discard</button>
						<input type='hidden' name='status' value='DISCARDED' />
					</form>
					<?php } else if($bid->status == 'CONFIRMED'){ ?>
						<form action='show-bid-details.php?<?php echo $_SERVER['QUERY_STRING']; ?>' method='post' style='display:inline-block;'>
							<button class='btn rejectBtn'>Request Completed</button>
							<input type='hidden' name='status' value='COMPLETEDBUYER' />
						</form>
					<?php } else if($bid->status == 'COMPLETEDBUYER'){ ?>
						<form action='javascript:void(0);' method='post' style='display:inline-block;'>
							<button class='btn rejectBtn' onclick='$("#tabs").tabs("select", 2);'>Review Supplier</button>
						</form>
					<?php } ?>
	<div style='clear:both;margin-top:30px;'>
		<hr/>
	</div>
	<h1 class='myTitle' style='margin-top:20px;float:left;'>Supplier's Information</h1>
	<img src='<?php echo URL . '/img/supplier/' . $supplierId . '.jpg';  ?>' style='float:right;' />
	<?php				
						require_once 'classes/database/objects/class.user.php';
	require_once 'classes/database/objects/class.review.php';
	$supplier = new Supplier();
	$buyer = new Buyer();
	$supplier->Get($supplierId);
	$user = new User();
	$user->Get($supplier->userId);
	$reviewObj = new Review();
	$reviewList = $reviewObj->GetList(array(
		array('toid','=', $supplierId)
	));
	$total = 0;
	foreach($reviewList as $review){
		$total += $review->rating;
	}
	$average = round($total / count($reviewList), 0);
?>
					
					<table class='bidSummaryTable' style='clear:both;'>
						<tbody>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Name:</td>
								<td class='bidSummaryTdRight'>
									<?php echo ucwords($supplier->name); ?>								
								</td>
							</tr>	
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Contact Person:</td>
								<td class='bidSummaryTdRight'><?php echo ucwords($supplier->contactPerson); ?></td>
							</tr>	
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Joined On:</td>
								<td class='bidSummaryTdRight'><?php echo date('d-M-Y', strtotime($user->registrationDate));?></td>
							</tr>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Last logged in at:</td>
								<td class='bidSummaryTdRight'>
									<?php
										echo date('d-M-Y', strtotime($user->lastLogin));
									?>
								</td>
							</tr>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Membership Type:</td>
								<td class='bidSummaryTdRight'>Normal</td>
							</tr>							
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Requests Completed:</td>
								<td class='bidSummaryTdRight'><?php
									$bidL = $bid->GetList(array(
										array(" supplierid = {$supplier->supplierId} 
										AND (
											status = 'COMPLETEDBUYER' OR
											status = 'REVIEWDONE' OR
											status = 'REVIEWRESPONDED' 
										)
										")
									));
									echo count($bidL) . $bid->pog_error;
								?></td>
							</tr>							
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Average Rating:</td>
								<td class='bidSummaryTdRight'>
									<div class='stars' title='<?php if($average ==0) echo 'No reviews and ratings for this supplier yet!'; else echo $average;?>'></div>
								</td>
							</tr>						
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Company Profile</td>
								<td class='bidSummaryTdRight'><?php echo $supplier->companyProfile; ?></td>
							</tr>
						</tbody>
							<?php if($bid->status != 'PENDING' && $bid->status != 'REJECTED' && $bid->status != 'DISCARDED'){ ?>
							<tbody style='font-style:italic;text-decoration:underline;'>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Contact Email</td>
								<td class='bidSummaryTdRight'><?php echo $supplier->salesEmail; ?></td>
							</tr>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Contact Number</td>
								<td class='bidSummaryTdRight'><?php echo $supplier->phone; ?></td>
							</tr>							
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Address</td>
								<td class='bidSummaryTdRight'><?php echo $supplier->address; ?></td>
							</tr>
							</tbody>
							<?php } ?>
					</table>	
					<?php if($average != 0) { $buyer=new Buyer(); ?>
					<h2 class='reviewHeading'>Recent Reviews</h2>
					<table class='reviewTable'>
						<tbody>
						<?php 
							foreach($reviewList as $review)	{
						?>
							<tr class='reviewTr success'>
								<td class='reviewTdLeft'><?php $buyer->Get($review->fromId); echo $buyer->name; ?></td>
								<td class='reviewTdRight'><div class='stars' title='<?php echo $review->rating; ?>'></div></td>
							</tr>	
							<tr class='reviewSeparator'></tr>
							<tr class='reviewWordTr info'>
								<td class='reviewWordTd' colspan='2'>
									<?php echo $review->content; ?>
								</td>
							</tr>							
							<tr class='reviewSeparator'></tr>
						<?php } ?>					
						</tbody>
					</table>
					<?php } ?>
                    <div style='clear:both;'></div>	
				</div>
				</div>
						
				<br style="clear: both;"/>
				
            </div>
            </div>
        </div>
		 <?php require 'includes/footer.php'; ?>
		<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>		
		<script type="text/javascript" src="<?php echo URL;?>/js/jquery.cookie.js"></script>	
		<script type="text/javascript" src="<?php echo URL;?>/js/jquery-ui-1.8.16.custom.min.js"></script>	
		<script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>	
		<script type="text/javascript" src="<?php echo URL;?>/js/myWedding.js"></script>		
	</body>
</html>

