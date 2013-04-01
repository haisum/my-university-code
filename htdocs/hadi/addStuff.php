<?php 
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/custom-functions.php';

if($_SESSION['role'] == 'Coordinator' && (isset($_POST['teachername']) || isset($_POST['subjectname']))){
	if(isset($_POST['teachername']))
		echo insert('teacher', array('teachername' => $_POST['teachername']));
	else
		echo insert('course', array('coursename' => $_POST['subjectname']));
	echo mysql_error();
}	  
else{
	echo 'Unauthorized!';
}
	  
 ?>