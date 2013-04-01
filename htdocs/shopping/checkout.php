<?php		
	session_start();
	require_once('config.php');	
	if(isset($_GET['removeall'])){
		$_SESSION['total_products'] = (int) $_SESSION['total_products'] - $_SESSION['products'][$_GET['removeall']];
		unset($_SESSION['products'][$_GET['removeall']]);
	}
	else if(isset($_GET['removeone'])){
		$_SESSION['total_products'] = (int) $_SESSION['total_products'] - 1;
		$_SESSION['products'][$_GET['removeone']] = (int)$_SESSION['products'][$_GET['removeone']] - 1;
	}
	$errors = array();
	if(isset($_POST['customername'])){
		if(trim($_POST['customername']) == '')	
		{
			$errors['customername'] = 'Customer name can not be blank';
		}
		if(trim($_POST['address']) == '')	
		{
			$errors['address'] = 'Address can not be blank';
		}
		if(trim($_POST['cardnumber']) == '')	
		{
			$errors['cardnumber'] = 'Card Number can not be blank';
		}
		if(count($errors) == 0){
			require_once('includes/functions.php');
			$data = array(
				'totalitems' => $_SESSION['total_products'],
				'customername'=> $_POST['customername'],
				'address' => $_POST['address'],
				'cardnumber'=> $_POST['cardnumber'],
				'cardtype' => $_POST['cardtype'],
				'date' => time(),
			);
			insert('order', $data);
			$orderid = mysql_insert_id();
			foreach($_SESSION['products'] as $key => $value){
				$data = array(
					'orderid' => $orderid,
					'productid' => $key,
					'quantity' => $value,
				);
				insert('orderproduct', $data);
			}
			unset($_SESSION['products']);
			$_SESSION['total_products'] = 0;
			header('location: index.php');
		}
	}
	require('includes/header.php');
	require ('includes/left.php');
	require_once ('includes/functions.php');
	require ('includes/checkout.php');
	require ('includes/right.php');
	require ('includes/footer.php');
?>
		