<?php
session_start();
require_once('../config.php');
require_once('../includes/admin-secure.php');
if(isset($_POST['prodname'], $_POST['price'])){
	require_once('../includes/functions.php');	
	if(isset($_POST['editid'])){
		update('product', array('productname' => $_POST['prodname'],
			'price' => $_POST['price'],
			'categoryid' => $_POST['categoryid'],
		), 'productid', intval($_POST['editid']));
		header('location: products.php');
	}
	else{
		insert('product', array('productname' => $_POST['prodname'],
		'categoryid' => $_POST['categoryid'],
		'price' => $_POST['price'],
		));
		header('location: products.php');
	}
}
if(isset($_POST['prodname']) && trim($_POST['prodname']) == ''){//error can't have blank prod name
	if(isset($_POST['editid'])){
		header('location: edit-category.php?edit=' . $_POST['editid']);
	}
	else{
		header('location: edit-category.php');
	}
}
$admin = true;
require('../includes/header.php');
require('../includes/left.php');
require('../includes/admin-edit-product.php');
require('../includes/right.php');
require('../includes/footer.php');
?>