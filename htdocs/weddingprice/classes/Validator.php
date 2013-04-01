<?php
class Validator{
	public function isValidEmail($email){ 
		$email =  strtolower($email); 
		return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email);
	}	
}
?>
