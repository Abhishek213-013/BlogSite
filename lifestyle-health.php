<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Healthy Lifestyle - Standard Blog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">

</head>
<body class="bg-gray-50 text-gray-800">

  <?php include 'header.php'; ?>   <!-- ✅ Navbar + Hot Topics -->

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

  <!-- Left Articles -->
  <section id="blogList" class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">

    <a href="simple-post1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
      <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1153&q=80" alt="post" class="w-full h-48 object-cover">
      <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
      <div class="p-4">
        <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">Lifestyle</span>
        <h2 class="text-lg font-semibold mt-2">Healthy Eating on a Budget</h2>
        <p class="text-sm text-gray-500 mt-1">By Admin • September 10, 2025</p>
        <p class="text-gray-600 mt-2 text-sm">Healthy tips to save time, reduce stress, and make everyday life easier...</p>
      </div>
    </a>

    <a href="simple-post2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
      <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="post" class="w-full h-48 object-cover">
      <div class="p-4">
        <h2 class="text-lg font-semibold">Easy Workouts at Home</h2>
        <p class="text-sm text-gray-500 mt-1">By Admin • September 8, 2025</p>
        <p class="text-gray-600 mt-2 text-sm">Learn easy workouts at home that improve productivity and well-being...</p>
      </div>
    </a>

    <a href="simple-post3.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
      <img src="https://images.unsplash.com/photo-1526662092590-e314cbeaf8da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80" alt="post" class="w-full h-48 object-cover">
      <div class="p-4">
        <h2 class="text-lg font-semibold">Mental Health Tips for Busy People</h2>
        <p class="text-sm text-gray-500 mt-1">By Admin • September 5, 2025</p>
        <p class="text-gray-600 mt-2 text-sm">How to maintain mental wellness while managing a busy schedule...</p>
      </div>
    </a>

  </section>

  <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>  <!-- ✅ About Me -->

  </main>

  <!-- Latest Stories -->
  <section class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-xl font-bold mb-4">Latest Stories</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      <a href="simple-story1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1120&q=80" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">4 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">Yoga Practices for Beginners</h3>
        </div>
      </a>

      <a href="simple-story2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://images.unsplash.com/photo-1494390248081-4e521a5940db?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1106&q=80" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">Nutrition Myths Debunked</h3>
        </div>
      </a>

    </div>
  </section>
  <?php include 'footer.php'; ?>   <!-- ✅ Footer -->

  <!--  JS: Toggle Search + Dropdowns -->
  <script src="script.js"></script>

</body>
</html>