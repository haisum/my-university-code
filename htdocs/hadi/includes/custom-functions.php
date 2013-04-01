<?php
function login($user, $pass){
	$user= escape($user);
	$pass = escape($pass);
	$result = mysql_query("select * from user where `name` = $user AND password = SHA1($pass) LIMIT 1");
	$data['status'] = mysql_num_rows($result);
	$row = mysql_fetch_array($result);
	$data['user'] = ucfirst(strtolower($row['name']));
	$data['role'] = ucfirst(strtolower($row['role']));
	
	if($data['role'] == 'Coordinator'){
		$query = 'SELECT programid FROM cord WHERE userid = ' . $row['userid'];
		$result = mysql_query($query);
		if(mysql_num_rows($result) > 0){
			$row = mysql_fetch_array($result);
			$data['programid'] = $row['programid'];
		}
	}	
	if($data)
		return $data;
}
function getBatches($programId=2, $select = false){
    $query ="SELECT
			  batch.*,
			  programname,
			  CONCAT(batch.batchname, ' ', batch.semester, ' [', batch.section, '] ') AS heading
			FROM batch,
			  program
			WHERE batch.programid = $programId
				AND batch.programid = program.programid
			ORDER BY batch.semester, batch.section;";
	$result = mysql_query($query);
	$data = array();
	while($row = mysql_fetch_array($result)){
		if(!$select)
			$data[] = $row;
		else
			$data[$row['batchid']] = $row['heading'];
	}
	return $data;
}

function getSchedule($batchid, $slotid, $day){
	$query = "SELECT
		  `schedule`.*,
		  teacher.teachername,
		  course.coursename,
		  slot.duration
		FROM `schedule`,
		  teacher,
		  course,
		  slot
		where schedule.slotid = $slotid
			AND schedule.batchid = $batchid
			AND schedule.day = '$day'
			AND fromdate <= NOW()
			AND todate >= NOW()
			AND teacher.teacherid = schedule.teacherid
			AND course.courseid = schedule.courseid
			AND slot.slotid = schedule.slotid;"; 
	$result = mysql_query($query);
	if(mysql_num_rows($result) != 0){		
		return mysql_fetch_array($result);
	}
	else
		return false;
}
function getDays(){
	return array('Mon' => 'Mon','Tue' => 'Tue', 'Wed' => 'Wed','Thu' => 'Thu','Fri' => 'Fri','Sat' => 'Sat','Sun' => 'Sun');
}
function getSlots($select = false){
	$query = 'SELECT * from slot';
	$result = mysql_query($query);
	$slots = array();
	while($row = mysql_fetch_array($result)){
		if(!$select){
			$slots[] = array(
				'slotid' => $row['slotid'],
				'duration'  => $row['duration']
			);
		}
		else{
			$slots[$row['slotid']] = $row['duration'];
		}
	}
	return $slots;
}

function getUniqueRoom($slotId, $day, $batchId){	
	$roomstart = getOne('value', 'config', 'name="roomstart"');
	$roomend = getOne('value', 'config', 'name="roomend"');
	$roomid = null;
	while($roomid == null){		
		$rand = intval(rand($roomstart, $roomend));		
		$temp = checkReserved($rand, $slotId, $day, $batchId);
		if($temp == 0){
			$roomid = $rand;
		}
		else if($temp == -1){
			$roomid = -1;
		}
	}
	return $roomid;
}

function getPrograms(){
	$query = 'SELECT * FROM program order by programname';
	$result = mysql_query($query);
	$programs = array();
	while($row=mysql_fetch_array($result)){
		$programs[$row['programid']] = $row['programname'];
	}
	return $programs;
}

/*function unallocateRoom($slotid, $day){
	$query = "update schedule set room=0 WHERE slotid=$slotid AND day=$day AND fromdate <= NOW() 
		  AND todate >= NOW();";
    mysql_query($query);
}*/

function getTeachers(){
	$query = 'select * from teacher order by teachername';
	$result = mysql_query($query);
	$data = array();
	while($row = mysql_fetch_array($result)){
		$data[$row['teacherid']] = $row['teachername'];
	}
	return $data;
}
function getCourses(){
	$query = 'select * from course order by coursename';
	$result = mysql_query($query);
	$data = array();
	while($row = mysql_fetch_array($result)){
		$data[$row['courseid']] = $row['coursename'];
	}
	return $data;
}

function checkReserved($room, $slot, $day, $batchid){
/*
SELECT * FROM `schedule` WHERE room = 34 AND slotid = 1 AND `day` = 'Mon' AND fromdate<=NOW() AND todate >= NOW()
*/
	$query = "SELECT schedule.*,teacher.teachername,
		  course.coursename,
		  slot.duration,
		  CONCAT(batch.batchname, ' ', batch.semester, ' [', batch.section, '] ') AS heading
		FROM `schedule`,
		  teacher,
		  course,
		  slot,
		  batch
		  WHERE room = $room
		  AND schedule.slotid = $slot
		  AND `day` = '$day'
		  AND fromdate <= NOW() 
		  AND todate >= NOW()
		  AND teacher.teacherid = schedule.teacherid
		  AND course.courseid = schedule.scheduleid
		  AND slot.slotid = schedule.slotid
		  AND schedule.batchid = batch.batchid;";	
	$result = mysql_query($query);
	echo mysql_error();
	if(mysql_num_rows($result) != 0){
		return mysql_fetch_array($result);
	}
	else{	
		$query = "SELECT * from schedule where batchid={$batchid} AND slotid = {$slot} AND day = '{$day}'";
		$result = mysql_query($query);
		if(mysql_num_rows($result) != 0){
			return -1;
		}
		else
			return 0;
	}
}

?>