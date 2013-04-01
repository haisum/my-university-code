<?php
if(isset($_GET['json']))
	require 'buyerDataRequiredJson.php';
else
	require 'includes/buyerDataRequired.php';
$userId = $_SESSION['userId'];
$buyerObj = new Buyer();
$buyerList = $buyerObj->GetList(array(
										array('userid', '=', $userId)
									), '', true, 1);
if(count($buyerList) == 0){
	die('No Buyer account found');
}
$buyer = $buyerList[0];
$data['buyerId'] = $buyer->buyerId;
$data['name'] = ucfirst($buyer->name);
$data['contactEmail'] = $buyer->contactEmail;
$data['contactPerson'] = $buyer->contactPerson;
$data['phone'] = $buyer->phone;

$data['zip'] = $buyer->zip;
$data['address'] = $buyer->address;
$data['address2'] = $buyer->address2;
$data['city'] = $buyer->city;
$data['countryName'] = $buyer->GetCountry()->name;

$regionObj = new Region();
$regionList = $regionObj->GetList(array(
	array('countryid', '=', $buyer->countryId)
),'name');
$region = new Region();
$region->Get($buyer->primaryregionId);
$data['primaryRegion'] = $region->name;
$region = null;

$primaryRegionOptions = array();
foreach($regionList as $key=>$region){
	$primaryRegionOptions[$key] = array(
		'selected' => $region->regionId == $buyer->primaryregionId ? 'selected' : '',
		'value' => $region->regionId,
		'text' => ucfirst($region->name)
	);		
}
$data['primaryRegionOptions'] = $primaryRegionOptions;

$doRecieveQuotes = ($buyer->recieveQuotes == 'Yes');
$data['doRecieveQuotes'] = array(
	'text' =>  $doRecieveQuotes?'Yes' : 'No',
	'check' => $doRecieveQuotes?'checked' : ''
);
if(isset($_GET['json']))
	echo json_encode($data);
else
	return $data;
?>