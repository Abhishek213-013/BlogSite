// script.js

document.addEventListener("DOMContentLoaded", () => {
  // Search toggle
  const searchToggle = document.getElementById("searchToggle");
  const searchBox = document.getElementById("searchBox");
  const searchInput = document.getElementById("searchInput");

  if (searchToggle && searchBox && searchInput) {
    searchToggle.addEventListener("click", () => {
      searchBox.classList.toggle("hidden");
      searchInput.focus();
    });
  }

  // Blog search
  const searchButton = document.getElementById("searchButton");
  const blogList = document.getElementById("blogList");

  if (searchButton && blogList && searchInput) {
    searchButton.addEventListener("click", () => {
      const term = searchInput.value.toLowerCase();
      const posts = blogList.getElementsByTagName("a");
      for (let post of posts) {
        post.style.display = post.innerText.toLowerCase().includes(term) ? "block" : "none";
      }
    });
  }

  // Mobile dropdown functionality
  function setupMobileDropdowns() {
    const dropdowns = document.querySelectorAll(".dropdown");

    dropdowns.forEach((dropdown) => {
      const button = dropdown.querySelector("button");
      const menu = dropdown.querySelector(".dropdown-menu");

      if (!button || !menu) return;

      button.addEventListener("click", (e) => {
        if (window.innerWidth < 768) {
          e.preventDefault();
          e.stopPropagation();

          // Close all other dropdowns
          document.querySelectorAll(".dropdown-menu").forEach((otherMenu) => {
            if (otherMenu !== menu && otherMenu.style.display === "block") {
              otherMenu.style.display = "none";
            }
          });

          // Toggle current dropdown
          menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
      });
    });

    // Close dropdowns when clicking outside
    document.addEventListener("click", (e) => {
      if (window.innerWidth < 768 && !e.target.closest(".dropdown")) {
        document.querySelectorAll(".dropdown-menu").forEach((menu) => {
          menu.style.display = "none";
        });
      }
    });
  }

  // Initialize dropdowns
  setupMobileDropdowns();

  // Reset on resize
  window.addEventListener("resize", () => {
    if (window.innerWidth >= 768) {
      document.querySelectorAll(".dropdown-menu").forEach((menu) => {
        menu.style.display = "";
      });
    }
  });
});
