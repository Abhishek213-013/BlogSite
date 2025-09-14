<?php
$adminPassword = 'abhishek_123'; 
$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

echo "Your hashed password is: " . $hashedPassword;
?>
