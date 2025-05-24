/**
 * Main JavaScript for Grow Guide Website
 * This file handles all general UI functionality including:
 * - Navigation
 * - Mobile menu
 * - QR code generation
 * - Page-specific functionality
 */

document.addEventListener('DOMContentLoaded', function () {
  // ======================================================
  // Configuration
  // ======================================================
  const config = {
    appScheme: "growguide://",
    appStoreUrl: "https://apps.apple.com/us/app/grow-guide/id6637720578",
    playStoreUrl: "https://play.google.com/store/apps/details?id=app.growguide",
    webDomain: "https://growguide.app"
  };

  // Debug mode - set to true to see console logs
  const DEBUG = true;

  // ======================================================
  // Common UI Functions
  // ======================================================

  // Navigation scroll effect
  function initNavbarScroll() {
    window.addEventListener("scroll", function () {
      const navbar = document.querySelector(".navbar");
      if (navbar) {
        if (window.scrollY > 50) {
          navbar.classList.add("scrolled");
        } else {
          navbar.classList.remove("scrolled");
        }
      }
    });
  }

  // Mobile menu toggle
  function initMobileMenu() {
    const mobileMenuBtn = document.querySelector(".mobile-menu-btn");
    const mobileMenuClose = document.querySelector(".mobile-menu-close");
    const mobileMenu = document.querySelector(".mobile-menu");

    if (DEBUG) console.log('Mobile menu elements:', {
      mobileMenuBtn: !!mobileMenuBtn,
      mobileMenuClose: !!mobileMenuClose,
      mobileMenu: !!mobileMenu
    });

    if (mobileMenuBtn && mobileMenuClose && mobileMenu) {
      mobileMenuBtn.addEventListener("click", function () {
        if (DEBUG) console.log('Mobile menu button clicked');
        mobileMenu.classList.add("active");
      });

      mobileMenuClose.addEventListener("click", function () {
        if (DEBUG) console.log('Mobile menu close button clicked');
        mobileMenu.classList.remove("active");
      });

      // Close mobile menu when clicking on a link
      const mobileLinks = document.querySelectorAll(".mobile-menu .nav-links a");
      if (DEBUG) console.log('Found', mobileLinks.length, 'mobile menu links');

      mobileLinks.forEach((link) => {
        link.addEventListener("click", function () {
          if (DEBUG) console.log('Mobile menu link clicked');
          mobileMenu.classList.remove("active");
        });
      });
    } else {
      if (DEBUG) console.log('Mobile menu initialization failed: missing elements');
    }
  }

  // Set current year for copyright
  function setCurrentYear() {
    const yearElement = document.getElementById("current-year");
    if (yearElement) {
      yearElement.textContent = new Date().getFullYear();
    }
  }

  // Generate QR code for desktop users (homepage)
  function initHomeQRCode() {
    if (window.innerWidth >= 769) {
      const qrContainer = document.getElementById("qr-container");
      if (qrContainer && typeof QRCode !== 'undefined') {
        new QRCode(qrContainer, {
          text: "https://get.growguide.app/apps",
          width: 200,
          height: 200,
          colorDark: "#4caf50",
          colorLight: "#ffffff",
          correctLevel: QRCode.CorrectLevel.H,
        });
      }
    }
  }



  // ======================================================
  // Initialize all functions
  // ======================================================

  // Initialize common UI functions
  initNavbarScroll();
  initMobileMenu();
  setCurrentYear();

  // Initialize page-specific functions
  const currentPage = window.location.pathname;

  // Home page specific
  if (currentPage === '/' || currentPage === '/index.html') {
    initHomeQRCode();
  }


});
