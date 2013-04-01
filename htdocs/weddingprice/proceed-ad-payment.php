<?php
require_once 'config/config.php';
require_once 'includes/function.getconfig.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.specialoffer.php';
require_once 'includes/secureSupplier.php';

if(!isset($_GET['token']) || intval($_GET['token']) == 0){
	header('Location: ' . URL . '/page-not-found.php');
	exit;
}

$spId = intval($_GET['token']);
$supplierId = $_SESSION['supplierId'];

$sp = new SpecialOffer();
$sp->Get($spId);
if($sp->supplierId != $supplierId)
{
	header('Location: ' . URL . '/page-not-found.php');
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title>Wedding Price | Proceed Special Offer Payment</title>

    </head>

    <body>

<font face='Arial, Helvetica, sans-serif' size='2'>Please wait while you're being redirected to PayPal!</font></div>
<form action="<?php echo getConfig('paypalactionurl'); ?>" method="post" name="paypal" id="paypal"> 
	<input type="hidden" name="business" value="<?php echo getConfig('paypalaccountemail'); ?>"/>
	<input type="hidden" name="cmd" value="_xclick"/> 
	<input type="hidden" name="return" value="<?php echo URL; ?>/ad-payment-confirmation.php"/> 
	<input type="hidden" name="notify_url" value="<?php echo URL; ?>/paypal-return-adpayment.php">
	<input type="hidden" name="image_url" value="<?php echo URL; ?>/img/logo.png">
	<input type="hidden" name="currency_code" value="NZD">
	<input type="hidden" name="custom" value="<?php echo $sp->specialofferId; ?>">
	<input type="hidden" name="item_name" value="Wedding Price | Advertising Payment">
	<input type="hidden" name="amount" value="<?php echo $sp->days * getConfig('adperdaycost'); ?>">
</form>
<script>
setTimeout("document.paypal.submit();",1000);
</script>
</body>
</html>