<?php
include 'db.php';
$id = (int)$_GET['id'];
$result = $conn->query("SELECT * FROM posts WHERE id = $id");
$post = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($post['title']) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 max-w-4xl mx-auto p-6">
  <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($post['title']) ?></h1>
  <p class="text-gray-500 mb-2"><?= htmlspecialchars($post['subtitle']) ?></p>
  <p class="text-sm text-gray-400 mb-4">
    <?= htmlspecialchars($post['category']) ?> • 
    By <?= htmlspecialchars($post['author']) ?> • 
    <?= date("F d, Y", strtotime($post['created_at'])) ?>
  </p>
  <img src="<?= htmlspecialchars($post['image_url']) ?>" class="w-full h-80 object-cover rounded mb-6">
  <p class="text-lg leading-relaxed"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
</body>
</html>
