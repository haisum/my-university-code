<?php	

	require_once '../../config/config.php';
	if(($_SESSION['type'] != 'Buyer' && $_SESSION['type'] != 'Supplier')
	|| !isset($_REQUEST['supplierId'], $_REQUEST['weddingId'], $_REQUEST['bidId'])
	|| !is_numeric($_REQUEST['supplierId'])
	|| !is_numeric($_REQUEST['bidId'])
	|| !is_numeric($_REQUEST['weddingId'])){
		print_r($_REQUEST);
		die('You are not authorized to perform this action! go die');	
	}
	
	$recieverId = $_REQUEST['supplierId'];
	$weddingId = $_REQUEST['weddingId'];	
	$senderId = $_SESSION['buyerId'];
	$bidId = $_REQUEST['bidId'];
	$weddingId = $_REQUEST['weddingId'];	
	$supplierId = $_REQUEST['supplierId'];
	$categoryId = $_REQUEST['categoryId'];
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
	
	require_once '../../classes/database/objects/class.supplier.php';
	$supplier = new Supplier();
	$supplier->Get($recieverId);
	if($supplier->supplierId != $recieverId){
		die('You are not authorized to perform this action! supplier');
	}
	require_once '../../classes/database/objects/class.bid.php';
	require_once '../../classes/database/objects/class.category.php';
	//require_once '../../classes/database/objects/class.weddingcategory.php';
	$bid = new Bid();
	//$bidCObj = new BidPerCategory();
	$bid->Get($bidId);	
	/*$bidCatList = $bidCObj->GetList(array(
			array('weddingid', '=', $weddingId),
			array('bidid', '=', $bidId)	
		)
	);*/
	$c = new Category();
?>
	<div id="rightCol">	
		<h1 style='margin-bottom:30px;' class="myTitle"><?php echo ucfirst($supplier->name); ?></h1>
		<div id='tabs'>
		<?php require_once '../../includes/tabbed-navigation.php'; ?>
		<div id='tabs-1'>
			<table class='bidSummaryTable'>
				<tbody>
					<tr class='bidSummaryTr'>
						<td class='bidSummaryTdLeft supplier'>Bid Posted On:</td>
						<td class='bidSummaryTdRight'><?php echo date('d-M-Y', strtotime($bid->date));?></td>
					</tr>
					<tr class='bidSummaryTr'>
						<td class='bidSummaryTdLeft supplier' style='width:40%'>
							<?php $c->Get($bid->categoryId); echo $c->name;?>
						</td>
						<td class='bidSummaryTdRight' style='width:30%'>
							$<?php echo $bid->amount; ?>
						</td>
					</tr>		
					<tr class='bidSummaryTr'>
						<td class='bidSummaryTdLeft supplier'>Bid Description</td>
						<td class='bidSummaryTdRight'><?php echo $bid->bidDescription;?></td>
					</tr>
				</tbody>
			</table>
			<button class='btn rejectBtn'>Accept</button> <button class='btn rejectBtn'>Reject</button>
		</div>
		</div>
		<div style='clear:both;'></div>					
	</div><!-- rightCol -->