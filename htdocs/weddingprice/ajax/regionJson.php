<?php
require_once '../config/config.php';
require_once '../classes/database/objects/class.database.php';
require_once '../classes/database/objects/class.region.php';

if(isset($_GET['q'])){
	$regionObj = new Region();
	$regionList = $regionObj->GetList(array(
		array('LOWER(name) like "%' . addslashes(strtolower($_GET['q'])) . '%"')
	));
	$arr = array();
	foreach($regionList as $region){
		$arr[] = array(
			'id' => $region->regionId,
			'name' => ucfirst(htmlspecialchars($region->name,ENT_QUOTES))
		);
	}
	$json_response = json_encode($arr);
	#Wrap the response in a callback function for JSONP cross-domain support
	if($_GET["callback"]) {
		$json_response = $_GET["callback"] . "(" . $json_response . ")";
	}
	echo $json_response;
}

?>
