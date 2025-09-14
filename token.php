<?php
$token = bin2hex(random_bytes(16)); // 32-character token

echo "Your token  is: " . $token;
?>
