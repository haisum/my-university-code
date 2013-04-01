<?php		
	session_start();
	require_once('config.php');	
	if(isset($_GET['addtocart'])){
		if(!isset($_SESSION['products'][$_GET['addtocart']])){
			$_SESSION['products'][$_GET['addtocart']] = 1;
		}
		else{
			$_SESSION['products'][$_GET['addtocart']] = (int) $_SESSION['products'][$_GET['addtocart']] + 1;			
		}
		if(isset($_SESSION['total_products'] )){
			$_SESSION['total_products'] = (int) $_SESSION['total_products'] + 1;
		}
		else{
			$_SESSION['total_products'] = 1;
		}
		header('location: index.php');
	}
	else if(isset($_GET['clearcart'])){
		unset($_SESSION['products']);
		$_SESSION['total_products']  = 0;
	}
	require('includes/header.php');
	require ('includes/left.php');
	require ('includes/center.php');
	require ('includes/right.php');
	require ('includes/footer.php');
?>
		