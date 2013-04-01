<?php 
  require_once 'includes/config.php';
  require_once 'includes/functions.php';
  require_once 'includes/custom-functions.php';
  if(!isset($_SESSION['role'], $_SESSION['programid']) || $_SESSION['role'] != 'Coordinator'){
	die('Not enough data');
  }
  $programId = intval($_SESSION['programid']);
 ?>
 <div id='add-dialog' title="Add Schedule">
	<form action='javascript:void(0);'>
			<div class='form-box'>
				<label class='form-label' >Course</label>		
				<?=select(getCourses(), '', 'add-course', 'add-course', 'text form-input');?>
			</div>		
			<div class='form-box'>
				<label class='form-label' >Teacher</label>		
				<?=select(getTeachers(), '', 'add-teacher', 'add-teacher', 'text form-input');?>
			</div>	
			<div class='form-box'>
				<label class='form-label' >Batch</label>		
				<?=select(getBatches($programId, true), '', 'add-batch', 'add-batch', 'text form-input');?>
			</div>
		<div class='form-box'>
			<label class='form-label' >Slot</label>
			<?=select(getSlots(true), '', 'add-slot', 'add-slot', 'text form-input');?>
		</div>	
		<div class='form-box'>
			<label class='form-label' >Day</label>
			<?=select(getDays(), '', 'add-day', 'add-day', 'text form-input');?>
		</div>	
		<input type='hidden' value='<?=$programId?>' id='add-programid'/>
	</form>
 </div>