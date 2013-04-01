<?php
require_once '../config/config.php';
require_once '../classes/database/objects/class.database.php';
require_once '../classes/database/objects/class.user.php';
require_once '../classes/database/objects/class.supplier.php';
require_once '../classes/database/objects/class.region.php';
require_once '../classes/database/objects/class.category.php';
require_once '../classes/database/objects/class.country.php';
if(isset($_REQUEST['updateJSON'])){
	$json = json_decode($_REQUEST['updateJSON']);	
	$supplierId = $_SESSION['supplierId'];
	switch($json->action){		
		case 'website':
			require_once '../includes/function.checkurl.php';
			if(trim($json->data->websiteUrl) == '' || trim($json->data->websiteName) == ''){
				echo 'Fields can\'t be empty';
				break;
			}
			else if(!isValidUrl($json->data->websiteUrl)){
				echo "Invalid URL! Insert complete URL including http://";
				break;
			}
			else if(!checkurl($json->data->websiteUrl, URL)){
				echo "Given URL doesn't contain a link back to wedding price site.";
				break;
			}			
			else{				
				require_once '../classes/database/objects/class.website.php';
				$website = new Website();
				$websiteList = $website->GetList(array(
					array('supplierId', '=', $supplierId)
				),'',true,1);
				if(count($websiteList)==1){
					$website = $websiteList[0];
				}
				$website->name = $json->data->websiteName;
				$website->url = $json->data->websiteUrl;
				$website->supplierId = $supplierId;
				$website->Save();	
				if($_SESSION['sAccountType'] == 'INVALIDURL'){
					$supplier = new Supplier();
					$supplier->Get($supplierId);
					$supplier->accountType = 'FREE';
					$supplier->Save();
					$_SESSION['sAccountType'] = 'FREE';
				}
				echo "success" . $supplier->pog_error;
				break;
			}		
		case 'address':			
			if(
				(trim($json->data->address) . trim($json->data->address2) . trim($json->data->zip)
				. trim($json->data->city) . trim($json->data->primaryregionId)) == ''
			)
			{
				echo 'Fields can\'t be empty';
			}
			else{
				$errorMessages = '';
				if(strlen($json->data->address) < 8 )
					$errorMessages .= 'Address must contain at least 8 charachters<br/>';
				if(strlen($json->data->city) < 4)
					$errorMessages .= 'City must contain 4 charachters at least<br/>';
				if(strlen($json->data->zip) < 4)
					$errorMessages .= 'Zip code must contain 4 charachters at least<br/>';
				if(!is_numeric($json->data->primaryregionId))
					$errorMessages .= 'Primary Region must be numeric<br/>';
				if($errorMessages == ''){
					$supplier = new Supplier();
					$supplier->Get($supplierId);
					$supplier->address = $json->data->address;
					$supplier->address2 = $json->data->address2;
					$supplier->zip = $json->data->zip;
					$supplier->city = $json->data->city;
					$supplier->primaryregionId = $json->data->primaryregionId;
					$supplier->Save();
					echo 'success' . $supplier->pog_error;
				}
				else{
					echo substr($errorMessages, 0, strlen($errorMessages)-5);
				}
			}			
			break;		
		case 'emails':			
			if(
				(trim($json->data->nonSalesEmail) . trim($json->data->salesEmail)) == ''
			)
				echo "Fields can't be empty";
			else{
				$errorMessages = '';
				if(!isValidEmail($json->data->nonSalesEmail)){
					$errorMessages .= "Invalid Non-Sales email<br/>";
				}
				if(!isValidEmail($json->data->salesEmail)){
					$errorMessages .= "Invalid sales email<br/>";
				}
				if($errorMessages == ''){
					$supplier = new Supplier();
					$supplier->Get($supplierId);
					$supplier->nonSalesEmail = $json->data->nonSalesEmail;
					$supplier->salesEmail = $json->data->salesEmail;
					$supplier->Save();
					echo 'success';
				}
				else{
					echo substr($errorMessages, 0, strlen($errorMessages)-5);
				}
			}
		break;		
		case 'regions':
			$regionsInList = '';
			for($i=0;$i<count($json->data->regions);$i++){
				$regionsInList .= $json->data->regions[$i] . ',';
			}
			$regionsInList .= '-1';
			$regionObj = new Region();
			$regionList = $regionObj->GetList(array(
				array('regionid IN (' . $regionsInList . ')')
			));
			$supplier = new Supplier();
			$supplier->Get($supplierId);
			$supplier->SetRegionList($regionList);
			$supplier->Save();
			echo 'success' . $supplier->pog_error;
		break;		
		case 'categories':
			$categoriesInList = '';
			for($i=0;$i<count($json->data->categories);$i++){
				$categoriesInList .= $json->data->categories[$i] . ',';
			}
			$categoriesInList .= '-1';
			$categoryObj = new Category();
			$categoryList = $categoryObj->GetList(array(
				array('categoryid IN (' . $categoriesInList . ')')
			));
			$query = $categoryObj->pog_query;
			$supplier = new Supplier();
			$supplier->Get($supplierId);
			$supplier->SetcategoryList($categoryList);
			$supplier->Save();
			echo 'success' . $supplier->pog_error;
		break;		
		case 'contactPerson':
			if(trim($json->data->contactPerson) == ''){
				echo 'Contact Person name can\'t be empty';
			}
			else if(strlen($json->data->contactPerson) < 4){
				echo 'Minimum 4 charachters are required for contact person';
			}
			else{
				$supplier = new Supplier();
				$supplier->Get($supplierId);
				$supplier->contactPerson = $json->data->contactPerson;
				$supplier->Save();
				echo 'success' . $supplier->pog_error;
			}
		break;		
		case 'phone':
			if(trim($json->data->phone) == ''){
				echo 'Phone number can\'t be empty';
			}
			else if(strlen($json->data->phone)<11 || strlen($json->data->phone)>16){
				echo 'Invalid Phone Number';
			}
			else{
				$supplier = new Supplier();
				$supplier->Get($supplierId);
				$supplier->phone = $json->data->phone;
				$supplier->Save();
				echo 'success' . $supplier->pog_error;
			}
		break;		
		case 'name':
			if(strlen($json->data->name)<4){
				echo 'Name must at least contain four charachters.';
			}
			else{
				$supplier = new Supplier();
				$supplier->Get($supplierId);
				$supplier->name = $json->data->name;
				$supplier->Save();
				echo 'success'  . $supplier->pog_error;
			}
		break;
		
		case 'companyProfile':
			if(strlen($json->data->companyProfile)<15){
				echo 'Company Prfoile must at least be 15 charachter long.';
			}
			else{
				$supplier = new Supplier();
				$supplier->Get($supplierId);
				$supplier->companyProfile = $json->data->companyProfile;
				$supplier->Save();
				echo 'success'  . $supplier->pog_error;
			}
		break;		
		case 'password':
			if(
				( trim($json->data->currentPassword) . trim($json->data->newPassword) . trim($json->data->confirmPassword) ) == ''
			){
				echo 'Fields can\'t be empty';
			}
			else if(strlen($json->data->newPassword) < 6 || strlen($json->data->confirmPassword) < 6 || strlen($json->data->currentPassword) < 6){
				echo "Password should at least be 6 charachters long";
			}
			else if($json->data->newPassword != $json->data->confirmPassword){
					echo 'Passwords mismtach';
			}				
			else{
				$userObj = new User();
				$userId = $_SESSION['userId'];
				$userObj->Get($userId);
				$passHash = sha1($json->data->currentPassword);
				if($passHash != $userObj->password){
					echo 'Wrong Password';
				}
				else if($errorMessages == ''){
					$userObj->password = sha1($json->data->newPassword);
					$userObj->Save();
					echo 'success' . $userObj->pog_error;
				}
			}
		break;
		case 'recieveReqs':
			$supplier = new Supplier();
			$supplier->Get($supplierId);
			$supplier->recieveRequests = $json->data->receiveRequests;
			$supplier->Save();
			echo $supplier->recieveRequests;
		break;
		case 'primaryCat':
			$supplier = new Supplier();
			$supplier->Get($supplierId);
			$supplier->primaryCategoryId = $json->data->pcid;
			$supplier->Save();
			echo 'success';
		break;
	}
}
function isValidEmail($email){
	return preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email);
}
function isValidUrl($url){
	return preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i",$url);
}
?>