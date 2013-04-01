<?php
function isvalidurl($url){
	return preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i",$url);
}
?>