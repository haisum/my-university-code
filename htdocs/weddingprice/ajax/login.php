<?php
require_once '../config/config.php';
require_once '../classes/database/objects/class.database.php';
require_once '../classes/database/objects/class.user.php';

$user = new User();
$password = sha1($_POST['password']);
$email = $_POST['email'];
$userList = $user->GetList(array(array('email' , '=', $email),  array('deleted', '=', 'No')), '', true, 1);

	//echo $user->pog_query . ' ' . $userList[0]->userId;
if(count($userList) == 0){
	$loginError = "<p>Email address not registered.</p>";
}
else if($userList[0]->password == $password){
	$_SESSION['userId'] = $userList[0]->userId;
	$_SESSION['isActive'] = $userList[0]->isActive;
	$_SESSION['type'] = $userList[0]->type;
	$userList[0]->lastLogin = strftime("%y-%m-%d %H:%M:%S");
	$userList[0]->Save();
	if($userList[0]->type == 'Supplier'){
		require_once '../classes/database/objects/class.supplier.php';
		$supplierObj = new Supplier();
		$supplierList = $supplierObj->GetList(array(
				array('userid' , '=', $userList[0]->userId)
		), '', true, 1);
		$_SESSION['supplierId'] = $supplierList[0]->supplierId;
		$_SESSION['sAccountType'] = $supplierList[0]->accountType;
	}
	else if($userList[0]->type == 'Buyer'){
		require_once '../classes/database/objects/class.buyer.php';
		$buyerObj = new Buyer();
		$buyerList = $buyerObj->GetList(array(
				array('userid' , '=', $userList[0]->userId)
		), '', true, 1);
		$_SESSION['buyerId'] = $buyerList[0]->buyerId;
	}	
	/*if($_POST['remember'] == 'true'){
		setcookie('haisum', $email , time() + (3600 * 24 * 30) , '/');
		setcookie('password', $password , time() + (3600 * 24 * 30), '/');
		echo "alllaaaad";
		print_r($_COOKIE); 
	}*/
	$loginError = "true";
}
else{
	$loginError = "<p>Incorrect Password.</p>";
}
echo $loginError;
?>