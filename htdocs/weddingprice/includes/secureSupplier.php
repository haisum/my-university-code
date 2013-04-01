<?php
if(!(isset($_SESSION['type']) && $_SESSION['type'] == "Supplier")){
	header("Location: " . URL . "/page-not-found.php");
	exit();
}
else if(isset($_SESSION['sAccountType'])){
	switch($_SESSION['sAccountType']){		
		case 'PAYMENTNOTVERIFIED':	
			mysql_connect(HOST, USER, PASSWORD);
			mysql_select_db(DBNAME);
			$supplierId = $_SESSION['supplierId'];
			$result = mysql_query('select accounttype from supplier where supplierid=' . $supplierId);
			$row = mysql_fetch_array($result);
			$aType = $row['accounttype'];
			if($aType == 'PAYMENTNOTVERIFIED'){
				header("Location: " . URL . "/supplier-account-type.php");
				exit;
			}
			else{
				$_SESSION['sAccountType'] = $aType;
			}
			break;
		case 'GOLD':
			mysql_connect(HOST, USER, PASSWORD);
			mysql_select_db(DBNAME);
			$supplierId = $_SESSION['supplierId'];
			$result = mysql_query('select goldexpires from supplier where supplierid=' . $supplierId);
			$row = mysql_fetch_array($result);
			$expiretime = strtotime($row['goldexpires']);
			if($expiretime < time()){
				$result = mysql_query("select ((SELECT count(*) from bid where supplierid=$supplierId) < (SELECT `value`  from configuration where `name` = 'freebidsperuser')) as hasbids");
				$row = mysql_fetch_array($result);
				$hasBids = $row[0];
				if($hasBids != 1){
					mysql_query('UPDATE supplier SET accounttype="OUTOFFREEBIDS" where supplierid=' . $supplierId);
					$_SESSION['sAccountType'] = 'OUTOFFREEBIDS';
				}else{
				$_SESSION['sAccountType'] = 'FREE';
				mysql_query('UPDATE supplier SET accounttype="FREE" where supplierid=' . $supplierId);
				}
			}
			break;
		case 'FREE':
			mysql_connect(HOST, USER, PASSWORD);
			mysql_select_db(DBNAME);
			$supplierId = $_SESSION['supplierId'];
			$result = mysql_query('select url from website where supplierid=' . $supplierId);
			$row = mysql_fetch_array($result);
			$url = $row['url'];
			require_once ABSOLUTE_PATH . '/includes/function.checkurl.php';			
			if($check = !checkurl($url, URL)){
				$query = 'UPDATE supplier SET accounttype="INVALIDURL" where supplierid=' . $supplierId;
				mysql_query($query);
				$_SESSION['sAccountType'] = 'INVALIDURL';
				break;
			}
			$result = mysql_query("select ((SELECT count(*) from bid where supplierid=$supplierId) <= (SELECT `value`  from configuration where `name` = 'freebidsperuser')) as hasbids");
			$row = mysql_fetch_array($result);
			$hasBids = $row[0];
			if($hasBids != 1){
				mysql_query('UPDATE supplier SET accounttype="OUTOFFREEBIDS" where supplierid=' . $supplierId);
				$_SESSION['sAccountType'] = 'OUTOFFREEBIDS';
			}			
			break;
		case 'JUSTREGISTERED':		
			header("Location: " . URL . "/supplier-account-type.php");
			exit;
			break;
	}
}
?>