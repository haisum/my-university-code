<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
//print_r($_SESSION);
//error_reporting(E_ALL);
switch($_SERVER['HTTP_HOST']){
	case 'localhost':
		define('URL','http://localhost/weddingprice');
		define('DBNAME' , 'demoserv_wp');
		define('HOST','localhost');
		define('USER','root');
		define('PASSWORD','');
		define('ABSOLUTE_PATH', 'D:/xampp full/htdocs/weddingprice');
	break;
	default:
		define('URL','http://projectsq.com/weddingprice');
		define('DBNAME' , 'demoserv_wp');
		define('HOST','localhost');
		define('USER','demoserv_wp');
		define('PASSWORD','123456');
		define('ABSOLUTE_PATH', '/home/demoserv/public_html/weddingprice');
	break;
}
$_SESSION['topage'] = '';
?>