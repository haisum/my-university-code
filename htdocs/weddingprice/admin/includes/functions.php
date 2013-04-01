<?php

function select($data, $selectedValue=0, $name='', $id='', $class='', $more=''){//data in data['value']='text' format
	$html = '';
	foreach($data as $key=>$value){
		$selected = '';
		if($key == $selectedValue){
			$selected = 'selected="selected"';
		}
		$html .= "<option $selected value='{$key}' >$value</option>";
	}
	if($name != ''){
		$name = "name='$name'";
	}
	if($id != ''){
		$id = "id='$id'";
	}
	
	if($class != ''){
		$class = "class='$class'";
	}
	return "<select $name $id $class $more >$html</select>";
}

function trimlong($text, $limit = 30){
	if(strlen($text) <= $limit)
		return $text;
	else
		return substr($text, 0, $limit).'..';
}

function getOne($column, $table, $where=''){
	if($where != ''){
		$where =  ' where ' . $where ;
	}
	$query = "select $column from $table $where";
	$result = mysql_query($query);
	$frow = mysql_fetch_array($result);
	return $frow[0];
}

function getRatings(){
	return array(
		'1' => '1',
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => '5'
	);
}

function getConfigArray(){
	return array(
		'adperdaycost' => 'Per day Cost For Displaying Ad',	
		'paypalactionurl' => 'URL of Paypal where form is submitted',
		'paypalaccountemail' => 'Email Id of Paypal business account',
		'3monthpackage' => 'Cost of three months gold package',
		'6monthpackage' => 'Cost of six months gold package',
		'12monthpackage' => 'Cost of yearly gold package',
		'freebidsperuser' => 'Number of free bids per user'
	);
}

function getConfigName($name){
	$arr = getConfigArray();
	return $arr[$name];
}


function getRegions(){
	$query = 'select * from region where countryid="151"';
	$result = mysql_query($query);
	$regions = array();
	while($frow=mysql_fetch_array($result)){
		$regions[$frow['regionid']] = $frow['name'];
	}
	return $regions;
}

function getFaqcategories(){
	$query = 'select * from faqcategory';
	$result = mysql_query($query);
	$faqcat = array();
	while($frow=mysql_fetch_array($result)){
		$faqcategory[$frow['faqcategoryid']] = trimlong($frow['title']);
	}
	return $faqcategory;
}

function getBuyers(){
	$query = 'select * from buyer';
	$result = mysql_query($query);
	$buyer = array();
	while($frow=mysql_fetch_array($result)){
		$buyer[$frow['buyerid']] = trimlong($frow['name']);
	}
	return $buyer;
}

function getSuppliers(){
	$query = 'select * from supplier';
	$result = mysql_query($query);
	$supplier = array();
	while($frow=mysql_fetch_array($result)){
		$supplier[$frow['supplierid']] = trimlong($frow['name']);
	}
	return $supplier;
}


function getCategories(){
	$query = 'select * from category';
	$result = mysql_query($query);
	$categorys = array();
	while($frow=mysql_fetch_array($result)){
		$categorys[$frow['categoryid']] = $frow['name'];
	}
	return $categorys;
}

function getStatusEnum(){
	$statusEnum = array('PENDING' => 'Not Approved Yet by Bride',
					'ACCEPTED' => 'Bride Accepted bid, waiting for supplier confirmation',
					'CONFIRMED' =>'Confirmed by supplier, waiting for completion.',
					'DISCARDED' => 'Bid Rejected by Supplier',
					'REJECTED' => 'Bid Rejected by Buyer',
					'COMPLETEDBUYER' => 'Bid Completed',
					'REVIEWDONE' => 'Buyer reviewed supplier',
					'REVIEWRESPONDED' => 'Buyer reviewed supplier and supplier reviewed him back.'
	);
	return $statusEnum;
	
}

function updateOneValue($table, $name, $value, $primary, $pvalue){		
	$query = "update $table set $name=" . escape($value) . " where $primary = " . intval($pvalue);
	return mysql_query($query);
}

function delete($table, $primary, $value){	
	$query = "delete from $table where $primary  = " . intval($value);
	return mysql_query($query);
}

function escape($value){	
	$value = htmlentities(mysql_real_escape_string(trim($value)));	
	return "'$value'";
}

function insert($table, $data){
	$strings = getInsertString($data);
	$query = "INSERT INTO $table(" . $strings['columns'] . ") values(" . $strings['values'] . ")";
	return mysql_query($query);
}



function getInsertString($data){
	$insertStrings['columns'] = '';
	$insertStrings['values'] = '';
	foreach($data as $key=>$value){
		$insertStrings['columns'] .=  "`$key`, ";
		$insertStrings['values'] .= escape($value) . ', ' ;
	}
	$insertStrings['values'] .= ';' ;
	$insertStrings['columns'] .= ';' ;
	
	$insertStrings['columns'] = str_replace(', ;', '', $insertStrings['columns']);
	$insertStrings['values'] = str_replace(', ;', '',  $insertStrings['values']);
	
	return $insertStrings;
}

function update($table, $data, $primary, $value){
	$string = getUpdateString($data);
	$query = "UPDATE $table SET $string where $primary = " . escape($value);
	$return = mysql_query($query);
	if(!$return)
		$return = mysql_error();
	return $return;
}

function getUpdateString($data){	
	$updateString = '';
	foreach($data as $key=>$value){
		$updateString .= " `$key` = "  . escape($value) . " , ";
	}
	$updateString .= ';';
	$updateString = str_replace(' , ;', '', $updateString);
	return $updateString;
}

function isValidEmail($email){
	return preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email);
}
function isValidUrl($url){
	return preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i",$url);
}

function mysqlDate($rawDate){
	return date('Y-m-d H:i:s', strtotime($rawDate));
}
function normalDate($rawDate){
	return date('d-m-Y', strtotime($rawDate));
}

function uploadPicture($picture, $table, $id){
if($picture['error'] != 0){
	return "no pic";
}
	$error = null;
	if($picture['size'] > 2*1024*1024){
			$error .= "-Picture size too big! Maximum 2MB file allowed<br/>";
		}
		else if($picture['type'] != "image/gif" && 
			$picture['type'] != "image/jpg" && 
			$picture['type'] != "image/jpeg" && 
			$picture['type'] != "image/pjpeg" && 
			$picture['type'] != "image/bmp" && 
			$picture['type'] != "image/png"
		){
			$error .= "-Only jpg, jpeg, png, gif and bmp formats of picture are allowed You uploaded: {$picture['type']}<br/>";
		}
		if($error == null){
			include_once("../classes/ResizeImage.php");		
			$rimg=new ResizeImage($picture['tmp_name']);
			$rimg->resize(30, 30, "../img/$table/" . $id. '_thumb.jpg');
			$rimg->resize_limitwh(120, 120, "../img/$table/" . $id. '.jpg');
			echo $rimg->error;
			$rimg->close();					
			copy($picture['tmp_name'], "../img/$table/". $id. '_orig.jpg');			
		}
		else{
			return $error;
		}
}


?>