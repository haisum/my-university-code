<?php
  require_once 'includes/config.php';
  require_once 'includes/functions.php';
  require_once 'includes/custom-functions.php';
  $data = array();
  if(isset($_REQUEST['user'], $_REQUEST['password'])){
		$data = login($_POST['user'], $_POST['password']);
		if($data['status'] == 1){
			$_SESSION['user'] = $data['user'];
			$_SESSION['role'] = $data['role'];
			if(isset($data['programid'])){
				$_SESSION['programid'] = $data['programid'];
			}
		}
  }
  else if(isset($_SESSION['user'], $_SESSION['role'])){
		$data['status'] = 1;
		$data['user'] = $_SESSION['user'];
		$data['role'] = $_SESSION['role'];		
  }  
 else{
	$data['status'] = 0;
	$data['user'] = null;
	$data['role'] = null;		
 }
 echo json_encode($data);			
 exit;
?>