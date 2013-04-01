<?php
if(!(isset($_SESSION['type']) && $_SESSION['type'] == "Buyer")){
	header("Location: " . URL . "/page-not-found.php");
	exit();
}
?>