<?
session_start();
session_destroy();
$_SESSION = array();
unset($_SESSION);
header("Location: login");
exit;
?>
