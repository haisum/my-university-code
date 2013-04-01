<?
include("includes/session.php");// database connection details stored here
//print_r($_REQUEST);
$id = $_REQUEST['id'];
$query = mysql_query("delete from county where id='$query'");
if($query){
	header('location: main_county.php?msg=deleted');
}
else{
	header('location: main_county.php');
}
?>