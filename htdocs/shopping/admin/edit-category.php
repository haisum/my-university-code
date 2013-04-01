<?php
session_start();
require_once('../config.php');
require_once('../includes/admin-secure.php');
if(isset($_POST['catname']) && trim($_POST['catname']) != ''){
	require_once('../includes/functions.php');
	if(isset($_POST['editid'])){
		updateOneValue('category', 'categoryname', $_POST['catname'], 'categoryid', $_POST['editid']);
		header('location: categories.php');
	}
	else{
		insert('category', array('categoryname' => $_POST['catname']));
		header('location: categories.php');
	}
}
if(isset($_POST['catname']) && trim($_POST['catname']) == ''){//error can't have blank cat name
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
require('../includes/admin-edit-category.php');
require('../includes/right.php');
require('../includes/footer.php');
?>