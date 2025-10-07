<?php
include __DIR__ . '/../db.php'; // DB connection

// Fetch business posts from database
$businessPostsResult = $conn->query("SELECT * FROM business_posts ORDER BY created_at DESC");
$businessPosts = $businessPostsResult->fetch_all(MYSQLI_ASSOC);
?>

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

  <?php include __DIR__ . '/../components/header.php'; ?> <!-- Navbar + Hot Topics -->

  <!--  Main Content -->
  <main class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Articles -->
    <section id="blogList" class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">

      <!-- Dynamic Business Posts -->
      <?php if (!empty($businessPosts)): ?>
        <?php foreach($businessPosts as $post): ?>
          <a href="post.php?id=<?= $post['id'] ?>" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
            <?php if (!empty($post['image_url'])): ?>
              <img src="../<?= htmlspecialchars($post['image_url']) ?>" alt="post" class="w-full h-48 object-cover">
            <?php endif; ?>
            <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">6 min read</span>
            <div class="p-4">
              <?php if(!empty($post['category'])): ?>
                <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded"><?= htmlspecialchars($post['category']) ?></span>
              <?php endif; ?>
              <h2 class="text-lg font-semibold mt-2"><?= htmlspecialchars($post['title']) ?></h2>
              <?php if(!empty($post['author']) || !empty($post['created_at'])): ?>
                <p class="text-sm text-gray-500 mt-1">
                  By <?= htmlspecialchars($post['author'] ?: 'Admin') ?> • <?= date("F j, Y", strtotime($post['created_at'])) ?>
                </p>
              <?php endif; ?>
              <?php if(!empty($post['content'])): ?>
                <p class="text-gray-600 mt-2 text-sm"><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...</p>
              <?php endif; ?>
            </div>
          </a>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-gray-500">No business posts found.</p>
      <?php endif; ?>

    </section>

    <?php include __DIR__ . '/../components/sidebar.php'; ?> <!-- Sidebar / About Me -->

  </main>

  <!--  Latest Stories Section -->
  <section class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-xl font-bold mb-4">Latest Stories</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">

      <?php
      // Example: You can fetch latest 3-6 stories dynamically from another table, e.g., `posts`
      $latestStoriesResult = $conn->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 6");
      $latestStories = $latestStoriesResult->fetch_all(MYSQLI_ASSOC);

      if(!empty($latestStories)):
        foreach($latestStories as $story):
      ?>
        <a href="../posts/post.php?id=<?= $story['id'] ?>" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
          <?php if(!empty($story['image_url'])): ?>
            <img src="../<?= htmlspecialchars($story['image_url']) ?>" alt="story" class="w-full h-48 object-cover">
          <?php endif; ?>
          <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
          <div class="p-4">
            <h3 class="font-semibold"><?= htmlspecialchars($story['title']) ?></h3>
          </div>
        </a>
      <?php
        endforeach;
      else:
      ?>
        <p class="text-gray-500">No stories available.</p>
      <?php endif; ?>

    </div>
  </section>

  <?php include __DIR__ . '/../components/footer.php'; ?> <!-- Footer -->

  <!-- JS: Toggle Search + Dropdowns -->
  <script src="../script.js"></script>

</body>
</html>
