<?php
session_start();
include 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin.php");
    exit();
}

// Handle Add Post
if (isset($_POST['add_post'])) {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $category = $_POST['category'];
    $image_url = $_POST['image_url'];
    $author = $_POST['author'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, subtitle, category, image_url, author, content) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $subtitle, $category, $image_url, $author, $content);
    $stmt->execute();
    header("Location: manage_posts.php");
    exit();
}

// Handle Edit Post
if (isset($_POST['edit_post'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $category = $_POST['category'];
    $image_url = $_POST['image_url'];
    $author = $_POST['author'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title=?, subtitle=?, category=?, image_url=?, author=?, content=? WHERE id=?");
    $stmt->bind_param("ssssssi", $title, $subtitle, $category, $image_url, $author, $content, $id);
    $stmt->execute();
    header("Location: manage_posts.php");
    exit();
}

// Handle Delete Post
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM posts WHERE id = $id");
    header("Location: manage_posts.php");
    exit();
}

// Fetch all posts
$postsResult = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $postsResult->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Blog Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <header class="bg-red-600 text-white p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Manage Blog Posts</h1>
        <a href="dashboard.php" class="bg-white text-red-600 px-3 py-1 rounded hover:bg-gray-200">Dashboard</a>
    </header>

    <main class="p-6">
        <h2 class="text-lg font-semibold mb-4">Add New Post</h2>
        <form method="POST" class="bg-white p-4 rounded shadow mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="title" placeholder="Title" required class="border p-2 rounded w-full">
            <input type="text" name="subtitle" placeholder="Subtitle" class="border p-2 rounded w-full">
            <input type="text" name="category" placeholder="Category" class="border p-2 rounded w-full">
            <input type="text" name="image_url" placeholder="Image URL" class="border p-2 rounded w-full">
            <input type="text" name="author" placeholder="Author" class="border p-2 rounded w-full">
            <textarea name="content" placeholder="Content" rows="4" class="border p-2 rounded w-full"></textarea>
            <div class="md:col-span-2">
                <button type="submit" name="add_post" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Add Post</button>
            </div>
        </form>

        <h2 class="text-lg font-semibold mb-4">Existing Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php foreach ($posts as $post): ?>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-bold text-lg"><?= htmlspecialchars($post['title']) ?></h3>
                <p class="text-gray-500 text-sm"><?= htmlspecialchars($post['subtitle']) ?></p>
                <p class="text-gray-400 text-xs"><?= htmlspecialchars($post['category']) ?> • <?= htmlspecialchars($post['author']) ?> • <?= $post['created_at'] ?></p>
                <img src="<?= htmlspecialchars($post['image_url']) ?>" alt="image" class="my-2 w-full h-32 object-cover rounded">
                <p class="text-gray-600"><?= htmlspecialchars(substr($post['content'],0,100)) ?>...</p>
                <div class="mt-2 flex gap-2">
                    <!-- Edit Modal Trigger -->
                    <button onclick="openEditModal(<?= $post['id'] ?>, '<?= addslashes($post['title']) ?>', '<?= addslashes($post['subtitle']) ?>', '<?= addslashes($post['category']) ?>', '<?= addslashes($post['image_url']) ?>', '<?= addslashes($post['author']) ?>', '<?= addslashes($post['content']) ?>')" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</button>
                    <a href="?delete=<?= $post['id'] ?>" onclick="return confirm('Delete this post?');" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Delete</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow w-full max-w-xl">
            <h2 class="text-lg font-bold mb-4">Edit Post</h2>
            <form method="POST" id="editForm" class="grid grid-cols-1 gap-4">
                <input type="hidden" name="id" id="editId">
                <input type="text" name="title" id="editTitle" placeholder="Title" required class="border p-2 rounded w-full">
                <input type="text" name="subtitle" id="editSubtitle" placeholder="Subtitle" class="border p-2 rounded w-full">
                <input type="text" name="category" id="editCategory" placeholder="Category" class="border p-2 rounded w-full">
                <input type="text" name="image_url" id="editImage" placeholder="Image URL" class="border p-2 rounded w-full">
                <input type="text" name="author" id="editAuthor" placeholder="Author" class="border p-2 rounded w-full">
                <textarea name="content" id="editContent" placeholder="Content" rows="4" class="border p-2 rounded w-full"></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancel</button>
                    <button type="submit" name="edit_post" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, title, subtitle, category, image, author, content) {
            document.getElementById('editId').value = id;
            document.getElementById('editTitle').value = title;
            document.getElementById('editSubtitle').value = subtitle;
            document.getElementById('editCategory').value = category;
            document.getElementById('editImage').value = image;
            document.getElementById('editAuthor').value = author;
            document.getElementById('editContent').value = content;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>

</body>
</html>
