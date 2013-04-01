<?php
require_once '../config/config.php';
require_once '../includes/secureLogin.php';
require_once '../includes/securePasswordChange.php';
require_once '../includes/secureBuyer.php';
require_once '../classes/database/objects/class.database.php';
require_once '../classes/database/objects/class.buyer.php';
require_once '../classes/database/objects/class.region.php';
require_once '../classes/database/objects/class.category.php';
require_once '../classes/database/objects/class.wedding.php';
require_once '../classes/database/objects/class.weddingcategory.php';

if(isset($_REQUEST['json'])){
	$json = json_decode($_REQUEST['json']);	
	if((trim($json->title) . trim($json->weddingDate) . trim($json->bidDeadline) . trim($json->guestCount) . trim($json->bridalPartySize). trim($json->budgetTo) . trim($json->budgetFrom)) == ''){
		echo "Required Fields can't be empty";
	}
	else{
		$errorMessage = '';
		if(!isValidDate($json->weddingDate)){
			$errorMessage .= 'Invalid Wedding Date<br/>';			
		}		
		if(!isValidDate($json->bidDeadline)){
			$errorMessage .= 'Invalid Bid Deadline<br/>';			
		}
		else if(isValidDate($json->weddingDate) && strtotime($json->bidDeadline) > strtotime($json->weddingDate)){//compare timestamp int 
			$errorMessage .= 'Bid Deadline can\'t be after wedding date<br/>';
		}
		if(!is_numeric($json->guestCount)){
			$errorMessage .= 'Guest Count Must be Numeric<br/>';
		}
		if(!is_numeric($json->bridalPartySize)){
			$errorMessage .= 'Bridal Party Size Must be Numeric<br/>';
		}
		if(!is_numeric($json->budgetTo)){
			$errorMessage .= 'Budget ending value can\'t be non-numeric<br/>';
		}		
		if(!is_numeric($json->budgetFrom)){
			$errorMessage .= 'Budget starting value can\'t be non-numeric<br/>';
		}
		else if(is_numeric($json->budgetTo) && $json->budgetFrom > $json->budgetTo){
			$errorMessage .= 'Budget starting value can\'t be greater than budget ending value<br/>';
		}
		if(count($json->categories) < 1){
			$errorMessage .= 'Wedding must have at least one category<br/>';
		}
		if($errorMessage == ''){
			$wedding = new Wedding();
			if($json->id != -1){
					$wedding->Get($json->id);
			}
			else{
					$buyerId = $_SESSION['buyerId'];
					$wedding->buyerId = $buyerId;
			}
			
			$wedding->weddingDate = htmlentities($json->weddingDate);
			$wedding->bidDeadline = htmlentities($json->bidDeadline);
			$wedding->regionId = htmlentities($json->region);
			$wedding->guestCount = htmlentities($json->guestCount);
			$wedding->bridalPartySize = htmlentities($json->bridalPartySize);
			$wedding->budgetTo = htmlentities($json->budgetTo);
			$wedding->budgetFrom = htmlentities($json->budgetFrom);
			$wedding->postedDate = strftime('%y-%m-%d %H:%M:%S');
			$wedding->lastModified = strftime('%y-%m-%d %H:%M:%S');
			$wedding->status = $json->status;
			$wedding->additionalInfo = htmlentities($json->additionalInfo);
			$wedding->title = $json->title;
			$wedding->Save();
			for($i=0;$i<count($json->categories);$i++){
				$catwed = new WeddingCategory();
				$list = $catwed->GetList(array(
					array('weddingid', '=', $wedding->weddingId),
					array('categoryid', '=', $json->categories[$i]->id)
				));
				if(count($list)>0){
					$catwed = $list[0];
				}
				$catwed->categoryId = $json->categories[$i]->id;
				$catwed->weddingId = $wedding->weddingId;
				$catwed->detail = '';
				$catwed->budgetto = 0;
				$catwed->budgetfrom = 0;
				$catwed->status = 'PENDING';
				$catwed->Save();
			}
			echo $wedding->weddingId;
		}
		else{
			echo substr($errorMessage, 0, strlen($errorMessage)-5);
		}
	}
}

function isValidDate($date){
	$dateArray = explode('-', $date);
	if(count($dateArray) != 3){
		return false;
	}
	else 
		return checkdate($dateArray[1], $dateArray[2], $dateArray[0]);
}
?>