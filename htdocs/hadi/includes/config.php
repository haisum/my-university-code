<?php
error_reporting(E_ERROR);
session_start();
switch($_SERVER['HTTP_HOST']){
	case 'localhost':
		define('URL','http://localhost/hadi');
		define('DBNAME' , 'timetable');
		define('HOST','localhost');
		define('USER','root');
		define('PASSWORD','');
		define('ABSOLUTE_PATH', 'D:/xampp full/htdocs/hadi');
	break;
}
mysql_connect(HOST, USER, PASSWORD) or die(mysql_error());
	mysql_select_db(DBNAME) or die(mysql_error());
?>