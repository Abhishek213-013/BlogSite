<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destination Travel - Standard Blog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../style.css">

</head>
<body class="bg-gray-50 text-gray-800">

  <?php include __DIR__ . '/../components/header.php'; ?>

  <!--  Main Content -->
  <main class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Articles -->
    <section id="blogList" class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">

      <!-- Technology Posts -->
      <a href="post1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/travel.jpg" alt="post" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">6 min read</span>
        <div class="p-4">
          <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">Travel</span>
          <h2 class="text-lg font-semibold mt-2">The Best Indoor Plants to Boost Your Mood and Purify the Air</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 12, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipiscing elit commodo nec, dictumst placerat nisi aptent morbi […] </p>
        </div>
      </a>

      <a href="post2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/finance_ind.jpg" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
            <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">Travel</span>
          <h2 class="text-lg font-semibold">How to Achieve Financial Independence and Live the Life You Want</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 10, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipiscing elit cursus cubilia egestas, convallis aptent proin sed […] </p>
        </div>
      </a>

      <a href="post3.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/positive_mind.jpg" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">Travel</span>
          <h2 class="text-lg font-semibold">How to Cultivate a Positive Mindset Even During Challenging Times</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 8, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipiscing elit cursus cubilia egestas, convallis aptent proin sed […] </p>
        </div>
      </a>

      <a href="post4.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/save_money.jpg" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">Travel</span>
          <h2 class="text-lg font-semibold">How to Save Money on Groceries Without Sacrificing Quality or Taste</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 5, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipiscing elit molestie, conubia urna arcu vel nostra rutrum […] </p>
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
        <img src="../uploads/outdoor_activity.jpg" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">10 Fun Outdoor Activities to Enjoy With Your Kids</h3>
        </div>
      </a>

      <a href="story2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="../uploads/self_care.jpg" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">6 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">The Importance of Self-Care and How to Incorporate It Into Your Routine </h3>
        </div>
      </a>


    </div>
  </section>

  <?php include __DIR__ . '/../components/footer.php'; ?>   <!-- ✅ Footer -->

  <!--  JS -->
  <script src="../script.js"></script>

</body>
</html>