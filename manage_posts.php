<?php
include 'admin_protect.php';
include 'db.php';

if (!isset($_SESSION['admin_token']) || time() > $_SESSION['admin_expiry']) {
    session_unset();
    session_destroy();
    header("Location: admin.php");
    exit();
}

// --------------------
// Function to handle file upload
// --------------------
function uploadImage($fileInput, $oldFile = null) {
    if (!isset($_FILES[$fileInput]) || $_FILES[$fileInput]['error'] !== UPLOAD_ERR_OK) {
        return $oldFile; // keep old file if no new upload
    }

    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $ext      = pathinfo($_FILES[$fileInput]['name'], PATHINFO_EXTENSION);
    $fileName = time() . "_" . bin2hex(random_bytes(5)) . "." . $ext;
    $target   = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES[$fileInput]['tmp_name'], $target)) {
        // Remove old file
        if ($oldFile && file_exists($oldFile)) unlink($oldFile);
        return $target;
    }
    return $oldFile;
}

// --------------------
// Handle Add Post
// --------------------
if (isset($_POST['add_post'])) {
    $title    = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $category = $_POST['category'];
    $author   = $_POST['author'];
    $content  = $_POST['content'];
    $imagePath = uploadImage("image");

    $stmt = $conn->prepare("INSERT INTO posts (title, subtitle, category, image_url, author, content) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $subtitle, $category, $imagePath, $author, $content);
    $stmt->execute();
    header("Location: manage_posts.php");
    exit();
}

// --------------------
// Handle Edit Post
// --------------------
if (isset($_POST['edit_post'])) {
    $id       = $_POST['id'];
    $title    = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $category = $_POST['category'];
    $author   = $_POST['author'];
    $content  = $_POST['content'];

    // Get old image path
    $result = $conn->query("SELECT image_url FROM posts WHERE id = $id");
    $oldFile = $result->fetch_assoc()['image_url'] ?? null;

    $imagePath = uploadImage("editImageFile", $oldFile);

    $stmt = $conn->prepare("UPDATE posts SET title=?, subtitle=?, category=?, image_url=?, author=?, content=? WHERE id=?");
    $stmt->bind_param("ssssssi", $title, $subtitle, $category, $imagePath, $author, $content, $id);
    $stmt->execute();
    header("Location: manage_posts.php");
    exit();
}

// --------------------
// Handle Delete Post
// --------------------
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    // Get image path
    $result = $conn->query("SELECT image_url FROM posts WHERE id = $id");
    $image = $result->fetch_assoc()['image_url'] ?? null;
    if ($image && file_exists($image)) unlink($image);

    $conn->query("DELETE FROM posts WHERE id = $id");
    header("Location: manage_posts.php");
    exit();
}

// --------------------
// Fetch all posts
// --------------------
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
    <!-- Add New Post -->
    <h2 class="text-lg font-semibold mb-4">Add New Post</h2>
    <form method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <input type="text" name="title" placeholder="Title" required class="border p-2 rounded w-full">
        <input type="text" name="subtitle" placeholder="Subtitle" class="border p-2 rounded w-full">
        <input type="text" name="category" placeholder="Category" class="border p-2 rounded w-full">
        <input type="file" name="image" accept="image/*" class="border p-2 rounded w-full">
        <input type="text" name="author" placeholder="Author" class="border p-2 rounded w-full">
        <textarea name="content" placeholder="Content" rows="4" class="border p-2 rounded w-full"></textarea>
        <div class="md:col-span-2">
            <button type="submit" name="add_post" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Add Post</button>
        </div>
    </form>

    <!-- Existing Posts -->
    <h2 class="text-lg font-semibold mb-4">Existing Posts</h2>
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 text-left">#</th>
                    <th class="p-2 text-left">Title</th>
                    <th class="p-2 text-left">Category</th>
                    <th class="p-2 text-left">Author</th>
                    <th class="p-2 text-left">Created</th>
                    <th class="p-2 text-left">Image</th>
                    <th class="p-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $index => $post): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2"><?= $index + 1 ?></td>
                    <td class="p-2 font-semibold"><?= htmlspecialchars($post['title']) ?></td>
                    <td class="p-2"><?= htmlspecialchars($post['category']) ?></td>
                    <td class="p-2"><?= htmlspecialchars($post['author']) ?></td>
                    <td class="p-2 text-sm text-gray-500"><?= $post['created_at'] ?></td>
                    <td class="p-2">
                        <?php if ($post['image_url']): ?>
                            <img src="<?= htmlspecialchars('uploads/' . basename($post['image_url'])) ?>" 
                                alt="thumb" class="w-12 h-12 object-cover rounded">
                        <?php else: ?>
                            <span class="text-gray-400">No image</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-2 flex gap-2 justify-center">
                        <button 
                            onclick="openEditModal(<?= $post['id'] ?>, '<?= addslashes($post['title']) ?>', '<?= addslashes($post['subtitle']) ?>', '<?= addslashes($post['category']) ?>', '<?= addslashes($post['image_url']) ?>', '<?= addslashes($post['author']) ?>', '<?= addslashes($post['content']) ?>')" 
                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">Edit</button>
                        <a href="?delete=<?= $post['id'] ?>" 
                        onclick="return confirm('Delete this post?');" 
                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow w-full max-w-xl">
        <h2 class="text-lg font-bold mb-4">Edit Post</h2>
        <form method="POST" enctype="multipart/form-data" id="editForm" class="grid grid-cols-1 gap-4">
            <input type="hidden" name="id" id="editId">
            <input type="text" name="title" id="editTitle" placeholder="Title" required class="border p-2 rounded w-full">
            <input type="text" name="subtitle" id="editSubtitle" placeholder="Subtitle" class="border p-2 rounded w-full">
            <input type="text" name="category" id="editCategory" placeholder="Category" class="border p-2 rounded w-full">
            <input type="file" name="editImageFile" accept="image/*" class="border p-2 rounded w-full">
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