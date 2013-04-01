<?php
if($_SESSION['type'] != 'Buyer' && $_SESSION['type'] != 'Supplier'){
	header("Location: " . URL . "/register-type.php");
	exit();
}
?>