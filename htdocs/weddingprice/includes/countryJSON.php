<?php
	$counryRegions = array();	
	$countries = new Country();
	$countyList = $countries->GetList(array(
		array('isactive', '=' , 'YES')
	), 'name');	
	foreach($countyList as $key=>$countryObj){				
		$regions = array();
		$regionList = $countryObj->GetRegionList();
		foreach($regionList as $regionKey=>$regionObj){	
			$regions[$regionKey] = array(
			   'id' =>	$regionObj->regionId,
			   'name' => ucfirst(htmlspecialchars($regionObj->name , ENT_QUOTES))
			);
			
		}		
		$countryRegions[$key] = array(
		 'id' => $countryObj->countryId,
		 'name' => ucfirst(htmlspecialchars($countryObj->name, ENT_QUOTES)),
		 'regions' => $regions
		);
	}
	$data = json_encode($countryRegions);;
	if(isset($_GET['json']))
		echo $data;
	else if (isset($needarray))
		return $countryRegions;
	else
		return $data;
?>