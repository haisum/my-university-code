<?php
require_once 'config/config.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.supplier.php';
require_once 'classes/database/objects/class.goldpayment.php';
if(!isset($_REQUEST['payment_status'], $_REQUEST['custom'])){
	die('Not Authorized');
}

$gp = new GoldPayment();
$gp->Get($_REQUEST['custom']);
if($_REQUEST['payment_status'] == 'Pending' || $_REQUEST['payment_status'] == 'Completed'){
	$gp->status = 'VERIFIED';
	$temp = '';
	foreach($_REQUEST as $key=>$value){
		$temp .= "$key=$value||";
	}
	$gp->responseArray = $temp;
	$gp->Save();
	$supplier = new Supplier();
	$supplier->Get($gp->supplierId);
	$supplier->accountType = 'GOLD';
	$supplier->goldExpires = $gp->expireDate;
	$supplier->Save();
	require_once 'classes/database/objects/class.emailtemplate.php';
	require 'classes/Mail.php';
	$mail = new Mail();
	$mail->goldPaymentReceived($supplier->salesEmail);
}
?>