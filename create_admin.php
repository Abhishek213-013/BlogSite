<?php
$adminPassword = 'abhishek_123'; // replace with your desired password
$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

echo "Your hashed password is: " . $hashedPassword;
?>
