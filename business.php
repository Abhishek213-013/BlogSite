<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Business Blog - Standard Blog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-50 text-gray-800">

  <?php include 'header.php'; ?>   <!-- ✅ Navbar + Hot Topics -->

  <!--  Main Content -->
  <main class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Articles -->
    <section id="blogList" class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">

      <!-- Business Posts -->
      <a href="post1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="post" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">6 min read</span>
        <div class="p-4">
          <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">Business</span>
          <h2 class="text-lg font-semibold mt-2">Top 10 Tips for Scaling Your Startup</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 12, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Scaling your business requires careful planning and strategy...</p>
        </div>
      </a>

      <a href="post2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">How to Keep Your Business Finances Organized</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 10, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Organizing finances is essential to make informed decisions and avoid mistakes...</p>
        </div>
      </a>

      <a href="post3.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1115&q=80" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">Marketing Strategies That Actually Work in 2025</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 8, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Discover the latest marketing tactics that can increase your ROI and brand visibility...</p>
        </div>
      </a>

      <a href="post4.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">How to Build a Remote Team Successfully</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 5, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Remote teams can thrive if you implement effective communication and collaboration...</p>
        </div>
      </a>

      <a href="post5.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1011&q=80" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">Financial Planning for Small Business Owners</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 1, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">A comprehensive guide to budgeting, saving, and investing for small business success...</p>
        </div>
      </a>

    </section>
    <?php include 'sidebar.php'; ?>  <!-- ✅ About Me -->
  
  </main>

  <!--  Latest Stories -->
  <section class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-xl font-bold mb-4">Latest Stories</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">

      <a href="story1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1547036967-23d11aacaee0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1173&q=80" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">Ballet Performances That Inspire</h3>
        </div>
      </a>

      <a href="story2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">6 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">Historic Mansions You Must Visit</h3>
        </div>
      </a>

      <a href="story3.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">7 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">Innovative Business Ideas for 2025</h3>
        </div>
      </a>

      <a href="story4.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">4 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">Top Tech Trends Changing Businesses</h3>
        </div>
      </a>

      <a href="story5.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">Effective Leadership Skills for CEOs</h3>
        </div>
      </a>

    </div>
  </section>

  <?php include 'footer.php'; ?>   <!-- ✅ Footer -->

  <!--  JS: Toggle Search + Dropdowns -->
  <script src="script.js"></script>


</body>
</html>