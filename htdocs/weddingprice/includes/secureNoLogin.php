<?php
if(isset($_SESSION['userId'])){
	header('Location: ' . URL . '/page-not-found.php');
	exit();
}
?>