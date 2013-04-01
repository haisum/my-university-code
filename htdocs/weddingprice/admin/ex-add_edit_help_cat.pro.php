<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
//print_r($_REQUEST);die();

if(isset($_REQUEST['edit'])){
	$id = $_REQUEST['id'];
	$category = $_REQUEST['category'];
	$query = "update help_category set category = '$category' where help_cat_id='$id'";
	//echo $query;die();
	if(mysql_query($query)){
		header('location: main_help_cat.php?msg=Updated');
	}
	else{
		header('location: main_help_cat.php?msg='.urlencode('was NOT Updated'));
	}
}
if(isset($_REQUEST['add'])){
	$category = $_REQUEST['category'];
	$query = "insert into help_category(category) values ('$category')";
	if(mysql_query($query)){
		header('location: main_help_cat.php?msg=Added');
	}
	else{
		header('location: main_help_cat.php?msg='.urlencode('was NOT Added'));
	}
}

?>