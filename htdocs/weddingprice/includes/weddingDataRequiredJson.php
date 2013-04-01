<?php
require_once '../config/config.php';
if(!isset($_SESSION['buyerId'])){
	echo '{"status" : "not logged in as buyer"}';
	exit();
}
require_once '../classes/database/objects/class.database.php';
require_once '../classes/database/objects/class.buyer.php';
require_once '../classes/database/objects/class.region.php';
require_once '../classes/database/objects/class.category.php';
require_once '../classes/database/objects/class.wedding.php';
require_once '../classes/database/objects/class.bid.php';
require_once '../classes/database/objects/class.weddingcategory.php';
?>