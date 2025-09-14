<?php
session_start();

// Check token and expiry
if (!isset($_SESSION['admin_token']) || time() > $_SESSION['admin_expiry']) {
    session_destroy();
    header("Location: admin.php");
    exit();
}
