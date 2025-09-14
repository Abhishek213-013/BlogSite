<?php
include 'db.php';

// Fetch site settings
$settingsResult = $conn->query("SELECT * FROM settings WHERE id = 1");
$settings = $settingsResult->fetch_assoc();

// Fetch latest posts
$postsResult = $conn->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 6");
$posts = $postsResult->fetch_all(MYSQLI_ASSOC);

// Function to get correct image path
function getPostImage($imageUrl) {
    if (!empty($imageUrl) && file_exists($imageUrl)) {
        return $imageUrl; // Use uploaded image
    } else {
        return 'default.jpg'; // Default placeholder
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Standard Blog</title>
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
      <?php foreach ($posts as $post): ?>
    <a href="post.php?id=<?= $post['id'] ?>" 
      class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
      <img src="<?= htmlspecialchars('uploads/' . basename($post['image_url'])) ?>" alt="post" class="w-full h-48 object-cover">

      <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
      <div class="p-4">
        <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">
          <?= htmlspecialchars($post['category']) ?>
        </span>
        <h2 class="text-lg font-semibold mt-2"><?= htmlspecialchars($post['title']) ?></h2>
        <p class="text-sm text-gray-500 mt-1">By <?= htmlspecialchars($post['author']) ?> • <?= date("F d, Y", strtotime($post['created_at'])) ?></p>
        <p class="text-gray-600 mt-2 text-sm"><?= htmlspecialchars(substr($post['content'],0,100)) ?>...</p>
      </div>
    </a>
<?php endforeach; ?>

    </section>
    <?php include 'sidebar.php'; ?>  <!-- ✅ About Me -->
  </main>


  <!--  Latest Stories -->
  <section class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-xl font-bold mb-4">Latest Stories</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
      </div>
  </section>

  <?php include 'footer.php'; ?>   <!-- ✅ Footer -->

  <!--  JS -->
  <script src="script.js"></script>


</body>
</html>