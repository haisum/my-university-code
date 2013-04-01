<?php
require_once 'config/config.php';
require 'config/config.php';
//print_r($_SESSION);
session_destroy(); 
unset($_SESSION);
$past = time() - 3600;
foreach ( $_COOKIE as $key => $value )
{
    setcookie( $key, $value, $past, '/' );
}
echo "<script type='text/javascript'>window.location.href='" . URL . "/login.php'</script>";

?>