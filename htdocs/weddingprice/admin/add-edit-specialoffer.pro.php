<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
if(isset($_REQUEST['edit'], $_REQUEST['id'])){	
	update('specialoffer', array( 
		'title' => $_REQUEST['title'],
		'link' => $_REQUEST['link'],
		'content' => $_REQUEST['content'],
		'days' =>$_REQUEST['days'],
		'status' => $_REQUEST['status'],
		'date' => mysqlDate($_REQUEST['date']),
		'dateend' => mysqlDate($_REQUEST['dateend'])
	), 'specialofferid', $_REQUEST['id']);
	header('Location: main-specialoffer-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){	
	insert('specialoffer', array( 
		'title' => $_REQUEST['title'],
		'link' => $_REQUEST['link'],
		'content' => $_REQUEST['content'],
		'supplierid' =>$_REQUEST['supplierid'],
		'days' =>$_REQUEST['days'],
		'status' => $_REQUEST['status'],
		'date' => mysqlDate($_REQUEST['date']),
		'dateend' => mysqlDate($_REQUEST['dateend'])
	));	
	header('Location: main-specialoffer-listing.php?msg='.urlencode('Inserted'));
}

?>