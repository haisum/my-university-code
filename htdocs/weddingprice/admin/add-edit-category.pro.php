<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
if(isset($_REQUEST['edit'], $_REQUEST['id'])){	
	update('category', array('name' => $_REQUEST['name']), 'categoryid', $_REQUEST['id']);
	header('Location: main-category-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){	
	insert('category', array('name' => $_REQUEST['name']));	
	header('Location: main-category-listing.php?msg='.urlencode('Inserted'));
}

?>