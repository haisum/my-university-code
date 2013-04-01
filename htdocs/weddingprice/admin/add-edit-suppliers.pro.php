<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
//print_r($_REQUEST);die();

if(isset($_REQUEST['edit'], $_REQUEST['supplierid'], $_REQUEST['userid'])){
	$supplierid = $_REQUEST['supplierid'];
	$userid = $_REQUEST['userid'];
	update('user', array('email' => $_REQUEST['email']), 'userid', $userid);
	$supplierData = array(
		'name' => $_REQUEST['name'],
		'salesemail' => $_REQUEST['salesemail'],
		'nonsalesemail' => $_REQUEST['nonsalesemail'],
		'phone' => $_REQUEST['phone'],
		'contactperson' => $_REQUEST['contactperson'],
		'zip' => $_REQUEST['zip'],
		'city' => $_REQUEST['city'],
		'address' => $_REQUEST['address'],
		'address2' => $_REQUEST['address2'],
		'recieverequests' => $_REQUEST['recieveReqs'],
		'primaryregionid' => $_REQUEST['primaryRegion'],
		'companyprofile' => $_REQUEST['companyprofile'],
		'primarycategoryid' => $_REQUEST['primaryCategory'],
		'accounttype' => $_REQUEST['accounttype'],
		'goldexpires' => mysqlDate($_REQUEST['goldexpires'])		
	);
	update('supplier', $supplierData, 'supplierid', $supplierid);
	update('website', array('url' => $_REQUEST['url']), 'websiteid', $_REQUEST['websiteid']);
	uploadPicture($_FILES['picture'], 'supplier', $supplierid);
	//print_r($_FILES);
	header('Location: main-supplier-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){	
	
	$userData = array(
		'email' => $_REQUEST['email'],
		'password' => sha1($_REQUEST['password']),
		'isactive' => 'Yes',
		'registrationdate' => date('Y-m-d H:i:s'),
		'lastlogin' => date('Y-m-d H:i:s'),
		'forgotpassword' => '',
		'type' => 'Supplier',
		'deleted' => 'No'		
	);
	
	insert('user', $userData);
	
	$supplierData = array(
		'name' => $_REQUEST['name'],
		'salesemail' => $_REQUEST['salesemail'],
		'nonsalesemail' => $_REQUEST['nonsalesemail'],
		'phone' => $_REQUEST['phone'],
		'contactperson' => $_REQUEST['contactperson'],
		'zip' => $_REQUEST['zip'],
		'address' => $_REQUEST['address'],
		'address2' => $_REQUEST['address2'],
		'recieverequests' => $_REQUEST['recieveReqs'],
		'primaryregionid' => $_REQUEST['primaryRegion'],
		'companyprofile' => $_REQUEST['companyprofile'],
		'primarycategoryid' => $_REQUEST['primaryCategory'],
		'accounttype' => $_REQUEST['accounttype'],
		'goldexpires' => mysqlDate($_REQUEST['goldexpires']),		
		'city' => $_REQUEST['city'],
		'userid' => mysql_insert_id(),
		'countryid' => '151'
	);
	
	insert('supplier', $supplierData);
	
	$websiteData = array(
		'name' => '',
		'url' => $_REQUEST['url'],
		'supplierid' => mysql_insert_id()
	);
	
	insert('website', $websiteData);
	uploadPicture($_FILES['picture'], 'supplier', mysql_insert_id());
	header('Location: main-supplier-listing.php?msg='.urlencode('Inserted'));
}

?>