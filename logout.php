<?php
session_start();

// සියලුම session දත්ත මකා දැමීම
$_SESSION = array();

// Session එක සම්පූර්ණයෙන්ම විනාශ කිරීම
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// නැවත ලොගින් පිටුවට (zerotech-access.php) හරවා යැවීම
header("Location: zerotech-access.php");
exit();
?>