<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
//print_r($_REQUEST);die();

if(isset($_REQUEST['edit'], $_REQUEST['reviewid'])){
	$reviewid = $_REQUEST['reviewid'];
	$reviewData = array(
		'content' => $_REQUEST['content'] ,
		'rating' => intval($_REQUEST['rating']) ,
		'date' => mysqlDate($_REQUEST['date'])
	);
	update('review', $reviewData, 'reviewid', $reviewid);
	header('Location: main-review-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){	
	header('Location: main-review-listing.php');
}

?>