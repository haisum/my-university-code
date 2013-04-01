<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/custom-functions.php';
if(!isset($_REQUEST['roomId'],$_REQUEST['slotId'],$_REQUEST['day'], $_POST['batchId'])){
	die('Not enough data');
}
$roomId = intval($_REQUEST['roomId']);
$slotId = intval($_REQUEST['slotId']);
$day = escape($_REQUEST['day']);
if($roomId == 0)
	echo 0;
else{
		$data = checkReserved($roomId, $slotId, $day , $_POST['batchId']);
		if(is_array($data)){
			echo json_encode($data);
		}
		else
			echo $data;
	}
?>