<?php 
	require_once '../../config/config.php';
	require_once '../../includes/secureLogin.php';
	require_once '../../includes/securePasswordChange.php';
	if(($_SESSION['type'] != 'Buyer' && $_SESSION['type'] != 'Supplier') || !isset($_GET['weddingId']) || !is_numeric($_GET['weddingId'])){
		die('You are not authorized to perform biiyeh this action!' . ($_SESSION['type'] != 'Buyer' && $_SESSION['type'] != 'Supplier') . ' ' . $_GET['weddingId']);
	}
	$weddingId = $_GET['weddingId'];		
	require_once '../../classes/database/objects/class.database.php';
	require_once '../../classes/database/objects/class.buyer.php';	
	require_once '../../classes/database/objects/class.message.php';
	require_once '../../classes/database/objects/class.wedding.php';
	
	$wedding = new Wedding();
	$wedding->Get($weddingId);
	$buyerId = $wedding->buyerId;
	$buyer = new Buyer();
	$buyer->Get($buyerId);
	$supplierId = $_SESSION['supplierId'];	
	
	$messageObj = new Message();
	mysql_connect(HOST, USER, PASSWORD);
	mysql_select_db(DBNAME);
	mysql_query('update message set isread = "YES" where toid=' . $supplierId);
	$messageList = $messageObj->GetList(array(
		array('fromid','=',$supplierId),		
		array('toid','=',$buyerId),
		array('weddingid','=',$weddingId),
		array('OR'),
		array('toid','=',$supplierId),		
		array('fromid','=',$buyerId),
		array('weddingid','=',$weddingId),
		array('status','=','SHOW'),
	), 'messageid', false);
	$unreadCount = 0;
?>				     <input id='unreadCount' type='hidden' value='<?php echo 0;?>'/>
					<h2 class='messagesHeading'>Messages between You and <?php if($buyer->name == '') echo 'Anonymous User'; else echo $buyer->name;?></h2>
					<table class='reviewTable'>
						<tbody>
							<tr class='reviewWordTr info messageYouTr'>
								<td class='reviewWordTd messageTdLeft' colspan='2'>
									<textarea class='myMessageTextArea'></textarea><br/>
									<a class='bidLink sendButton' href='javascript:sendMessage(<?php echo $supplierId . ' , ' . $buyerId . ' , ' . $weddingId;?>);'>Send</a>
								</td>
							</tr>
											
						</tbody>							
							<?php foreach($messageList as $message){
							?>
							<tbody>
							<tr class='reviewSeparator'>
								
							</tr>							
																		
						</tbody>
						<tbody class='reviewWordTr triangle-isosceles <?php if($message->fromId == $buyerId) echo 'messageHimTr right success triangle-right'; else echo 'messageYouTr left info triangle-left';?>'>
							<tr>
								<td style='width: 375px;' class='reviewTdLeft messageTdLeft'>
									<img style='margin-right:10px;float:left;' src='<?php $url=$message->fromId == $buyerId ? 'buyer/'. $buyerId : 'supplier/' . $supplierId;echo URL . '/img/'. $url . '_thumb.jpg'; ?>' alt='profile'>
									<span style='float:left;padding-top:10px;'><?php if($message->fromId == $buyerId) echo $buyer->name; else echo 'You';?></span>
								</td>
								<td style='padding-top:10px;' class='reviewTdRight messageTdRight'><?php echo date('d-M-Y', strtotime($message->date));?></td>
							</tr>	
							<tr >
								<td class='reviewWordTd messageTdLeft' colspan='2'><?php
								echo $message->content;?></td>
							</tr>
																		
						</tbody>
							<?php } ?>	
					</table>
                    <div style='clear:both;'></div>	
                
				