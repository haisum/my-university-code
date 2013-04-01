<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
//print_r($_REQUEST);die();

if(isset($_REQUEST['edit'], $_REQUEST['bidid'])){
	$bidid = $_REQUEST['bidid'];
	$bidData = array(
		'amount' => intval($_REQUEST['amount']) ,
		'date' => mysqlDate($_REQUEST['date']),
		'biddescription' => $_REQUEST['biddescription'],
		'lastmodified' => mysqlDate($_REQUEST['lastmodified']),
		'status' => $_REQUEST['status']				
	);
	update('bid', $bidData, 'bidid', $bidid);
	header('Location: main-bid-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){
	
	header('Location: main-bid-listing.php');
}

?>