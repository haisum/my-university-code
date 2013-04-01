<?php
require_once '../config/config.php';
require_once '../includes/secureLogin.php';
require_once '../includes/securePasswordChange.php';
require_once '../includes/secureSupplier.php';
require_once '../classes/database/objects/class.database.php';
require_once '../classes/database/objects/class.bid.php';

if(!isset($_REQUEST['amount'], $_REQUEST['bidId'], $_REQUEST['bidCId']) || !is_numeric($_REQUEST['amount'])|| !is_numeric($_REQUEST['bidId']) || !is_numeric($_REQUEST['bidCId'])){
	die('Failed' . $_REQUEST['bidCId'] . ' ' . $_REQUEST['bidId'] . ' ' . $_REQUEST['amount'] );
}
$amount = intval($_REQUEST['amount']);
$bidId = $_REQUEST['bidId'];
$supplierId = $_SESSION['supplierId'];
$bid = new Bid();
$bid->Get($bidId);
if($bid->supplierId!=$supplierId){
	die('FAILED');
}
if($_REQUEST['bidCId'] == '0'){
	$bid->amount = $amount;
	$bid->Save();
	die('success');
}
echo 'success';
?>