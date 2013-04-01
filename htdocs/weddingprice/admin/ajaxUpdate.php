<?php
/*
sample php for this  include weddingprice.js ajaxUpdate function
' onchange="ajaxUpdate(\'supplier\', \'recieverequests\', $(\'#recieveReqs' . $row['supplierid'] .
							  '>option:selected\').val(), \'supplierid\', \'' . $row['supplierid'] . '\')"'

*/
	require_once 'includes/session.php';
	require_once 'includes/secure.php';
	if(!isset($_REQUEST['primary'])){
		die('no primary key defined');
	}
	require_once 'includes/functions.php';			
	echo updateOneValue($_REQUEST['table'], $_REQUEST['name'], $_REQUEST['value'], $_REQUEST['primary'], $_REQUEST['pvalue']);
	echo mysql_error();
?>