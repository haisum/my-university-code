<?
include("includes/session.php");// database connection details stored here

	
	$usr= $_POST['uname'];
    $pass=md5($_POST['pass']);    
   $query  = "select * from cmsadmin where user='$usr' and pass='$pass'";
	$result = mysql_query($query) or die("Invalid query");
	$num    = mysql_num_rows($result);
 	$row = mysql_fetch_array($result);
	if ($num == 0) {
	   	//print_r($_SESSION);die('not logged in');
		header("Location: index.php?error");
		
	}
	else
	{
		$_SESSION['admin_id'] = $row['user'];
		echo "<script>window.location='home.php';</script>";
	}
?>