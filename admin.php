<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check credentials
    $stmt = $conn->prepare("SELECT id, password_hash FROM admins WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        // Credentials valid, generate session token
        $_SESSION['admin_id']     = $admin['id'];
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_token']  = bin2hex(random_bytes(16)); // random token
        $_SESSION['admin_expiry'] = time() + (30 * 60); // 30 minutes

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
    <?php if($error): ?>
      <p class="bg-red-100 text-red-700 px-3 py-2 rounded mb-4"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <label class="block mb-2">Username</label>
        <input type="text" name="username" class="w-full mb-4 p-2 border rounded" required>

        <label class="block mb-2">Password</label>
        <input type="password" name="password" class="w-full mb-4 p-2 border rounded" required>

        <button type="submit" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">
            Login
        </button>
    </form>
</div>
</body>
</html>
