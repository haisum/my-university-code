<?php

include("includes/session.php");// database connection details stored here
include("includes/secure.php");
include("lefke/cleanGetPost.php");
/*
foreach($_POST as $k => $v)
{
	$_POST[$k] = htmlentities($_POST[$k]);
}*/


if(!(isset($_GET['userid'])) && isset($_REQUEST['pass'])){
if($_REQUEST['pass'] == $_REQUEST['pass2']){
	$adminid = $_SESSION['admin_id'];
	$query = "UPDATE cmsadmin set pass = '" . md5($_REQUEST[pass]) . "' WHERE user = '$adminid'";
	$result=mysql_query($query);
	header("Location: change_password.php?msg=changed" . mysql_error(). " $result row(s) affected ");	
}
else{ ?>
	<script> 
		alert('Passwords don\'t match');
		history.go(-1);
</script>
<?php }
}
else if((isset($_GET['userid'])) && isset($_REQUEST['pass'])){
if($_REQUEST['pass'] == $_REQUEST['pass2']){
	$userid = $_GET['userid'];
	$query = "UPDATE user set password = '" . sha1($_REQUEST['pass']) . "' WHERE userid = '$userid'";
	//die($query);
	$result=mysql_query($query);
	header("Location: change_password.php?msg=changed"  . mysql_error(). " $result(s) affected ");	
	}
else{ ?>
	<script> 
		alert('Passwords don\'t match');
		history.go(-1);
</script>
<?php }
} 
  ?>