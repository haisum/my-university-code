<?php 
require_once '../../config/config.php';
	$recieverId = $_SESSION['recieverId'];
	$weddingId = $_SESSION['weddingId'];	
	$senderId = $_SESSION['buyerId'];
	require_once '../../classes/database/objects/class.database.php';	
	require_once '../../classes/database/objects/class.message.php';
	$messageObj = new Message();
	$messageList = $messageObj->GetList(array(
			array('weddingid','=', $weddingId),
			array('fromid','=', $recieverId),
			array('toid','=', $senderId),
			array('isread', '=' , 'NO')
	));
	$unreadCount = count($messageList);
	
	$bidId = $_REQUEST['bidId'];
	$weddingId = $_REQUEST['weddingId'];	
	$supplierId = $_REQUEST['supplierId'];
	$categoryId = $_REQUEST['categoryId'];
	
	require_once '../../classes/database/objects/class.supplier.php';
	require_once '../../classes/database/objects/class.buyer.php';
	require_once '../../classes/database/objects/class.user.php';
	require_once '../../classes/database/objects/class.review.php';
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
					<table class='bidSummaryTable'>
						<tbody>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Contact Person:</td>
								<td class='bidSummaryTdRight'><?php echo $supplier->contactPerson; ?></td>
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
								<td class='bidSummaryTdLeft supplier'>Bids Completed:</td>
								<td class='bidSummaryTdRight'>4* (will implement after bid completion)</td>
							</tr>							
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Average Rating:</td>
								<td class='bidSummaryTdRight'>
									<div class='stars' title='<?php if($average ==0) echo 'No reviews and ratings for this supplier yet!'; else echo $average;?>'></div>
								</td>
							</tr>						
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Company Profile</td>
								<td class='bidSummaryTdRight'>asdafsf sadfsa fsdfsa fsdfsafd sadfsfd sadfsafdsf er szdfs fer zsxdsfsa erfsf ffsfsaff sfsafw sfasfw dgrre dsvv dgd</td>
							</tr>
						</tbody>
					</table>	
					<?php if($average != 0) { ?>
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
                