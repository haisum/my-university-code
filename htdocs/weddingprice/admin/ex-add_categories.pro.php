<?
//print_r($_REQUEST);
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");

//print_r($_REQUEST);
$filename2 = str_replace(".php","",basename($_SERVER['SCRIPT_FILENAME']));

$cat_name = $_REQUEST['category'];
$desc = mysql_escape_string($_REQUEST['desc']);
$status = $_REQUEST['status'];

$query = mysql_query("insert into jobtype (jobtype_name, jobtype_desc, status) values ('$cat_name', '$desc', '$status')");
//echo $query;
if($query){
	header("Location: main_categories.php?msg=updated");
}
else{
	echo "<script> alert('Error updating data, please check your field values.');
history.go(-1);
</script>";
}

?>