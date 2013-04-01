<?php
session_start();
require_once('../config.php');
require_once('../includes/admin-secure.php');
if(isset($_GET['delete'])){
	require_once('../includes/functions.php');
	delete('product', 'productid', $_GET['delete']);
}
$admin = true;
require('../includes/header.php');
require('../includes/left.php');
require('../includes/admin-products.php');
require('../includes/right.php');
require('../includes/footer.php');
?>