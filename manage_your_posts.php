<?php
include 'db.php';
include 'admin_protect.php';

if (!isset($_SESSION['admin_token']) || time() > $_SESSION['admin_expiry']) {
    session_unset();
    session_destroy();
    header("Location: admin.php");
    exit();
}

$admin_username = $_SESSION['admin_username'] ?? 'Admin';
$expiry_time    = $_SESSION['admin_expiry'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Your Posts</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

  <!-- Navbar/Header -->
  <header class="bg-red-600 text-white p-4 flex justify-between items-center shadow-md">
      <h1 class="text-2xl font-bold">Manage Your Posts</h1>
      <a href="logout.php" class="bg-white text-red-600 px-4 py-2 rounded hover:bg-gray-200 transition">Logout</a>
  </header>

  <!-- Hero / Content -->
  <main class="p-6 max-w-6xl mx-auto">
      <h2 class="text-xl font-semibold mb-2">Welcome, <?= htmlspecialchars($admin_username) ?></h2>
      <p>Token expires in: <span id="countdown"></span></p>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
          <!-- Home Page Posts -->
          <a href="manage_home_posts.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition transform hover:-translate-y-1 text-center">
              <h3 class="text-lg font-semibold mb-2">Home Page Posts</h3>
              <p class="text-gray-600">Manage posts displayed on homepage.</p>
          </a>

          <!-- Business Page Posts -->
          <a href="manage_business_posts.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition transform hover:-translate-y-1 text-center">
              <h3 class="text-lg font-semibold mb-2">Business Page Posts</h3>
              <p class="text-gray-600">Manage posts for the Business section.</p>
          </a>

          <!-- Lifestyle-simple Page Posts -->
          <a href="manage_lifestyle_simple_posts.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition transform hover:-translate-y-1 text-center">
              <h3 class="text-lg font-semibold mb-2">Lifestyle - Simple</h3>
              <p class="text-gray-600">Manage Simple Lifestyle posts.</p>
          </a>

          <!-- Lifestyle-health Page Posts -->
          <a href="manage_lifestyle_health_posts.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition transform hover:-translate-y-1 text-center">
              <h3 class="text-lg font-semibold mb-2">Lifestyle - Health</h3>
              <p class="text-gray-600">Manage Health Lifestyle posts.</p>
          </a>
      </div>
  </main>

  <script>
  // Countdown timer
  let expiry = <?= $expiry_time ?>;
  function updateCountdown() {
      let now = Math.floor(Date.now() / 1000);
      let diff = expiry - now;

      if(diff <= 0){
          alert("Token expired! Redirecting to login.");
          window.location.href = "admin.php";
          return;
      }

      let minutes = Math.floor(diff / 60);
      let seconds = diff % 60;
      document.getElementById('countdown').textContent = `${minutes}:${seconds.toString().padStart(2,'0')}`;
  }

  setInterval(updateCountdown, 1000);
  updateCountdown();
  </script>

</body>
</html>
