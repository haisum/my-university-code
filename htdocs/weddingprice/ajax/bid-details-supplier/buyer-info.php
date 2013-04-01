<?php 
require_once '../../config/config.php';
	require_once '../../classes/database/objects/class.database.php';	
	require_once '../../classes/database/objects/class.message.php';
	
	require_once '../../classes/database/objects/class.supplier.php';
	require_once '../../classes/database/objects/class.buyer.php';
	require_once '../../classes/database/objects/class.user.php';
	require_once '../../classes/database/objects/class.review.php';
	require_once '../../classes/database/objects/class.bid.php';
		require_once '../../classes/database/objects/class.wedding.php';
	
	$b = new Bid();
	$b->Get( $_REQUEST['bidId']);
	$weddingId = $_REQUEST['weddingId'];	
	$wedding = new Wedding();
	$wedding->Get($weddingId);
	$supplierId = $_SESSION['supplierId'];
	$buyer = new Buyer();
	$buyer->Get($wedding->buyerId);
	$buyerId = $buyer->buyerId;
	$user = new User();
	$user->Get($buyer->userId);
	$reviewObj = new Review();
	$reviewList = $reviewObj->GetList(array(
		array('toid','=', $buyerId)
	));
	$total = 0;
	foreach($reviewList as $review){
		$total += $review->rating;
	}
	$average = round($total / count($reviewList), 0);
	
	$messageObj = new Message();
	$messageList = $messageObj->GetList(array(
			array('weddingid','=', $weddingId),
			array('fromid','=', $wedding->buyerId),
			array('toid','=', $supplierId),
			array('isread', '=' , 'NO')
	));
	$unreadCount = count($messageList);
?>				
					<input id='unreadCount' type='hidden' value='<?php echo $unreadCount;?>'/>
					<h1 style="margin-top:20px;" class="myTitle"><?php echo $buyer->name; ?></h1>
					<table class='bidSummaryTable'>
						<tbody>
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
								<td class='bidSummaryTdLeft supplier'>Requests Completed:</td>
								<td class='bidSummaryTdRight'><?php 
								$bid = new Bid();
								$bidL = $bid->GetList(array(
										array(" weddingid = {$weddingId} 
										AND (
											status = 'COMPLETEDBUYER' OR
											status = 'REVIEWDONE' OR
											status = 'REVIEWRESPONDED' 
										)
										")
									));
									echo count($bidL) . $bid->pog_error;?></td>
							</tr>							
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Average Rating:</td>
								<td class='bidSummaryTdRight'>
									<div class='stars' title='<?php if($average ==0) echo 'No reviews and ratings for this supplier yet!'; else echo $average;?>'></div>
								</td>
							</tr>									
						</tbody>
						<?php if($b->status != 'PENDING' && $b->status != 'REJECTED' && $b->status != 'DISCARDED'){ ?>
							<tbody style='font-style:italic;text-decoration:underline;'>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Contact Email:</td>
								<td class='bidSummaryTdRight'>
									<?php echo $buyer->contactEmail; ?>
								</td>
							</tr>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Phone:</td>
								<td class='bidSummaryTdRight'>
									<?php echo $buyer->phone; ?>
								</td>
							</tr>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Address:</td>
								<td class='bidSummaryTdRight'>
									<?php echo $buyer->address; ?>
								</td>
							</tr>
							</tbody>
							
						<?php } ?>
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
                