<?php
if(isset($_GET['json']))
	require 'supplierDataRequiredJson.php';
else
	require 'includes/supplierDataRequired.php';
$userId = $_SESSION['userId'];
$supplierObj = new Supplier();
$supplierList = $supplierObj->GetList(array(
										array('userid', '=', $userId)
									), '', true, 1);
if(count($supplierList) == 0){
session_destroy();
header('Location: ' . URL);
}
$supplier = $supplierList[0];
$data['supplierId'] = $supplier->supplierId;
$data['name'] = $supplier->name;
$data['salesEmail'] = $supplier->salesEmail;
$data['nonSalesEmail'] = $supplier->nonSalesEmail;
$data['contactPerson'] = $supplier->contactPerson;
$data['phone'] = $supplier->phone;
$data['primaryCategoryId'] = $supplier->primaryCategoryId;
$categoryText = "";
$supplierCategories = $supplier->GetCategoryList();
switch(count($supplierCategories)){
	case 0:
		break;
	case 1:
		$categoryText .= $supplierCategories[0]->name;
		break;
	case 2:
		$categoryText .= $supplierCategories[0]->name . " and " . $supplierCategories[1]->name;
		break;
	case 3:
		$categoryText .= $supplierCategories[0]->name . ', ' . $supplierCategories[1]->name . " and " . $supplierCategories[2]->name;
		break;
	default:
		$categoryText .= $supplierCategories[0]->name . ', ' . $supplierCategories[1]->name . ', ' . $supplierCategories[2]->name . " and others";
		break;
}
$data['categoryText'] = $categoryText;
$supplierIds = array();
foreach($supplierCategories as $key=>$supplierCategory){
	$supplierIds[$key] = $supplierCategory->categoryId;
}
$categoryOptions = array();
$categoryObj = new Category();
$categoryList = $categoryObj->GetList(array(),'name');
foreach($categoryList as $key=>$category){
	$categoryOptions[$key] = array(
		'selected' => in_array($category->categoryId, $supplierIds) ? 'selected' : '',
		'value' => $category->categoryId,
		'text' => ucfirst($category->name)
	);	
}
$data['categoryOptions'] = $categoryOptions;
$regionText = "";
$supplierRegions = $supplier->GetRegionList();
switch(count($supplierRegions)){
	case 0:
		break;
	case 1:
		$regionText .= $supplierRegions[0]->name;
		break;
	case 2:
		$regionText .= $supplierRegions[0]->name . " and " . $supplierRegions[1]->name;
		break;
	case 3:
		$regionText .= $supplierRegions[0]->name . ', ' . $supplierRegions[1]->name . " and " . $supplierRegions[2]->name;
		break;
	default:
		$regionText .= $supplierRegions[0]->name . ', ' . $supplierRegions[1]->name . ', ' . $supplierRegions[2]->name . " and others";
		break;
}
$data['regionText'] = $regionText;
$supplierIds = array();
foreach($supplierRegions as $key=>$supplierRegion){
	$supplierIds[$key] = $supplierRegion->regionId;
}

$regionOptions = array();
$regionObj = new Region();
$regionList = $regionObj->GetList(array(
	array('countryid', '=', $supplier->countryId)
),'name');
foreach($regionList as $key=>$region){
	$regionOptions[$key] = array(
		'selected' => in_array($region->regionId, $supplierIds) ? 'selected' : '',
		'value' => $region->regionId,
		'text' => $region->name
	);	
}
$data['regionOptions'] = $regionOptions;

$data['zip'] = $supplier->zip;
$data['address'] = $supplier->address;
$data['address2'] = $supplier->address2;
$data['city'] = $supplier->city;
$data['countryName'] = $supplier->GetCountry()->name;
$region = new Region();
$region->Get($supplier->primaryregionId);
$data['primaryRegion'] = $region->name;
$region = null;
$primaryRegionOptions = array();
foreach($regionList as $key=>$region){
	$primaryRegionOptions[$key] = array(
		'selected' => $region->regionId == $supplier->primaryregionId ? 'selected' : '',
		'value' => $region->regionId,
		'text' => $region->name
	);		
}
$data['primaryRegionOptions'] = $primaryRegionOptions;
$websiteText = "";
$websiteObj = new Website();
$websiteList = $websiteObj->GetList(array(
	array('supplierid', '=', $supplier->supplierId)
), '', true, 1);
$website = $websiteObj;
if(count($websiteList) == 1){
	$website = $websiteList[0];
	$websiteText .= $website->name;
	if(trim($websiteText)!='' && trim($website->url) !='')
		$websiteText .= ", " . $website->url;
	else
		$websiteText .= $website->url;
}

$supplierWebsite = array(
	'text' => $websiteText,
	'name' => $website->name,
	'url' => $website->url
);
$data['website'] = $supplierWebsite;
$doRecieveReqs = ($supplier->recieveRequests == 'Yes');
$data['doRecieveReqs'] = array(
	'text' =>  $doRecieveReqs?'Yes' : 'No',
	'check' => $doRecieveReqs?'checked' : ''
);
$data['companyProfile'] = $supplier->companyProfile;
$data['accountType'] = $supplier->accountType;
$data['expireDate'] = $supplier->goldExpires;
if(isset($_GET['json']))
	echo json_encode($data);
else
	return $data;
?>
