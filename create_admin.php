<?php
include 'db.php';

$username = "admin";
$password = "abhishek_123";
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admins (username, password_hash) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hash);
$stmt->execute();

echo "Admin created successfully!";
?>
