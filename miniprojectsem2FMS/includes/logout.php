<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = array();

// If it's desired to kill the session cookie, then
// set the parameters of the session cookie to expire in the past
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to login page or home page
header("Location: ../index.html");
exit();
?>
