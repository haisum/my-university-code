<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
//print_r($_REQUEST);die();

if(isset($_REQUEST['edit'], $_REQUEST['buyerid'], $_REQUEST['userid'])){
	$buyerid = $_REQUEST['buyerid'];
	$userid = $_REQUEST['userid'];
	update('user', array('email' => $_REQUEST['email']), 'userid', $userid);
	$buyerData = array(
		'name' => $_REQUEST['name'],
		'contactemail' => $_REQUEST['contactemail'],
		'phone' => $_REQUEST['phone'],
		'contactperson' => $_REQUEST['contactperson'],
		'zip' => $_REQUEST['zip'],
		'city' => $_REQUEST['city'],
		'address' => $_REQUEST['address'],
		'address2' => $_REQUEST['address2'],
		'recievequotes' => $_REQUEST['recieveReqs'],
		'primaryregionid' => $_REQUEST['primaryRegion']		
	);
	update('buyer', $buyerData, 'buyerid', $buyerid);
	//echo uploadPicture($_FILES['picture'], 'buyer', $buyerid);
	//print_r($_FILES);
	header('Location: main-buyer-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){	
	
	$userData = array(
		'email' => $_REQUEST['email'],
		'password' => sha1($_REQUEST['password']),
		'isactive' => 'Yes',
		'registrationdate' => date('Y-m-d H:i:s'),
		'lastlogin' => date('Y-m-d H:i:s'),
		'forgotpassword' => '',
		'type' => 'Buyer',
		'deleted' => 'No'		
	);
	
	insert('user', $userData);
	
	$buyerData = array(
		'name' => $_REQUEST['name'],
		'contactemail' => $_REQUEST['contactemail'],
		'phone' => $_REQUEST['phone'],
		'contactperson' => $_REQUEST['contactperson'],
		'zip' => $_REQUEST['zip'],
		'address' => $_REQUEST['address'],
		'address2' => $_REQUEST['address2'],
		'recievequotes' => $_REQUEST['recieveReqs'],
		'primaryregionid' => $_REQUEST['primaryRegion'],
		'city' => $_REQUEST['city'],
		'userid' => mysql_insert_id(),
		'countryid' => '151'
	);
	
	insert('buyer', $buyerData);
	
	uploadPicture($_FILES['picture'], 'buyer', mysql_insert_id());
	
	header('Location: main-buyer-listing.php?msg='.urlencode('Inserted'));
}

?>