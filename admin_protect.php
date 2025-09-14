<?php
session_start();

// Check session token & expiry
if (!isset($_SESSION['admin_id'], $_SESSION['admin_token'], $_SESSION['admin_expiry']) || time() > $_SESSION['admin_expiry']) {
    session_unset();
    session_destroy();
    header("Location: admin_login.php");
    exit();
}
?>
