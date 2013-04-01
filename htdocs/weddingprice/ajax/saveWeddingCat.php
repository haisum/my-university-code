<?php
require_once '../config/config.php';
require_once '../classes/database/objects/class.database.php';
require_once '../classes/database/objects/class.weddingcategory.php';
if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Buyer'){
	die('NOT AUTHORIZED');
}
if(!is_numeric($_REQUEST['id'])){
	die('Error');
}
$id = intval($_REQUEST['id']);
$c = new WeddingCategory();
$c->Get($id);
$c->detail = $_REQUEST['detail'];
$c->budgetTo = $_REQUEST['budgetTo'];
$c->budgetFrom = $_REQUEST['budgetFrom'];
$c->Save();
?>

