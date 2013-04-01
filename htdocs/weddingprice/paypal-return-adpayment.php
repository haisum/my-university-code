<?php
require_once 'config/config.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.specialoffer.php';
require_once 'classes/database/objects/class.supplier.php';
require_once 'classes/database/objects/class.paypaladpayment.php';
require_once 'classes/database/objects/class.emailtemplate.php';
require 'classes/Mail.php';
if(!isset($_REQUEST['payment_status'], $_REQUEST['custom'])){
	die('Not Authorized');
}

$sp = new SpecialOffer();
$sp->Get($_REQUEST['custom']);
if($_REQUEST['payment_status'] == 'Pending' || $_REQUEST['payment_status'] == 'Completed'){
	$sp->status = 'ACTIVE';
	$sp->Save();
	$pp = new PaypalAdPayment();
	$temp = '';
	foreach($_REQUEST as $key=>$value){
		$temp .= "$key=$value||";
	}
	$pp->content = $temp;
	$pp->specialofferid = $sp->specialofferId;
	$pp->Save();
	$supplier = new Supplier();
	$supplier->Get($sp->supplierId);
	$mail = new Mail();
	$mail->adPaymentReceived($supplier->salesEmail);
}

?>