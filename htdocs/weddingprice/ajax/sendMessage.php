<?php
require_once '../config/config.php';
	require_once '../includes/secureLogin.php';
	require_once '../includes/securePasswordChange.php';
	if(($_SESSION['type'] != 'Buyer' && $_SESSION['type'] != 'Supplier') && !isset($_REQUEST['recieverId'], $_REQUEST['senderId'],$_REQUEST['weddingId']) || !is_numeric($_REQUEST['recieverId']) || !is_numeric($_REQUEST['senderId']) || !is_numeric($_REQUEST['weddingId'])){
		die('You are not authorized to perform this action!');
	}
	$from = $_SESSION['type'];	
	$recieverId = $_REQUEST['recieverId'];
	$weddingId = $_REQUEST['weddingId'];
	$senderId = $_REQUEST['senderId'];	
	$content = htmlspecialchars(trim($_REQUEST['content']));	
	if($content == '')
		exit;
	require_once '../classes/database/objects/class.database.php';
	require_once '../classes/database/objects/class.message.php';
	$message = new Message();
	$message->fromId = $senderId;
	$message->toId = $recieverId;
	$message->content = $content;
	$message->date = strftime('%y-%m-%d %H:%M:%S', time());
	$message->isRead  = 'NO';
	$message->status = 'SHOW';
	$message->weddingId = $weddingId;
	$message->from = $from;
	$message->Save();
	echo $message->pog_query;
?>
