<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
//print_r($_REQUEST);die();

if(isset($_REQUEST['edit'], $_REQUEST['emailtemplateid'])){
	$emailtemplateid = $_REQUEST['emailtemplateid'];
	$emailtemplateData = array(
		'body' => $_REQUEST['body'] ,
		'subject' => $_REQUEST['subject'] ,
		'from' => $_REQUEST['from'],
		'to' => $_REQUEST['to'],
		'fromname' => $_REQUEST['fromname']
	);
	update('emailtemplate', $emailtemplateData, 'emailtemplateid', $emailtemplateid);
	header('Location: main-emailtemplate-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){	
	header('Location: main-emailtemplate-listing.php');
}

?>