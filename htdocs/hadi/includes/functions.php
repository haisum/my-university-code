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
		$insertStrings['columns'] .= $key .  ', ';
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
		$updateString .= " $key = "  . escape($value) . " , ";
	}
	$updateString .= ';';
	$updateString = str_replace(' , ;', '', $updateString);
	return $updateString;
}

function logout(){
	session_destroy(); 
	unset($_SESSION);
	$past = time() - 3600;
	foreach ( $_COOKIE as $key => $value )
	{
		setcookie( $key, $value, $past, '/' );
	}
}
?>