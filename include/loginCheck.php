<?php
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header('Location: '.$client_url.'/login.php');
    exit;
}
?>