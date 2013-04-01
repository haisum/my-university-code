<?php
$filename =  basename($_SERVER['SCRIPT_FILENAME']);
if(!isset($_SESSION['userId'])){	
	$_SESSION['page'] = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"] . '?' . $_SERVER["QUERY_STRING"];
	header('Location: ' . URL . '/login.php');
	//echo $_SESSION['page'];
	//print_r($_SESSION);
	exit();
}

?>