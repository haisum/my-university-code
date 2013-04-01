<?php
require_once 'config/config.php';
require 'includes/secureLogin.php';
require 'includes/securePasswordChange.php';
require 'includes/secureSupplierBuyer.php';
if($_SESSION['type'] == 'Supplier'){
	require 'supplier-account.php';
}
else if($_SESSION['type'] == 'Buyer'){
	require 'buyer-account.php';
}
?>
  