<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Technology Blog - Standard Blog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /*  Marquee Animation */
    @keyframes marquee {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }
    .animate-marquee {
      display: inline-block;
      animation: marquee 15s linear infinite;
      white-space: nowrap;
    }
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
    
    /* Dropdown container */
    .dropdown {
      position: relative;
    }
    /* Create a gap between button and menu */
    .dropdown::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 100%;
      height: 8px;
      background: transparent;
    }
    /* Show menu on hover */
    .dropdown:hover .dropdown-menu {
      display: block;
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
          Simple strategies • To update your work life • The Best Tech-friendly place
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
      <!-- Title + Subtitle -->
      <div class="flex flex-col">
        <h1 class="text-2xl font-bold text-red-600">Standard Blog</h1>
        <h2 class="text-sm font-semibold text-gray-500">Fresh perspectives. Every day.</h2>
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

      <!-- Technology Posts -->
      <a href="post1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://demo.adorethemes.com/standard-blog/wp-content/uploads/sites/169/2024/09/pexels-ketut-subiyanto-4246234-min.jpg" alt="post" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">6 min read</span>
        <div class="p-4">
          <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">Technology</span>
          <h2 class="text-lg font-semibold mt-2">The Best Indoor Plants to Boost Your Mood and Purify the Air</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 12, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipiscing elit commodo nec, dictumst placerat nisi aptent morbi […] </p>
        </div>
      </a>

      <a href="post2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://demo.adorethemes.com/standard-blog/wp-content/uploads/sites/169/2024/09/pexels-anna-nekrashevich-8989415-min.jpg" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">How to Use Social Media to Grow Your Business Effectively</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 10, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipiscing elit cursus cubilia egestas, convallis aptent proin sed […] </p>
        </div>
      </a>

      <a href="post3.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://demo.adorethemes.com/standard-blog/wp-content/uploads/sites/169/2024/10/pexels-ron-lach-7849510-min.jpg" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">The Ultimate Checklist for Planning a Perfect Wedding on a Budget</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 8, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipiscing elit cursus cubilia egestas, convallis aptent proin sed […] </p>
        </div>
      </a>

      <a href="post4.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://demo.adorethemes.com/standard-blog/wp-content/uploads/sites/169/2024/09/pexels-shvetsa-3732658-min.jpg" alt="post" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold">10 Essential Tips for First-Time Home Buyers You Need to Know</h2>
          <p class="text-sm text-gray-500 mt-1">By Admin • September 5, 2025</p>
          <p class="text-gray-600 mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipiscing elit molestie, conubia urna arcu vel nostra rutrum […] </p>
        </div>
      </a>


  </section>

    <!-- Sidebar -->
    <aside class="bg-white p-6 rounded-lg shadow order-last lg:order-none">
      <h3 class="text-lg font-semibold mb-4">About Myself</h3>
      <div class="flex flex-col items-center text-center">
        <img src="image.jpg" alt="author" class="w-20 h-20 rounded-full mb-3">
        <h4 class="font-bold">Abhishek Chowdhury</h4>
        <p class="text-sm text-gray-500">Software Engineer</p>
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">

      <a href="story1.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://demo.adorethemes.com/standard-blog/wp-content/uploads/sites/169/2024/09/pexels-phreewil-535431-min.jpg" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">5 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">How to Create a Morning Routine That Sets You Success</h3>
        </div>
      </a>

      <a href="story2.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://demo.adorethemes.com/standard-blog/wp-content/uploads/sites/169/2024/09/house-cup-saucer-ceramic-religion-coffee-cup-859030-pxhere.com-min-1.jpg" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">6 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">The Best Eco-Friendly Products to Help You Live a Sustainable Lifestyle</h3>
        </div>
      </a>

      <a href="story3.php" class="relative bg-white rounded-lg shadow hover:shadow-lg hover:scale-105 transform transition duration-300 overflow-hidden block">
        <img src="https://demo.adorethemes.com/standard-blog/wp-content/uploads/sites/169/2024/09/nature-branch-blossom-bird-wing-leaf-675034-pxhere.com-min.jpg" alt="story" class="w-full h-48 object-cover">
        <span class="absolute top-2 left-2 bg-white text-gray-800 text-xs px-2 py-1 rounded shadow">7 min read</span>
        <div class="p-4">
          <h3 class="font-semibold">How to Save Money on Groceries Without Sacrificing Quality or Taste</h3>
        </div>
      </a>

    </div>
  </section>

  <!--  JS: Toggle Search + Dropdowns -->
  <script>
    const searchToggle = document.getElementById("searchToggle");
    const searchBox = document.getElementById("searchBox");
    const searchInput = document.getElementById("searchInput");
    const blogList = document.getElementById("blogList");

    searchToggle.addEventListener("click", () => {
      searchBox.classList.toggle("hidden");
      searchInput.focus();
    });

    document.getElementById("searchButton").addEventListener("click", () => {
      const term = searchInput.value.toLowerCase();
      const posts = blogList.getElementsByTagName("a");
      for (let post of posts) {
        const text = post.innerText.toLowerCase();
        post.style.display = text.includes(term) ? "block" : "none";
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
  </script>

</body>
</html>