<?php 
  require_once 'includes/config.php';
  require_once 'includes/functions.php';
  require_once 'includes/custom-functions.php';
  if(!isset($_SESSION['role'], $_REQUEST['slotId'],$_REQUEST['day'],$_REQUEST['scheduleId'])){
	die('Not enough data');
  }
  $slotId = intval($_REQUEST['slotId']);
  $scheduleId = intval($_REQUEST['scheduleId']);
  $day = $_REQUEST['day'];    
  $roomId = intval($_REQUEST['roomId']);
  $status = checkReserved($roomId, $slotId, $day, $_POST['batchId']);
  if($status == 0){
	$data = array();
	if($_SESSION['role'] == 'Admin'){
		$data = array('day' => $day, 'slotid' => $slotId, 'room' => $roomId);		
	}
	else if($_SESSION['role'] == 'Coordinator'){
		$data = array('day' => $day, 'slotid' => $slotId, 'batchid' => $_POST['batchId'], 'teacherid' => $_POST['teacherId'], 'courseid' => $_POST['courseId']);
	}
	update('schedule', $data , 'scheduleid', $scheduleId);
	echo '1' . mysql_error();
  }
  else if($status == -1){
	echo 'Batch already having class at given slot and day';
  }
  else{
	echo 'Room already reserved for ' . $result['coursename'] . ', ' . $result['teachername'] . ', ' . $result['heading'];
  }
 ?>