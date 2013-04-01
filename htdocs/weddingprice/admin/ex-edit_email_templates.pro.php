<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");

/*
foreach($_POST as $k => $v)
{
	$_POST[$k] = htmlentities($_POST[$k]);
}*/

/*						$date_array = explode("/",$_REQUEST['expiry']);
						$_REQUEST['expiry'] = $date_array[2].'-'.$date_array[0].'-'.$date_array[1];
*/
	
	
$id = $_REQUEST['id'];
$emailbody = mysql_escape_string($_REQUEST['emailbody']);

$query = mysql_query("update emailtemplate set emailbody = '$emailbody' where id = '$id'");

if ($query) 
{
	header("Location: main_email_templates.php?msg=updated");
} else {

	echo "<script> alert('Error updating data, please check your field values.');
history.go(-1);
</script>";

}

  ?>