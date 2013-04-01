<?php	
	session_start();
	if(!(isset($_SESSION['admin_id']))){
		header('Location: ' . URL . '/admin/index.php');
		exit;
	}
?>