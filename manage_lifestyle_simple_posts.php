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
    $category = $_POST['category'] ?: $_POST['category_new'];
    $author   = $_POST['author'] ?: $_POST['author_new'];
    $content  = $_POST['content'];
    $imagePath = uploadImage("image");

    $stmt = $conn->prepare("INSERT INTO lifestyle_simple_posts (title, subtitle, category, image_url, author, content) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $subtitle, $category, $imagePath, $author, $content);
    $stmt->execute();
    header("Location: manage_lifestyle_simple_posts.php");
    exit();
}

// --------------------
// Handle Edit Post
// --------------------
if (isset($_POST['edit_post'])) {
    $id       = $_POST['id'];
    $title    = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $category = $_POST['category'] ?: $_POST['category_new'];
    $author   = $_POST['author'] ?: $_POST['author_new'];
    $content  = $_POST['content'];

    $result = $conn->query("SELECT image_url FROM lifestyle_simple_posts WHERE id = $id");
    $oldFile = $result->fetch_assoc()['image_url'] ?? null;

    $imagePath = uploadImage("editImageFile", $oldFile);

    $stmt = $conn->prepare("UPDATE lifestyle_simple_posts SET title=?, subtitle=?, category=?, image_url=?, author=?, content=? WHERE id=?");
    $stmt->bind_param("ssssssi", $title, $subtitle, $category, $imagePath, $author, $content, $id);
    $stmt->execute();
    header("Location: manage_lifestyle_simple_posts.php");
    exit();
}

// --------------------
// Handle Delete Post
// --------------------
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $result = $conn->query("SELECT image_url FROM lifestyle_simple_posts WHERE id = $id");
    $image = $result->fetch_assoc()['image_url'] ?? null;
    if ($image && file_exists($image)) unlink($image);

    $conn->query("DELETE FROM lifestyle_simple_posts WHERE id = $id");
    header("Location: manage_lifestyle_simple_posts.php");
    exit();
}

// --------------------
// Handle Add More Images
// --------------------
if (isset($_POST['add_images'])) {
    $postId = (int)$_POST['postId'];

    foreach ($_FILES['extra_images']['tmp_name'] as $key => $tmpName) {
        if ($_FILES['extra_images']['error'][$key] === UPLOAD_ERR_OK) {
            $ext      = pathinfo($_FILES['extra_images']['name'][$key], PATHINFO_EXTENSION);
            $fileName = time() . "_" . bin2hex(random_bytes(5)) . "." . $ext;
            $target   = "uploads/" . $fileName;
            if (move_uploaded_file($tmpName, $target)) {
                $stmt = $conn->prepare("INSERT INTO post_attachments (postId, fileType, fileUrl) VALUES (?, ?, ?)");
                $fileType = mime_content_type($target);
                $stmt->bind_param("iss", $postId, $fileType, $target);
                $stmt->execute();
            }
        }
    }
    header("Location: manage_lifestyle_simple_posts.php");
    exit();
}


// --------------------
// Fetch posts + dropdown data
// --------------------
$postsResult = $conn->query("SELECT * FROM lifestyle_simple_posts ORDER BY created_at DESC");
$posts = $postsResult->fetch_all(MYSQLI_ASSOC);

$categoriesResult = $conn->query("SELECT DISTINCT category FROM lifestyle_simple_posts WHERE category IS NOT NULL AND category <> ''");
$authorsResult    = $conn->query("SELECT DISTINCT author FROM lifestyle_simple_posts WHERE author IS NOT NULL AND author <> ''");
$categories = $categoriesResult->fetch_all(MYSQLI_ASSOC);
$authors    = $authorsResult->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Blog Posts - Simple Lifestyle</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<header class="bg-red-600 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">Manage Blog Posts - Simple Lifestyle</h1>
    <a href="dashboard.php" class="bg-white text-red-600 px-3 py-1 rounded hover:bg-gray-200">Dashboard</a>
</header>
<div class="flex">
    <?php include './components/admin_sidebar.php'; ?>
<main class="p-6">
    <!-- Add Post Button -->
    <div class="mb-6">
        <button onclick="openAddModal()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            + Add Post
        </button>
    </div>

    <!-- Existing Posts -->
    <h2 class="text-lg font-semibold mb-4">Existing Posts</h2>
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 text-left">#</th>
                    <th class="p-2 text-left">Thumbnail</th>
                    <th class="p-2 text-left">Title</th>
                    <th class="p-2 text-left">Category</th>
                    <th class="p-2 text-left">Author</th>
                    <th class="p-2 text-left">Created</th>
                    <th class="p-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $index => $post): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2"><?= $index + 1 ?></td>
                    <td class="p-2">
                        <?php if ($post['image_url']): ?>
                            <img src="<?= htmlspecialchars('uploads/' . basename($post['image_url'])) ?>" 
                                alt="thumb" class="w-12 h-12 object-cover rounded">
                        <?php else: ?>
                            <span class="text-gray-400">No image</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-2 font-semibold"><?= htmlspecialchars($post['title']) ?></td>
                    <td class="p-2"><?= htmlspecialchars($post['category']) ?></td>
                    <td class="p-2"><?= htmlspecialchars($post['author']) ?></td>
                    <td class="p-2 text-sm text-gray-500"><?= $post['created_at'] ?></td>
                    <td class="p-2 text-center">
                        <!-- Dropdown -->
                        <div class="relative inline-block text-left">
                            <button onclick="toggleDropdown(<?= $post['id'] ?>)" 
                            class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300">
                                ☰
                            </button>
                            <div id="dropdown-<?= $post['id'] ?>" 
                            class="hidden absolute right-full top-0 mr-2 w-40 bg-white border rounded shadow-lg z-10">


                                <button onclick="openEditModal(<?= $post['id'] ?>, '<?= addslashes($post['title']) ?>', '<?= addslashes($post['subtitle']) ?>', '<?= addslashes($post['category']) ?>', '<?= addslashes($post['image_url']) ?>', '<?= addslashes($post['author']) ?>', '<?= addslashes($post['content']) ?>')" 
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">✏ Edit Post</button>

                                <button onclick="openImageModal(<?= $post['id'] ?>)" 
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">🖼 Add More Images</button>

                                    <a href="?delete=<?= $post['id'] ?>" 
                                    onclick="return confirm('Delete this post?');" 
                                 class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">🗑 Delete</a>
                            </div>
                        </div>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>
</div>
<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow w-full max-w-xl">
        <h2 class="text-lg font-bold mb-4">Add New Post</h2>
        <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-4">
            <input type="text" name="title" placeholder="Title" required class="border p-2 rounded w-full">
            <input type="text" name="subtitle" placeholder="Subtitle" class="border p-2 rounded w-full">

            <select name="category" class="border p-2 rounded w-full">
                <option value="">-- Select Category --</option>
                <?php foreach($categories as $row): ?>
                    <option value="<?= htmlspecialchars($row['category']) ?>"><?= htmlspecialchars($row['category']) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="category_new" placeholder="Or add new category" class="border p-2 rounded w-full">

            <input type="file" name="image" accept="image/*" class="border p-2 rounded w-full">

            <select name="author" class="border p-2 rounded w-full">
                <option value="">-- Select Author --</option>
                <?php foreach($authors as $row): ?>
                    <option value="<?= htmlspecialchars($row['author']) ?>"><?= htmlspecialchars($row['author']) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="author_new" placeholder="Or add new author" class="border p-2 rounded w-full">

            <textarea name="content" placeholder="Content" rows="4" class="border p-2 rounded w-full"></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeAddModal()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancel</button>
                <button type="submit" name="add_post" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Add Post</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded shadow w-full max-w-xl max-h-[90vh] flex flex-col overflow-hidden">
        <!-- Modal Header -->
        <h2 class="text-lg font-bold p-4 border-b">Edit Post</h2>

        <!-- Scrollable Content -->
        <div class="p-4 overflow-y-auto flex-1">
            <form method="POST" enctype="multipart/form-data" id="editForm" class="grid grid-cols-1 gap-4">
                <input type="hidden" name="id" id="editId">
                <input type="text" name="title" id="editTitle" placeholder="Title" required class="border p-2 rounded w-full">
                <input type="text" name="subtitle" id="editSubtitle" placeholder="Subtitle" class="border p-2 rounded w-full">

                <select name="category" id="editCategory" class="border p-2 rounded w-full">
                    <option value="">-- Select Category --</option>
                    <?php foreach($categories as $row): ?>
                        <option value="<?= htmlspecialchars($row['category']) ?>"><?= htmlspecialchars($row['category']) ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="category_new" placeholder="Or add new category" class="border p-2 rounded w-full">

                <input type="file" name="editImageFile" accept="image/*" class="border p-2 rounded w-full">

                <select name="author" id="editAuthor" class="border p-2 rounded w-full">
                    <option value="">-- Select Author --</option>
                    <?php foreach($authors as $row): ?>
                        <option value="<?= htmlspecialchars($row['author']) ?>"><?= htmlspecialchars($row['author']) ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="author_new" placeholder="Or add new author" class="border p-2 rounded w-full">

                <textarea name="content" id="editContent" placeholder="Content" rows="4" class="border p-2 rounded w-full"></textarea>
            </form>
        </div>

        <!-- Modal Footer (always visible) -->
        <div class="p-4 border-t flex justify-end gap-2 bg-white">
            <button type="button" onclick="closeEditModal()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancel</button>
            <button type="submit" name="edit_post" form="editForm" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Save Changes</button>
        </div>
    </div>
</div>


<!-- Add More Images Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow w-full max-w-md">
        <h2 class="text-lg font-bold mb-4">Add More Images</h2>
        <form method="POST" enctype="multipart/form-data" class="grid gap-4">
            <input type="hidden" name="postId" id="imagePostId">
            <input type="file" name="extra_images[]" multiple accept="image/*" class="border p-2 rounded w-full">
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeImageModal()" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" name="add_images" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Upload</button>
            </div>
        </form>
    </div>
</div>


    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }
        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }
        function openEditModal(id, title, subtitle, category, image, author, content) {
            document.getElementById('editId').value = id;
            document.getElementById('editTitle').value = title;
            document.getElementById('editSubtitle').value = subtitle;
            document.getElementById('editContent').value = content;

            // Select category in dropdown
            let catSelect = document.getElementById('editCategory');
            for (let option of catSelect.options) {
                option.selected = (option.value === category);
            }

            // Select author in dropdown
            let authSelect = document.getElementById('editAuthor');
            for (let option of authSelect.options) {
                option.selected = (option.value === author);
            }

            document.getElementById('editModal').classList.remove('hidden');
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function toggleDropdown(id) {
            const dropdown = document.getElementById("dropdown-" + id);

            // Close other dropdowns first
            document.querySelectorAll("[id^='dropdown-']").forEach(el => {
                if (el.id !== "dropdown-" + id) el.classList.add("hidden");
            });

            dropdown.classList.toggle("hidden");

            // Smart positioning
            const rect = dropdown.getBoundingClientRect();
            const viewportHeight = window.innerHeight;

            if (rect.bottom > viewportHeight) {
                dropdown.classList.remove("top-full");
                dropdown.classList.add("bottom-full", "mb-1"); // opens upwards
            } else {
                dropdown.classList.remove("bottom-full", "mb-1");
                dropdown.classList.add("top-full"); // opens downwards
             }
        }


        // Close dropdowns when clicking outside
        document.addEventListener("click", function(e) {
            const isToggleBtn = e.target.closest("button[onclick^='toggleDropdown']");
            const isDropdownMenu = e.target.closest("[id^='dropdown-']");

            if (isToggleBtn || isDropdownMenu) return;

            document.querySelectorAll("[id^='dropdown-']").forEach(el => el.classList.add("hidden"));
        });


        function openImageModal(postId) {
            document.getElementById('imagePostId').value = postId;
            document.getElementById('imageModal').classList.remove('hidden');
        }
        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Utility: close modal when clicking outside its content
        function enableOutsideClickClose(modalId) {
            const modal = document.getElementById(modalId);
            modal.addEventListener("click", function(e) {
                if (e.target === modal) { // only if clicking on background
                    modal.classList.add("hidden");
                }
            });
        }

        // Enable for all modals
        enableOutsideClickClose("addModal");
        enableOutsideClickClose("editModal");
        enableOutsideClickClose("imageModal");

    </script>

</body>
</html>
