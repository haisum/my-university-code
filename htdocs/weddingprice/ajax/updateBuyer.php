<?php
require_once '../config/config.php';
require_once '../classes/database/objects/class.database.php';
require_once '../classes/database/objects/class.user.php';
require_once '../classes/database/objects/class.buyer.php';
require_once '../classes/database/objects/class.region.php';
require_once '../classes/database/objects/class.country.php';
if(isset($_REQUEST['updateJSON'])){
	$json = json_decode($_REQUEST['updateJSON']);	
	$buyerId = $_SESSION['buyerId'];
	switch($json->action){		
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
					$buyer = new Buyer();
					$buyer->Get($buyerId);
					$buyer->address = $json->data->address;
					$buyer->address2 = $json->data->address2;
					$buyer->zip = $json->data->zip;
					$buyer->city = $json->data->city;
					$buyer->primaryregionId = $json->data->primaryregionId;
					$buyer->Save();
					echo 'success';
				}
				else{
					echo substr($errorMessages, 0, strlen($errorMessages)-5);
				}
			}			
			break;		
		case 'emails':		
			if(trim($json->data->contactEmail)=='')
					echo "Email can't be empty";
			else{
				$errorMessages = '';
				if(!isValidEmail($json->data->contactEmail)){
					$errorMessages .= "Invalid Contact email<br/>";
				}
				if($errorMessages == ''){
					$buyer = new Buyer();
					$buyer->Get($buyerId);
					$buyer->contactEmail = $json->data->contactEmail;
					$buyer->Save();
					echo 'success';
				}
				else{
					echo substr($errorMessages, 0, strlen($errorMessages)-5);
				}
			}
		break;		
		case 'contactPerson':
			if(trim($json->data->contactPerson) == ''){
				echo 'Contact Person name can\'t be empty';
			}
			else if(strlen($json->data->contactPerson) < 4){
				echo 'Minimum 4 charachters are required for contact person';
			}
			else{
				$buyer = new Buyer();
				$buyer->Get($buyerId);
				$buyer->contactPerson = $json->data->contactPerson;
				$buyer->Save();
				echo 'success';
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
				$buyer = new Buyer();
				$buyer->Get($buyerId);
				$buyer->phone = $json->data->phone;
				$buyer->Save();
				echo 'success';
			}
		break;		
		case 'name':
			if(strlen($json->data->name)<4){
				echo 'Name must at least contain four charachters.';
			}
			else{
				$buyer = new Buyer();
				$buyer->Get($buyerId);
				$buyer->name = $json->data->name;
				$buyer->Save();
				echo 'success';
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
					echo 'success';
				}
			}
		break;
		case 'recieveQuotes':
			$buyer = new Buyer();
			$buyer->Get($buyerId);
			$buyer->recieveQuotes = $json->data->receiveQuotes;
			$buyer->Save();
			echo $buyer->recieveQuotes;
		break;
	}
}
function isValidEmail($email){
	return preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email);
}
?>