<?php 
function checkurl($url, $urltocheckfor=URL){
	$input = @file_get_contents($url);
	$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
	$matches = array();
	if(preg_match_all("/$regexp/siU", $input, $matches)) {
		if(in_array($urltocheckfor, $matches[2]) && strpos($url, $_SERVER['SERVER_NAME']) != true)
			return true;
		else
			return false;
	}
}
?>