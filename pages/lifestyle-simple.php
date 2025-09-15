<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Lifestyle - Standard Blog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../style.css">

</head>
<body class="bg-gray-50 text-gray-800">

  <?php include __DIR__ . '/../components/header.php'; ?>   <!-- ✅ Navbar + Hot Topics -->

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

  <!-- Left Articles -->
  <section id="blogList" class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">

    <a href="simple-post1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
      <img src="../uploads/easy_home_hacks.png" alt="post" class="w-full h-48 object-cover">
      <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
      <div class="p-4">
        <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">Lifestyle</span>
        <h2 class="text-lg font-semibold mt-2">Easy Home Hacks to Simplify Your Life</h2>
        <p class="text-sm text-gray-500 mt-1">By Admin • September 10, 2025</p>
        <p class="text-gray-600 mt-2 text-sm">Simple tips to save time, reduce stress, and make everyday life easier...</p>
      </div>
    </a>

    <a href="simple-post2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
      <img src="../uploads/morning_routine_stress_free.png" alt="post" class="w-full h-48 object-cover">
      <div class="p-4">
        <h2 class="text-lg font-semibold">Morning Routines for a Stress-Free Start</h2>
        <p class="text-sm text-gray-500 mt-1">By Admin • September 8, 2025</p>
        <p class="text-gray-600 mt-2 text-sm">Learn simple morning habits that improve productivity and well-being...</p>
      </div>
    </a>

    <a href="simple-post3.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
      <img src="../uploads/peaceful_home.png" alt="post" class="w-full h-48 object-cover">
      <div class="p-4">
        <h2 class="text-lg font-semibold">Decluttering Tips for a Peaceful Home</h2>
        <p class="text-sm text-gray-500 mt-1">By Admin • September 5, 2025</p>
        <p class="text-gray-600 mt-2 text-sm">How to declutter effectively and enjoy a minimalist lifestyle...</p>
      </div>
    </a>

  </section>

<!-- Sidebar -->
  <?php include __DIR__ . '/../components/sidebar.php'; ?>  <!-- ✅ About Me --> 

</main>

<!-- Latest Stories -->
<section class="max-w-7xl mx-auto px-4 py-8">
  <h2 class="text-xl font-bold mb-4">Latest Stories</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <a href="simple-story1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
      <img src="../uploads/wellness.png" alt="story" class="w-full h-48 object-cover">
      <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">4 min read</span>
      <div class="p-4">
        <h3 class="font-semibold">Simple Wellness Practices to Boost Your Mood</h3>
      </div>
    </a>

    <a href="simple-story2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
      <img src="../uploads/stress_free_hacks.png" alt="story" class="w-full h-48 object-cover">
      <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
      <div class="p-4">
        <h3 class="font-semibold">Stress-Free Living Hacks You Can Try Today</h3>
      </div>
    </a>

  </div>
</section>

<?php include __DIR__ . '/../components/footer.php'; ?>   <!-- ✅ Footer -->

  <!--  JS -->
<script src="../script.js"></script>

</body>
</html>