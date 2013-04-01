<?php
if(!(isset($_SESSION['type']) && $_SESSION['type'] != 'Buyer' && $_SESSION['type'] != 'Supplier')){
	header("Location: " . URL . "/page-not-found.php");
	exit();
}
?>