<?php
session_start();
include 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin.php");
    exit();
}

$admin_username = $_SESSION['admin_username'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

  <!-- Header -->
  <header class="bg-red-600 text-white p-4 flex justify-between items-center shadow-md">
    <h1 class="text-2xl font-bold">Admin Dashboard</h1>
    <a href="logout.php" class="bg-white text-red-600 px-4 py-2 rounded hover:bg-gray-200 transition">Logout</a>
  </header>

  <!-- Main Content -->
  <main class="p-6 max-w-6xl mx-auto">
    <h2 class="text-xl font-semibold mb-6">Welcome, <?= htmlspecialchars($admin_username) ?></h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <!-- Manage Global Settings -->
      <a href="manage_settings.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition transform hover:-translate-y-1 text-center">
        <h3 class="text-lg font-semibold mb-2">Manage Global Settings</h3>
        <p class="text-gray-600">Edit website title, subtitle, hot topics, and other global content that appears site-wide.</p>
      </a>

      <!-- Manage Blog Posts -->
      <a href="manage_posts.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition transform hover:-translate-y-1 text-center">
        <h3 class="text-lg font-semibold mb-2">Manage Blog Posts</h3>
        <p class="text-gray-600">Add, edit, or delete blog posts including titles, excerpts, images, and categories.</p>
      </a>
    </div>
  </main>

</body>
</html>
