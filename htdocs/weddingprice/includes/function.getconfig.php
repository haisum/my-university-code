<?php
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.configuration.php';
function getConfig($name){
	$conf = new Configuration();
	$list = $conf->GetList(array(
		array('name', '=', $name)
	));
	if(count($list) > 0)
		return $list[0]->value;
	else
		return false;
}

?>