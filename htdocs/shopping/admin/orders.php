<?php
session_start();
require_once('../config.php');
require_once('../includes/admin-secure.php');
require_once('../includes/functions.php');
$admin = true;
require('../includes/header.php');
require('../includes/left.php');
require('../includes/admin-orders.php');
require('../includes/right.php');
require('../includes/footer.php');
?>