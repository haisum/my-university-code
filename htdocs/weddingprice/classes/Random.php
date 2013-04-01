<?php
class Random{
	public static function getRandom($count, $chars="123$4567!89*0#qwertyuiopasdfghj@klzxcvbm"){
		$message = "";
		$array = str_split($chars);
		for($i=0;$i<$count;$i++){
			$random = floor(rand(1, strlen($chars)-1));
			$char = intval(rand(0,1)) == 0 ? strtoupper($array[$random]) :  strtolower($array[$random]);
			$message .= $char;
		}
		return $message;
	}
}
?> 