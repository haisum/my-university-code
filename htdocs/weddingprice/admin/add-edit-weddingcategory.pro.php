<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
//print_r($_REQUEST);die();

if(isset($_REQUEST['edit'], $_REQUEST['weddingcategoryid'])){
	$weddingcategoryid = $_REQUEST['weddingcategoryid'];
	$weddingcategoryData = array(
		'budgetto' => intval($_REQUEST['budgetto']) ,
		'budgetfrom' => intval($_REQUEST['budgetfrom']) ,
		'detail' => $_REQUEST['detail'],
		'biddeadline' => mysqlDate($_REQUEST['biddeadline'])
	);
	update('weddingcategory', $weddingcategoryData, 'weddingcategoryid', $weddingcategoryid);
	uploadPicture($_FILES['picture'], 'weddingcats', $weddingcategoryid);
	header('Location: main-weddingcategory-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){
	
	header('Location: main-weddingcategory-listing.php');
}

?>