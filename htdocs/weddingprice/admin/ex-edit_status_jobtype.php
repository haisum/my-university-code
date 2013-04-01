<?
include("includes/session.php");// database connection details stored here
$id = $_REQUEST['id'];
$status = $_REQUEST['status'];

$query = "update jobtype set jobtype.status = '$status' where jobtype_id = '$id'";
//echo $query;
if(mysql_query($query)){
	echo 'Saved';
}
else{
	echo 'Not Saved';
}


?>