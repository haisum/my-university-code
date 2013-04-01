<?php 
	require_once '../../config/config.php';
	require_once '../../includes/secureLogin.php';
	require_once '../../includes/securePasswordChange.php';
	if(($_SESSION['type'] != 'Buyer' && $_SESSION['type'] != 'Supplier') || !isset($_REQUEST['weddingId'])){
		print_r($_REQUEST);
		die('You are not authorized to tee too perform this action! ddd ' . ($_SESSION['type'] != 'Buyer' && $_SESSION['type'] != 'Supplier') . ' ' . $_REQUEST['weddingId']);
	}
	$recieverId = $_REQUEST['recieverId'];
	$senderId = $_REQUEST['senderId'];	
	$bidId = $_REQUEST['bidId'];
	$weddingId = $_REQUEST['weddingId'];	
	$supplierId = $_REQUEST['recieverId'];
	$categoryId = $_REQUEST['categoryId'];
	require_once '../../classes/database/objects/class.database.php';
	require_once '../../classes/database/objects/class.supplier.php';	
	require_once '../../classes/database/objects/class.message.php';
	$supplier = new Supplier();
	$supplier->Get($recieverId);
	$messageObj = new Message();
	mysql_connect(HOST, USER, PASSWORD);
	mysql_select_db(DBNAME);
	mysql_query('update message set isread = "YES" where toid=' . $senderId);
	$messageList = $messageObj->GetList(array(
		array('fromid','=',$senderId),		
		array('toid','=',$recieverId),
		array('weddingid','=',$weddingId),
		array('OR'),
		array('toid','=',$senderId),		
		array('fromid','=',$recieverId),
		array('weddingid','=',$weddingId),
		array('status','=','SHOW'),
	), 'messageid', false);
	$unreadCount = 0;
?>
					<input id='unreadCount' type='hidden' value='<?php echo 0;?>'/>
					<h2 class='messagesHeading'>Messages between You and <?php echo $supplier->name;?> for this wedding</h2>
					<table class='reviewTable'>
						<tbody>
							<tr class='reviewWordTr info messageYouTr'>
								<td class='reviewWordTd messageTdLeft' colspan='2'>
									<textarea class='myMessageTextArea'></textarea><br/>
									<a class='bidLink sendButton' href='javascript:sendMessage(<?php echo $senderId . ' , ' . $recieverId  . ' , ' . $weddingId;?>);'>Send</a>
								</td>
							</tr>											
						</tbody>							
							<?php foreach($messageList as $message){
							?>
							<tbody>
								<tr class='reviewSeparator'>
									
								</tr>	
							</tbody>
							<tbody class='reviewWordTr triangle-isosceles <?php if($message->fromId == $recieverId) echo 'messageHimTr right success triangle-right'; else echo 'messageYouTr left info triangle-left';?>'>	
							<tr>
								<td style='width: 375px;' class='reviewTdLeft messageTdLeft'>
									<img style='margin-right:10px;float:left;' src='<?php $url=$message->fromId == $recieverId ? 'supplier/'. $recieverId : 'buyer/' . $senderId;echo URL . '/img/'. $url . '_thumb.jpg'; ?>' alt='profile'>
									<span style='float:left;padding-top:10px;'><?php if($message->fromId == $recieverId) echo $supplier->name; else echo 'You';?></span>
								</td>
								<td style='padding-top:10px;' class='reviewTdRight messageTdRight'><?php echo date('d-M-Y', strtotime($message->date));?></td>
							</tr>	
							<tr>
								<td class='reviewWordTd messageTdLeft' colspan='2'><?php
								echo $message->content;?></td>
							</tr>
							</tbody>
							<?php } ?>	
					</table>
                    <div style='clear:both;'></div>	
                
				