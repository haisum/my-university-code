<?php
function isvalidemail($email){
	return preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email);
}
?>