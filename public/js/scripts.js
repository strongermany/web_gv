// filepath: web_gv/web_gv/public/js/scripts.js
document.addEventListener("DOMContentLoaded", function () {
  // Function to validate login form
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;
      if (username === "" || password === "") {
        event.preventDefault();
        alert("Please fill in both fields.");
      }
    });
  }

  // Function to handle document uploads
  const uploadForm = document.getElementById("uploadForm");
  if (uploadForm) {
    uploadForm.addEventListener("submit", function (event) {
      const fileInput = document.getElementById("fileInput");
      if (fileInput.files.length === 0) {
        event.preventDefault();
        alert("Please select a file to upload.");
      }
    });
  }

  // Function to handle grade entry
  const gradeForm = document.getElementById("gradeForm");
  if (gradeForm) {
    gradeForm.addEventListener("submit", function (event) {
      const gradeInputs = document.querySelectorAll(".gradeInput");
      let valid = true;
      gradeInputs.forEach((input) => {
        if (input.value === "" || isNaN(input.value)) {
          valid = false;
        }
      });
      if (!valid) {
        event.preventDefault();
        alert("Please enter valid grades for all students.");
      }
    });
  }

  // Function to handle attendance
  const attendanceForm = document.getElementById("attendanceForm");
  if (attendanceForm) {
    attendanceForm.addEventListener("submit", function (event) {
      const attendanceInputs = document.querySelectorAll(".attendanceInput");
      let valid = true;
      attendanceInputs.forEach((input) => {
        if (!input.checked) {
          valid = false;
        }
      });
      if (!valid) {
        event.preventDefault();
        alert("Please mark attendance for all students.");
      }
    });
  }
});

// Navigation menu
var navLinks = document.getElementById("navLinks");

function showMenu() {
  navLinks.style.right = "0";
}

function hideMenu() {
  navLinks.style.right = "-200px";
}

// Handle dropdown menu
function toggleDropdown(event) {
  event.stopPropagation();
  var dropdown = document.querySelector(".profile-dropdown");
  dropdown.classList.toggle("show");
}

// Close dropdown when clicking outside
document.addEventListener("click", function (event) {
  var dropdown = document.querySelector(".profile-dropdown");
  var avatar = document.querySelector(".admin-profile img");
  if (!dropdown.contains(event.target) && !avatar.contains(event.target)) {
    dropdown.classList.remove("show");
  }
});

// Class dropdown redirect
function redirectToClass(url) {
  if (url) {
    window.location.href = url;
  }
}

new Swiper(".card-wrapper", {
  loop: true,
  spaceBetween: 30,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
    waitForTransition: true
  },
  speed: 800,
  effect: 'slide',

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },

  // Navigation arrows
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});
