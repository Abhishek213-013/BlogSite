<?php
include 'db.php';
$settingsResult = $conn->query("SELECT * FROM settings WHERE id = 1");
$settings = $settingsResult->fetch_assoc();
?>

<!--  Top Bar -->
<div class="bg-black text-white text-xs py-2 px-4 flex flex-col md:flex-row justify-between items-center gap-2">
  <div class="flex items-center w-full md:w-auto">
    <span class="bg-red-600 text-white-500 px-2 py-1 rounded text-[10px] font-bold shrink-0">HOT TOPICS</span>
    <div class="overflow-hidden w-full ml-2 marquee-wrapper">
      <p class="animate-marquee"><?= htmlspecialchars($settings['hot_topics']) ?></p>
    </div>
  </div>
  <div id="currentDate" class="text-center md:text-right"></div>
</div>

<!--  Navbar -->
<header class="border-b bg-white">
  <div class="max-w-7xl mx-auto flex justify-between items-center px-3 py-3">
    <div class="flex flex-col">
      <h1 class="text-2xl font-bold text-red-600"><?= htmlspecialchars($settings['site_title']) ?></h1>
      <h2 class="text-xl font-semibold text-gray-500"><?= htmlspecialchars($settings['site_subtitle']) ?></h2>
    </div>

    <div class="flex items-center gap-4">
      <nav>
        <ul class="flex gap-6 text-gray-700 font-medium relative items-center">
          <li><a href="index.php" class="hover:text-red-600">Home</a></li>
          <li><a href="business.php" class="hover:text-red-600">Business</a></li>
          <li class="dropdown">
            <button class="hover:text-red-600 flex items-center gap-1">Lifestyle ▼</button>
            <ul class="dropdown-menu">
              <li><a href="lifestyle-simple.php">Simple</a></li>
              <li><a href="lifestyle-health.php">Health</a></li>
              <li><a href="lifestyle-working.php">Working</a></li>
            </ul>
          </li>
          <li><a href="technology.php" class="hover:text-red-600">Technology</a></li>
          <li class="dropdown">
            <button class="hover:text-red-600 flex items-center gap-1">Travel ▼</button>
            <ul class="dropdown-menu">
              <li><a href="travel-destinations.php">Destinations</a></li>
              <li><a href="travel-outdoor.php">Outdoor</a></li>
            </ul>
          </li>
          <li><a href="finance.php" class="hover:text-red-600">Finance</a></li>
          
          <!-- Search Icon inside Navbar -->
          <li>
            <button id="searchToggle" class="px-2 py-1 bg-white text-red-600 rounded hover:bg-gray-200 transition">
              🔍
            </button>
          </li>
        </ul>
      </nav>

      
    </div>
  </div>
</header>

<!-- Hidden Search Box (JS toggles this) -->
<div id="searchBox" class="hidden bg-gray-100 p-4">
  <div class="flex space-x-2 max-w-lg mx-auto">
    <input id="searchInput" type="text" placeholder="Search blogs..."
      class="flex-grow border p-2 rounded">
    <button id="searchButton"
      class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
      Go
    </button>
  </div>
</div>
