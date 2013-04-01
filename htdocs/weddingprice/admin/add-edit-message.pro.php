<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
//print_r($_REQUEST);die();

if(isset($_REQUEST['edit'], $_REQUEST['messageid'])){
	$messageid = $_REQUEST['messageid'];
	$messageData = array(
		'content' => $_REQUEST['content'] ,
		'isread' => $_REQUEST['isread'] ,
		'date' => mysqlDate($_REQUEST['date']) 
	);
	update('message', $messageData, 'messageid', $messageid);
	header('Location: main-message-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){	
	header('Location: main-message-listing.php');
}

?>