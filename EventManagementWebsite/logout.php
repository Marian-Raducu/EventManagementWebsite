<?php
session_start();

// Logout logic

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect user to Home page
header("location: index.php");
exit;
?>