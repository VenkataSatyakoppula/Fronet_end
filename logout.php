<?php
include 'include/config.php';
include 'include/loginCheck.php';
session_destroy();
session_start();
$_SESSION["logout"] = "Logged Out";
header('Location: '.$client_url.'/login.php');
exit();

?>