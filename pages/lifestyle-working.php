<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Working Lifestyle - Standard Blog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../style.css">

</head>
<body class="bg-gray-50 text-gray-800">

  <?php include __DIR__ . '/../components/header.php'; ?> 

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Articles -->
    <section id="blogList" class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">

      <a href="working-post1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/productive_work.png" alt="post" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">6 min read</span>
        <div class="p-4">
          <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">Working</span>
          <h2 class="text-lg font-semibold mt-2">How to Stay Productive While Working From Home</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 12, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Practical tips for maintaining focus and productivity in a remote work environment...</p>
        </div>
      </a>

      <a href="working-post2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/work_life_balance.png" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">Achieving Work-Life Balance in a Demanding Job</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 10, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Strategies for maintaining balance when your career demands long hours...</p>
        </div>
      </a>

      <a href="working-post3.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/time_management.png" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">Effective Time Management Techniques for Professionals</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 8, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Learn how to prioritize tasks and maximize your productivity during work hours...</p>
        </div>
      </a>

      <a href="working-post4.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/professional_network.png" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">Building a Professional Network That Matters</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 5, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">How to create meaningful professional connections that advance your career...</p>
        </div>
      </a>

      <a href="working-post5.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/office_politics.png" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">Navigating Office Politics Successfully</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 3, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Tips for understanding and navigating workplace dynamics without compromising integrity...</p>
        </div>
      </a>

    </section>

    <?php include __DIR__ . '/../components/sidebar.php'; ?>  <!-- ✅ About Me -->

  </main>

  <!-- Latest Stories -->
  <section class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-xl font-bold mb-4">Latest Stories</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      <a href="working-story1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/remote_work.png" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">4 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">The Future of Remote Work: Trends to Watch</h3>
        </div>
      </a>
    </div>
  </section>

  <?php include __DIR__ . '/../components/footer.php'; ?>   <!-- ✅ Footer -->

  <!--  JS -->
  <script src="../script.js"></script>




</body>
</html>
