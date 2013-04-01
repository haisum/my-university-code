<?php
require_once '../config/config.php';
require_once '../classes/database/objects/class.database.php';
require_once '../classes/database/objects/class.category.php';

if(isset($_GET['q'])){
	$categoryObj = new Category();
	$categoryList = $categoryObj->GetList(array(
		array('LOWER(name) like "%' . addslashes(strtolower($_GET['q'])) . '%"')
	));
	$arr = array();
	foreach($categoryList as $category){
		$arr[] = array(
			'id' => $category->categoryId,
			'name' => ucfirst(htmlspecialchars($category->name,ENT_QUOTES))
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
