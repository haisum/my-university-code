<?php
require_once 'config/config.php';
//require_once 'includes/secureLogin.php';
//require_once 'includes/securePasswordChange.php';
//require_once 'includes/secureBuyer.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.wedding.php';
$buyerId = $_SESSION['buyerId'];
$data = array();
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . 'img/weddings' . '/';
	$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
	
	 //$fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	 //print_r($fileTypes);
	 $fileTypes  = 'jpeg;jpg;gif;bmp;png;';
	 $fileTypes  = str_replace(';','|',$fileTypes);
	 $typesArray = @split('\|',$fileTypes);
	 $fileParts  = pathinfo($_FILES['Filedata']['name']);
	 if (in_array(strtolower($fileParts['extension']),$typesArray) && $_FILES['Filedata']['size'] < 7340032 /*&& isset($_REQUEST['id'])  && is_numeric($_REQUEST['id'])*/ ){
		$id = $_REQUEST['id'];
		if($_REQUEST['id'] == '-1'){	
			$weddingObj = new Wedding();
			$weddingList = $weddingObj->GetList(array(), 'weddingid', false, 1);
			$wedding = $weddingList[0];
			$id = $wedding->weddingId;
		}
		else{
			$weddingObj = new Wedding();
			$weddingList = $weddingObj->GetList(array(array('weddingid','=',$id)));
			if(count($weddingList) != 1)
			{
				$error = array('error' => 'Wedding Doesn\'t exist! id: '. $id);
				echo json_encode($error);
				exit();
			}
		}
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		//$targetFile =  str_replace('//','/',$targetPath) . $id . '_original.jpg';		
		$targetFile = 'img/weddings/' . $id . '_original.jpg';
		move_uploaded_file($tempFile,$targetFile);
		$fileInfo =  pathinfo($targetFile);
		$data['fileName'] = $fileInfo['basename'];
		include_once("classes/ResizeImage.php");		
		$rimg=new ResizeImage($targetFile);
		$data['resizeError'] = $rimg->error();
		$rimg->resize(30, 30, 'img/weddings/' . $id . '_thumb.jpg');
		$rimg->resize_limitwh(120, 120, 'img/weddings/' . $id . '.jpg');
		$rimg->close();		
		$data['id'] = $id;
		$data['image'] = $id . '.jpg';
		$data['thumb'] = $id . '_thumb.jpg';
		$data['error'] = '';
	 } else {
	 	$data['error'] = "Invalid file type ( only PNG, JPG, GIF, BMP) or size (MAX 7MB), or wedding category doesn't exist!";
	 }
	 echo json_encode($data);
	 //echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
}
?>