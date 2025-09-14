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
  <style>
    /* Marquee Animation */
    @keyframes marquee {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }
    .animate-marquee {
      display: inline-block;
      animation: marquee 15s linear infinite;
      white-space: nowrap;
    }
    /* Pause on hover */
    .marquee-wrapper:hover .animate-marquee {
      animation-play-state: paused;
    }
    
    /* Dropdown menu styles */
    .dropdown-menu {
      display: none;
      position: absolute;
      left: 0;
      top: 100%;
      margin-top: 0.25rem;
      background-color: white;
      border: 1px solid #e5e7eb;
      border-radius: 0.5rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      width: 10rem;
      z-index: 50;
    }
    .dropdown-menu li a {
      display: block;
      padding: 0.5rem 1rem;
    }
    .dropdown-menu li a:hover {
      background-color: #f3f4f6;
    }
    .dropdown:hover .dropdown-menu {
      display: block;
    }
    
    /* Gap between dropdown button and menu */
    .dropdown {
      position: relative;
    }
    .dropdown::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 100%;
      height: 8px;
      background: transparent;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

  <!--  Top Bar -->
  <div class="bg-black text-white text-xs py-2 px-4 flex flex-col md:flex-row justify-between items-center gap-2">
    <div class="flex items-center w-full md:w-auto">
      <span class="bg-red-600 text-white-500 px-2 py-1 rounded text-[10px] font-bold shrink-0">HOT TOPICS</span>
      <div class="overflow-hidden w-full ml-2 marquee-wrapper">
        <p class="animate-marquee">
          <?= htmlspecialchars($settings['hot_topics']) ?>
        </p>
      </div>
    </div>
    <div id="currentDate" class="text-center md:text-right"></div>

      <script>
        function updateDate() {
          const now = new Date();
          const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
          document.getElementById('currentDate').innerText = now.toLocaleDateString('en-US', options);
        }
        updateDate(); // Run once immediately
        setInterval(updateDate, 60 * 1000); // Update every minute
      </script>


  </div>

  <!--  Header / Navbar -->
  <header class="border-b bg-white">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-4 py-4">
      <!-- Logo -->
      <div class="flex flex-col">
        <h1 class="text-2xl font-bold text-red-600"><?= htmlspecialchars($settings['site_title']) ?></h1>
        <h2 class="text-xl font-semibold text-gray-500"><?= htmlspecialchars($settings['site_subtitle']) ?></h2>
      </div>

      <!-- Navbar links + search -->
      <div class="flex items-center gap-4">
        <nav>
          <ul class="flex gap-6 text-gray-700 font-medium relative">
            <li><a href="index.php" class="hover:text-red-600">Home</a></li>
            <li><a href="business.php" class="hover:text-red-600">Business</a></li>

            <!-- Lifestyle Dropdown -->
            <li class="dropdown">
              <button class="hover:text-red-600 flex items-center gap-1">
                Lifestyle
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a href="lifestyle-simple.php" class="hover:bg-gray-100">Simple</a></li>
                <li><a href="lifestyle-health.php" class="hover:bg-gray-100">Health</a></li>
                <li><a href="lifestyle-working.php" class="hover:bg-gray-100">Working</a></li>
              </ul>
            </li>

            <li><a href="technology.php" class="hover:text-red-600">Technology</a></li>

            <!-- Travel Dropdown -->
            <li class="dropdown">
              <button class="hover:text-red-600 flex items-center gap-1">
                Travel
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a href="travel-destinations.php" class="hover:bg-gray-100">Destinations</a></li>
                <li><a href="travel-outdoor.php" class="hover:bg-gray-100">Outdoor</a></li>
              </ul>
            </li>

            <li><a href="finance.php" class="hover:text-red-600">Finance</a></li>
          </ul>
        </nav>

        <!--  Search Icon -->
        <button id="searchToggle" class="text-gray-700 hover:text-red-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
          </svg>
        </button>
      </div>
    </div>

    <!--  Hidden Search Box -->
    <div id="searchBox" class="hidden border-t bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 py-3 flex">
        <input type="text" id="searchInput" placeholder="Search blogs..."
          class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
        <button id="searchButton" class="ml-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Search</button>
      </div>
    </div>
  </header>

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

    <!-- Sidebar -->
    <aside class="bg-white p-6 rounded-lg shadow order-last lg:order-none">
      <h3 class="text-lg font-semibold mb-4">About Myself</h3>
      <div class="flex flex-col items-center text-center">
        <img src="image.jpg" alt="author" class="w-20 h-20 rounded-full mb-3">
        <h4 class="font-bold">Abhishek Chowdhury</h4>
        <p class="text-sm text-gray-500">Software Engineer.</p>
        <p class="text-gray-600 text-sm mt-2">
          Abhishek Chowdhury is a Bangladeshi Software Engineer, blogger, businessman, and ...
        </p>
        <div class="flex gap-3 mt-3">
          <a href="https://x.com/Abhishe96895508" class="text-blue-500 hover:underline text-sm">Twitter</a>
          <a href="https://www.instagram.com/abhishekchowdhury_30/" class="text-pink-500 hover:underline text-sm">Instagram</a>
          <a href="https://abhishek213-013.github.io/WebDevPortfolio/" class="text-gray-700 hover:underline text-sm">Website</a>
        </div>
      </div>
    </aside>
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
  <!-- Footer -->
  <footer class="bg-gray-100 border-t mt-12 py-10">
    <div class="max-w-7xl mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Recent Posts Section -->
        <div>
          <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
          <ul class="space-y-3">
            <li><a href="#" class="text-gray-600 hover:text-red-600">Simple Ways to Reduce Your Carbon Footprint and Help the Environment</a></li>
            <li><a href="#" class="text-gray-600 hover:text-red-600">How to Choose the Right Fitness Routine for Your Body Type and Goals</a></li>
            <li><a href="#" class="text-gray-600 hover:text-red-600">10 Practical Tips for Balancing Work, Family, and Personal Time Effectively</a></li>
            <li><a href="#" class="text-gray-600 hover:text-red-600">The Best Indoor Plants to Boost Your Mood and Purify the Air</a></li>
            <li><a href="#" class="text-gray-600 hover:text-red-600">How to Achieve Financial Independence and Live the Life You Want</a></li>
            <li><a href="#" class="text-gray-600 hover:text-red-600">How to Make Your Home Feel Cozy Without Spending a Fortune</a></li>
          </ul>
        </div>
        
        <!-- Featured Posts Section -->
        <div>
          <h3 class="text-lg font-semibold mb-4">Featured Posts</h3>
          <ul class="space-y-3">
            <li><a href="#" class="text-gray-600 hover:text-red-600">10 Fun Outdoor Activities to Enjoy With Your Kids</a></li>
            <li><a href="#" class="text-gray-600 hover:text-red-600">How to Create a Morning Routine That Sets You Success</a></li>
            <li><a href="#" class="text-gray-600 hover:text-red-600">10 Essential Tips for First-Time Home Buyers You Need to Know</a></li>
            <li><a href="#" class="text-gray-600 hover:text-red-600">The Importance of Self-Care and How to Incorporate It Into Your Routine</a></li>
          </ul>
        </div>
        
        <!-- Follow Us Section with Logos -->
        <div>
          <h3 class="text-lg font-semibold mb-4">Follow Us On:</h3>
          <div class="flex flex-wrap gap-3">
            <a href="#" class="social-icon twitter" title="Twitter">
              <i class="fab fa-twitter fa-lg"></i>
            </a>
            <a href="#" class="social-icon facebook" title="Facebook">
              <i class="fab fa-facebook-f fa-lg"></i>
            </a>
            <a href="#" class="social-icon instagram" title="Instagram">
              <i class="fab fa-instagram fa-lg"></i>
            </a>
            <a href="#" class="social-icon pinterest" title="Pinterest">
              <i class="fab fa-pinterest-p fa-lg"></i>
            </a>
            <a href="#" class="social-icon youtube" title="YouTube">
              <i class="fab fa-youtube fa-lg"></i>
            </a>
            <a href="#" class="social-icon linkedin" title="LinkedIn">
              <i class="fab fa-linkedin-in fa-lg"></i>
            </a>
          </div>
          
          <div class="mt-6">
            <h4 class="font-semibold mb-2">Subscribe to Our Newsletter</h4>
            <div class="flex">
              <input type="email" placeholder="Your email address" class="px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-red-500 w-full">
              <button class="bg-red-600 text-white px-4 py-2 rounded-r-lg hover:bg-red-700">Subscribe</button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Copyright Section -->
      <div class="border-t mt-8 pt-6 text-center text-gray-500 text-sm">
        <p>Copyright © 2025 Standard Blog Theme: Standard Blog By Adore Themes.</p>
      </div>
    </div>
  </footer>
  <!--  JS -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      // Search toggle
      const searchToggle = document.getElementById("searchToggle");
      const searchBox = document.getElementById("searchBox");
      const searchInput = document.getElementById("searchInput");
      searchToggle.addEventListener("click", () => {
        searchBox.classList.toggle("hidden");
        searchInput.focus();
      });

      // Blog search
      const searchButton = document.getElementById("searchButton");
      const blogList = document.getElementById("blogList");
      searchButton.addEventListener("click", () => {
        const term = searchInput.value.toLowerCase();
        const posts = blogList.getElementsByTagName("a");
        for (let post of posts) {
          post.style.display = post.innerText.toLowerCase().includes(term) ? "block" : "none";
        }
      });

      // Mobile dropdown functionality
      function setupMobileDropdowns() {
        const dropdowns = document.querySelectorAll('.dropdown');
        
        dropdowns.forEach(dropdown => {
          const button = dropdown.querySelector('button');
          const menu = dropdown.querySelector('.dropdown-menu');
          
          // Toggle dropdown on mobile
          button.addEventListener('click', (e) => {
            if (window.innerWidth < 768) {
              e.preventDefault();
              e.stopPropagation();
              
              // Close all other dropdowns
              document.querySelectorAll('.dropdown-menu').forEach(otherMenu => {
                if (otherMenu !== menu && otherMenu.style.display === 'block') {
                  otherMenu.style.display = 'none';
                }
              });
              
              // Toggle current dropdown
              if (menu.style.display === 'block') {
                menu.style.display = 'none';
              } else {
                menu.style.display = 'block';
              }
            }
          });
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
          if (window.innerWidth < 768) {
            if (!e.target.closest('.dropdown')) {
              document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
              });
            }
          }
        });
      }
      
      // Initialize mobile dropdowns
      setupMobileDropdowns();
      
      // Handle window resize
      window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
          // Reset mobile styles on desktop
          document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.style.display = '';
          });
        }
      });
    });
  </script>

</body>
</html>