<?php
if(isset($_SESSION['isActive']) && $_SESSION['isActive'] == 'No'){
    header('Location: ' . URL . '/change-password.php');
	exit();
}
?>