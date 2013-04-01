<?php
require_once '../config/config.php';

require_once '../includes/secureLogin.php';
require_once '../includes/securePasswordChange.php';
require_once '../classes/database/objects/class.database.php';
require_once '../classes/database/objects/class.weddingcategory.php';
require_once '../classes/database/objects/class.bid.php';
require_once '../classes/database/objects/class.message.php';

require_once '../classes/database/objects/class.buyer.php';
if(!isset($_REQUEST['weddingcategoryid']) && $_SESSION['type'] != "Supplier" && !is_numeric($_REQUEST['weddingcategoryid'])){
	exit();
}
$weddingCatId = intval($_REQUEST['weddingcategoryid']);
$amount = $_REQUEST['amount'];
$description = $_REQUEST['description'];
$message = $_REQUEST['message'];
$domessage = $_REQUEST['doMessage'];
$weddingcatObj = new WeddingCategory();
$weddingcatObj->Get($weddingCatId);
if($weddingcatObj->weddingcategoryId != $weddingCatId){
	die('no such request');
}
$error = '';
if($amount == 0 || !is_numeric($amount)){
	$error .= 'Invalid Amount<br/>';
}
if(trim($description) == ''){
	$error .= 'Give a little description of your bid!';
}
if($error != ''){
	die($error);
}
$categoryId = $weddingcatObj->categoryId;
$weddingId = $weddingcatObj->weddingId;
$supplierId = $_SESSION['supplierId'];
$bidObj = new Bid();
$bidObj->weddingId = $weddingId;
$bidObj->weddingcategoryId = $weddingCatId;
$bidObj->amount = intval($amount);
$bidObj->supplierId = $supplierId;
$bidObj->categoryId = $categoryId;
$bidObj->bidDescription = htmlspecialchars($description, ENT_QUOTES);
$bidObj->date = strftime('%Y-%m-%d %H:%M:%S', time());
$bidObj->lastModified = strftime('%Y-%m-%d %H:%M:%S', time());
$bidObj->status = 'PENDING';
$bidObj->Save();
if($domessage == true && trim($message) != ''){	
	require_once '../classes/database/objects/class.wedding.php';
	$weddingObj = new Wedding();
	$weddingObj->Get($weddingId);
	$message = new Message();
	$buyer = new Buyer();
	$buyer->Get($weddingObj->buyerId);
	$message->weddingId = intval($weddingId);
	$message->toId = $buyer->buyerId;
	$message->fromId = $supplierId;
	$message->isRead = 'NO';
	$message->content = htmlspecialchars($message, ENT_QUOTES);
	$message->status = 'SHOW';
	$message->date = date('y-m-d H:i:s' , time());
	$message->Save();
}
echo "success";
?>
