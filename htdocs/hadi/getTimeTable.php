<?php  
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/custom-functions.php';
$programId = 2;
if(isset($_REQUEST['programId']) && is_numeric($_REQUEST['programId'])){
	$programId = intval($_REQUEST['programId']);
}
$batches = getBatches($programId);
$days = getDays();
$slots = getSlots();
?>
<input type='hidden' value='<?=$programId?>' id='cProgramId'/>
<table border="1" style=" font-family:tahoma; border-collapse:collapse; " bordercolor="#666666" width="1600">
		<tr align="center" style="font-weight:bold; font-size:75%;" bgcolor="#E2E2E2">
			<td width="100" height="35">
				Days
			</td>
			<td width="150" height="35">
				Time Slots
			</td>
			<?php foreach($batches as $batch){ ?>
				<td id="batch-<?=$batch["batchid"]?>" width="200"><?=$batch["heading"]?></td>
			<?php } ?>
		</tr>
		<?php foreach($days as $day){ ?>
			<tr>
			<td height="35" rowspan="6" align="center" style="font-weight:bold;">
				<?=$day?><br/>
			</td>
		<?php 
			foreach($slots as $slot){ 
		?>			
			<td id="slot-<?=$slot['slotid']?>" class='slot' style="font-size:75%;" align="center" height="55" bgcolor="#E2E2E2">
				<?=$slot['duration']?>
			</td>
		<?php
			foreach($batches as $batch){
				$info = '';
				$scheduleId = 0;
				$room = 0;
				$courseId = '';
				$schedule = getSchedule($batch['batchid'], $slot['slotid'], $day);
				if($schedule){
					$scheduleId = $schedule['scheduleid'];
					$room = $schedule['room'];
				}	
				?>
			<td width="200" id="slot-<?=$slot['slotid'] . '-' . $batch['batchid'] . '-' . $scheduleId . '-' . $day . '-' . $room?>" align="center" style="cursor:pointer; font-size:55%;">	
			<?php if($schedule){ ?>
				<span style="text-decoration:underline; color:#000000"><?=$schedule['coursename']?></span><br>
				<span style="/*text-decoration:underline;*/ color:#000000">(<?=$schedule['teachername']?>)</span><br>
				<span style=" font-family:calibri; color:#000000">Room #: <?=$schedule['room']?></span><br>
			<?php } ?>
			</td>		
			<?php } ?>
		</tr>
			<?php } ?>
		<tr bgcolor="#E2E2E2" height="5">
			<td>
			</td>
			<td>
			</td>
		<?php foreach($batches as $batch){ ?>
			<td></td>
		<?php } ?>
		</tr>
		<?php } ?>
</table>