<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
//print_r($_REQUEST);die();

if(isset($_REQUEST['edit'], $_REQUEST['configurationid'])){
	$configurationid = $_REQUEST['configurationid'];
	$configurationData = array(
		'value' => $_REQUEST['value'] 
	);
	update('configuration', $configurationData, 'configurationid', $configurationid);
	header('Location: main-configuration-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){	
	header('Location: main-configuration-listing.php');
}

?>