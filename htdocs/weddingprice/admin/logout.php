<?
session_start();
//print_r($_SESSION);
session_destroy(); 
unset($_SESSION);
$past = time() - 3600;
foreach ( $_COOKIE as $key => $value )
{
    setcookie( $key, $value, $past, '/' );
}
header("Location: index.php?logout");
//print_r($_SESSION);
?>