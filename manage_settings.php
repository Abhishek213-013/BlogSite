<?php
include 'admin_protect.php';
include 'db.php';

if (!isset($_SESSION['admin_token']) || time() > $_SESSION['admin_expiry']) {
    session_unset();
    session_destroy();
    header("Location: admin.php");
    exit();
}


// Fetch current settings
$stmt = $conn->prepare("SELECT * FROM settings WHERE id = 1");
$stmt->execute();
$result = $stmt->get_result();
$settings = $result->fetch_assoc();

// Update settings if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_title    = $_POST['site_title'];
    $site_subtitle = $_POST['site_subtitle'];
    $hot_topics    = $_POST['hot_topics'];

    $update = $conn->prepare("UPDATE settings SET site_title=?, site_subtitle=?, hot_topics=? WHERE id=1");
    $update->bind_param("sss", $site_title, $site_subtitle, $hot_topics);
    if ($update->execute()) {
        $settings['site_title']    = $site_title;
        $settings['site_subtitle'] = $site_subtitle;
        $settings['hot_topics']    = $hot_topics;
        $success = "Settings updated successfully!";
    } else {
        $error = "Failed to update settings.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Settings</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<header class="bg-red-600 text-white p-4 flex justify-between items-center shadow-md">
    <h1 class="text-2xl font-bold">Manage Global Settings</h1>
    <a href="dashboard.php" class="bg-white text-red-600 px-4 py-2 rounded hover:bg-gray-200 transition">Back</a>
</header>

<main class="p-6 max-w-3xl mx-auto">
    <?php if(isset($success)): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?= $success ?></div>
    <?php endif; ?>
    <?php if(isset($error)): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <div>
            <label class="block font-semibold mb-1">Site Title</label>
            <input type="text" name="site_title" value="<?= htmlspecialchars($settings['site_title']) ?>" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">Site Subtitle</label>
            <input type="text" name="site_subtitle" value="<?= htmlspecialchars($settings['site_subtitle']) ?>" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">Hot Topics (comma-separated)</label>
            <textarea name="hot_topics" class="w-full border px-3 py-2 rounded" rows="3"><?= htmlspecialchars($settings['hot_topics']) ?></textarea>
        </div>

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Save Settings</button>
    </form>
</main>

</body>
</html>
