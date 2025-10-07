<?php
// Detect current page filename
$current_page = basename($_SERVER['PHP_SELF']);

// Define all pages with labels
$pages = [
    "manage_home_posts.php"             => "Home Posts",
    "manage_business_posts.php"         => "Business Posts",
    "manage_lifestyle_simple_posts.php" => "Lifestyle - Simple Posts",
    "manage_lifestyle_health_posts.php" => "Lifestyle - Health Posts"
];
?>

<aside class="w-64 bg-white shadow-md p-4 h-screen sticky top-0">
    <h2 class="text-lg font-bold mb-4 text-red-600">Other Pages</h2>
    <ul class="space-y-2">
        <?php foreach ($pages as $file => $label): ?>
            <li>
                <a href="<?= $file ?>" 
                   class="block px-3 py-2 rounded 
                          <?= $current_page === $file ? 'bg-red-600 text-white' : 'hover:bg-red-100 hover:text-red-600' ?> 
                          transition">
                    <?= htmlspecialchars($label) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>
