<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Business Blog - Standard Blog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-gray-50 text-gray-800">

  <?php include __DIR__ . '/../components/header.php'; ?>   <!-- ✅ Navbar + Hot Topics -->

  <!--  Main Content -->
  <main class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Articles -->
    <section id="blogList" class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">

      <!-- Business Posts -->
      <a href="post1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/startup.jpg" alt="post" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">6 min read</span>
        <div class="p-4">
          <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">Business</span>
          <h2 class="text-lg font-semibold mt-2">Top 10 Tips for Scaling Your Startup</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 12, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Scaling your business requires careful planning and strategy...</p>
        </div>
      </a>

      <a href="post2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/business_finance.jpg" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">How to Keep Your Business Finances Organized</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 10, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Organizing finances is essential to make informed decisions and avoid mistakes...</p>
        </div>
      </a>

      <a href="post3.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/marketing_strategy.jpg" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">Marketing Strategies That Actually Work in 2025</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 8, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Discover the latest marketing tactics that can increase your ROI and brand visibility...</p>
        </div>
      </a>

      <a href="post4.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/remote_team.jpg" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">How to Build a Remote Team Successfully</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 5, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Remote teams can thrive if you implement effective communication and collaboration...</p>
        </div>
      </a>

      <a href="post5.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/financial_planning.jpg" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">Financial Planning for Small Business Owners</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 1, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">A comprehensive guide to budgeting, saving, and investing for small business success...</p>
        </div>
      </a>

    </section>
    <?php include __DIR__ . '/../components/sidebar.php'; ?>  <!-- ✅ About Me -->
  
  </main>

  <!--  Latest Stories -->
  <section class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-xl font-bold mb-4">Latest Stories</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">

      <a href="story1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/ballet_performance.jpg" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">Ballet Performances That Inspire</h3>
        </div>
      </a>


      <a href="story2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/innovative_business.jpg" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">7 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">Innovative Business Ideas for 2025</h3>
        </div>
      </a>

      <a href="story3.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/tech_trends.jpg" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">4 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">Top Tech Trends Changing Businesses</h3>
        </div>
      </a>

      <a href="story5.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/effective_leadership.jpg" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">Effective Leadership Skills for CEOs</h3>
        </div>
      </a>

    </div>
  </section>

  <?php include __DIR__ . '/../components/footer.php'; ?>   <!-- ✅ Footer -->

  <!--  JS: Toggle Search + Dropdowns -->
  <script src="../script.js"></script>


</body>
</html>