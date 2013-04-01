<?php
session_start();
require_once('../config.php');
if(isset($_SESSION['admin'])){
	header('location: products.php');
}
$message = '';
if(isset($_POST['username'], $_POST['password'])){
	if($_POST['username'] == ADMIN && $_POST['password'] == ADMIN_PASSWORD){
		$_SESSION['admin'] = true;
		header('location: products.php');
	}
	else{
		$message = 'Invalid Username/Password';
	}
}
$admin = true;
require('../includes/header.php');
require('../includes/left.php');
require('../includes/admin-login.php');
require('../includes/right.php');
require('../includes/footer.php');
?>