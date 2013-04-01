<?
	require_once '../config/config.php';
	mysql_connect(HOST, USER, PASSWORD) or die(mysql_error());
	mysql_select_db(DBNAME) or die(mysql_error());
	/*if(isset($_SESSION['admin_id'])){
		
		 if($_SERVER['SERVER_NAME'] == "localhost"){
			$host = "localhost";
			$user = "root";
			$pass = "";
			$db = "rockinghamdev";
		}
		else{
		//Clients Db params
			$host = "localhost";
			$user = "hertztes_zee";
			$pass = "pass@word12#";
			$db = "hertztes_nortingham";
		}
		mysql_connect($host, $user, $pass) or die(mysql_error());
		mysql_select_db($db) or die(mysql_error());
	}
	else{
		header("location: index.php?error");
	}*/
?>
