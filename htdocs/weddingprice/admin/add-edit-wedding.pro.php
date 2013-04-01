<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
//print_r($_REQUEST);die();

if(isset($_REQUEST['edit'], $_REQUEST['id'])){
	$weddingid = $_REQUEST['id'];
	$weddingData = array(
		'title' => $_REQUEST['groomname'] . ' (#) ' . $_REQUEST['bridename'],
		'weddingdate' => mysqlDate($_REQUEST['weddingdate']),
		'regionid' => $_REQUEST['regionid'],
		'guestcount' => $_REQUEST['guestcount'],
		'bridalpartysize' => $_REQUEST['bridalpartysize']				
	);
	update('wedding', $weddingData, 'weddingid', $weddingid);
	header('Location: main-wedding-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){
	
	header('Location: main-wedding-listing.php');
}
echo mysql_error() ; print_r($_POST);

?>