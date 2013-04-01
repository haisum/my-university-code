<?php
if(isset($_GET['json']) || isset($page))
	require 'bidDataRequiredJson.php';
else
	require 'includes/bidDataRequired.php';
$bidObj = new Bid();
$bidList = array();
$supplierId = $_SESSION['supplierId'];
if((isset($_GET['bid']) && is_numeric($_GET['bid'])) || isset($bidId)){
	if(!isset($bidId))
		$bidId = $_GET['bid'];
	$bidList = $bidObj->GetList(array(
			array('supplierid', '=', $supplierId),
			array('bidid' , '=', $bidId)
		)
	);
}
else{
	$offset = 0;
	if(isset($page)){
		$offset = ($page * BIDSPERPAGE)-BIDSPERPAGE;
	}
	$bidList = $bidObj->GetList(array(
				array('supplierid', '=', $supplierId)
			), 'date', false , $offset . ' , ' . BIDSPERPAGE
	);
} 
$data = array();

mysql_connect(SERVER, USERNAME, PASSWORD);
mysql_select_db(DBNAME);
$query = sprintf('select count(supplierid) as count from bid where supplierid=%d', $supplierId);
$result = mysql_query($query);
$bidCount = 0;
while($row = mysql_fetch_array($result)){
	$bidCount = $row['count'];
}

$query = sprintf('select count(*) as count from message where toid=%d AND isread="NO"', $supplierId);
$result = mysql_query($query);
$messageCount = 0;
while($row = mysql_fetch_array($result)){
	$messageCount = $row['count'];
}
foreach($bidList as $bid){
	$wedCat = new WeddingCategory();
	$category = new Category();
	$wedCat->Get($bid->weddingcategoryId);
	$category->Get($wedCat->categoryId);
	$bidCs = array(
		'weddingcategoryId' => $wedCat->weddingcategoryId,
		'categoryId' => $wedCat->categoryId,
		'name' => $category->name
	);
	/*$bidCList = $wedCat->GetList(array(
		array('weddingcategoryid','=', $bid->weddingcategoryId)
	));
	$bidCs = array();
	foreach($bidCList as $bidC){
		$category = new Category();
		$category->Get($bidC->categoryId);
		$bidCs[] = array(
			'bidPerCategoryId' => $bidC->weddingcategoryId,
			'amount' => $bidC->amount,
			'categoryId' => $category->categoryId,
			'categoryName' => $category->name
		);
	}*/
	$wedding = new Wedding();	
	$wedding->Get($bid->weddingId); 
	$region = $wedding->GetRegion();
	$regionArray = array(
		'id' => $region->regionId,
		'name' => $region->name
	);
	
	$buyer = $wedding->GetBuyer();
	$contactPerson = $buyer->contactPerson;
	$data[] = array(
		'bidId' => $bid->bidId,
		'weddingId' => $wedding->weddingId,
		'title' => $wedding->title,
		'bidDate' => date('d-m-Y' , strtotime($bid->date)),
		'weddingDate' => date('d-M-Y' , strtotime($wedding->weddingDate)),
		'bidAmount' => $bid->amount,
		'region' => $regionArray,
		'category' => $bidCs,
		'contactPerson' => $contactPerson,
		'lastModified' => date('d-M-Y', strtotime($bid->lastModified)),
		'status' => $bid->status,
		'bidCategoryCount' => count($bidCs),
		'bidDescription' => $bid->bidDescription
	);
}
$data['bidCount'] = $bidCount;
$data['messageCount'] = $messageCount;
if(isset($_GET['json']))
	echo json_encode($data);
else
	return $data;
?>