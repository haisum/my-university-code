<?php 
  require_once 'includes/config.php';
  require_once 'includes/functions.php';
  require_once 'includes/custom-functions.php';
  if(!isset($_SESSION['role'], $_REQUEST['roomId'],$_REQUEST['slotId'],$_REQUEST['day'],$_REQUEST['scheduleId'])){
	die('Not enough data');
  }
  $roomId = intval($_REQUEST['roomId']);
  if($roomId == 0){
	$roomId = '';
  }
  $slotId = intval($_REQUEST['slotId']);
  $scheduleId = intval($_REQUEST['scheduleId']);
  $day = escape($_REQUEST['day']);  
  $batchId = intval($_REQUEST['batchId']);  
  $courseId = 0;
  $teacherId = 0;
  $programId = 0;
  $result = mysql_query("select * from schedule where scheduleid=$scheduleId");
  if(mysql_num_rows($result) != 0){
	$row = mysql_fetch_array($result);
	$teacherId = $row['teacherid'];
	$courseId = $row['courseid'];
	$programId = $row['programid'];
  }
  else{	
	  $result = mysql_query("select * from batch where batchid=$batchId");
	  if(mysql_num_rows($result) != 0){
		$row = mysql_fetch_array($result);		
		$programId = $row['programid'];
	  }
  }
 ?>
 <div id='update-dialog' title="Update Schedule">
	<form action='javascript:void(0);'>
		<?php if($_SESSION['role'] == 'Coordinator'){ ?>
			<div class='form-box'>
				<label class='form-label' >Course</label>		
				<?=select(getCourses(), $courseId, 'update-course', 'update-course', 'text form-input');?>
			</div>		
			<div class='form-box'>
				<label class='form-label' >Teacher</label>		
				<?=select(getTeachers(), $teacherId, 'update-teacher', 'update-teacher', 'text form-input');?>
			</div>	
			<div class='form-box'>
				<label class='form-label' >Batch</label>		
				<?=select(getBatches($programId, true), $batchId, 'update-batch', 'update-batch', 'text form-input');?>
			</div>
		<?php }  else if($_SESSION['role'] == 'Admin'){ ?>
			<div class='form-box'>
				<label class='form-label' >Room</label>
				<input type='text' id='update-room' class='text numberOnly' value="<?=$roomId?>" />
			</div>	
		<?php } ?>
		<div class='form-box'>
			<label class='form-label' >Slot</label>
			<?=select(getSlots(true), $slotId, 'update-slot', 'update-slot', 'text form-input');?>
		</div>	
		<div class='form-box'>
			<label class='form-label' >Day</label>
			<?=select(getDays(), $_REQUEST['day'], 'update-day', 'update-day', 'text form-input');?>
		</div>	
	</form>
 </div>