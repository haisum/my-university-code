<?php 
if($_SESSION['sAccountType'] == 'OUTOFFREEBIDS' || $_SESSION['sAccountType'] == 'INVALIDURL'){
		header('Location: ' . URL . '/supplier-account-type.php');
}
?>