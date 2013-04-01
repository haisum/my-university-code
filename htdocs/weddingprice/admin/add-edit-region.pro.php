<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
if(isset($_REQUEST['edit'], $_REQUEST['id'])){	
	update('region', array('name' => $_REQUEST['name']), 'regionid', $_REQUEST['id']);
	header('Location: main-region-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){	
	insert('region', array('name' => $_REQUEST['name']));	
	header('Location: main-region-listing.php?msg='.urlencode('Inserted'));
}

?>