<?php
require_once 'config/config.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.supplier.php';
//require_once 'includes/secureSupplier.php';

$supplierId = $_SESSION['supplierId'];


$supplier = new Supplier();
$supplier->Get($supplierId);
if($supplier->accountType != 'PAYMENTNOTVERIFIED' && $supplier->accountType != 'GOLD'){
	header('Location: ' . URL . '/page-not-found.php');
	exit;
}
require_once 'classes/database/objects/class.goldpayment.php';
require_once 'includes/function.getconfig.php';
$package = intval($_GET['period']);
$goldPayment = new GoldPayment();
$goldPayment->supplierId = $supplierId;
if($package == 3 || $package == 6 || $package == 12)
	$goldPayment->package = $package;
else
	$goldPayment->package = 3;
switch($goldPayment->package){
	case 3:
		$goldPayment->amount = getConfig('3monthpackage');
		break;
	case 6:
		$goldPayment->amount = getConfig('6monthpackage');
		break;
	case 12:
		$goldPayment->amount = getConfig('12monthpackage');
		break;
	default :
		$goldPayment->amount = getConfig('3monthpackage');
		break;
}
$goldPayment->status = 'PENDING';
$goldPayment->date = date('Y-m-d H:i:s', time());
//$goldPayment->expireDate = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s', time()) . "+$package month"));
$expired = strtotime($supplier->goldExpires);
if($expired > time() && $supplier->accountType = 'GOLD'){
	$goldPayment->expireDate  = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s', $expired) . "+$package month"));
}
else{
	$goldPayment->expireDate  = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s', time()) . "+$package month"));
}
$goldPayment->responseArray= '';
$goldPayment->Save();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title>Wedding Price | Gold Membership Payment</title>

    </head>

    <body>

<font face='Arial, Helvetica, sans-serif' size='2'>Please wait while you're being redirected to PayPal!</font></div>
<form action="<?php echo getConfig('paypalactionurl'); ?>" method="post" name="paypal" id="paypal"> 
	<input type="hidden" name="business" value="<?php echo getConfig('paypalaccountemail'); ?>"/>
	<input type="hidden" name="cmd" value="_xclick"/> 
	<input type="hidden" name="return" value="<?php echo URL; ?>/gold-payment-confirmation.php"/> 
	<input type="hidden" name="notify_url" value="<?php echo URL; ?>/paypal-return-goldmembershippayment.php">
	<input type="hidden" name="image_url" value="<?php echo URL; ?>/img/logo.png">
	<input type="hidden" name="currency_code" value="NZD">
	<input type="hidden" name="custom" value="<?php echo $goldPayment->goldpaymentId; ?>">
	<input type="hidden" name="item_name" value="Wedding Price | Gold Membersip Payment">
	<input type="hidden" name="amount" value="<?php echo $goldPayment->amount; ?>">
</form>
<script>
setTimeout("document.paypal.submit();",500);
</script>
</body>
</html>