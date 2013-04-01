<?php
session_start();
require('../config.php');
unset($_SESSION['admin']);
header('location: '  . URL);
?>