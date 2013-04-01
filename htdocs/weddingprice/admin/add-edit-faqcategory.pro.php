<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
if(isset($_REQUEST['edit'], $_REQUEST['id'])){	
	update('faqcategory', array('title' => $_REQUEST['title'], 'position' => intval($_REQUEST['position'])), 'faqcategoryid', $_REQUEST['id']);
	header('Location: main-faqcategory-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){	
	insert('faqcategory', array('title' => $_REQUEST['title'], 'position' => intval($_REQUEST['position']), 'date' => date('Y-m-d H:i:s', time())));	
	header('Location: main-faqcategory-listing.php?msg='.urlencode('Inserted'));
}

?>