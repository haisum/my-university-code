<?php 
  require_once 'includes/config.php';
  require_once 'includes/functions.php';
  require_once 'includes/custom-functions.php';
  if(!isset($_SESSION['role'], $_SESSION['programid'], $_POST['slotid'],$_POST['day'],$_POST['batchid']) || $_SESSION['role'] != 'Coordinator'){
	die('Not enough data');
  }
  $slotid = intval($_POST['slotid']);
  $day = $_REQUEST['day'];  
  $batchid = intval($_POST['batchid']);
  $courseid = intval($_POST['courseid']);
  $teacherid = intval($_POST['teacherid']);
  $programid = intval($_SESSION['programid']);  
  $fromdate = date('Y-m-d H:i:s' , time());
  $todate = date('Y-m-d H:i:s' , strtotime($fromdate . '+6 months'));
  
  $room =  getUniqueRoom($slotid, $day, $batchid);
  if($room == -1){
	echo 'Batch already having class at given day and slot';
  }
  else{  
	  $data = array('fromdate' => $fromdate, 'todate' => $todate, 'room' => $room, 'programid' => $programid, 'day' => $day, 'slotid' => $slotid, 'batchid' => $batchid, 'teacherid' => $teacherid, 'courseid' => $courseid);
	  echo insert('schedule', $data) . mysql_error();	  
  }
 ?>