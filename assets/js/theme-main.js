/**
 * Grow Guide Theme - Main JavaScript
 * Consolidated script for all theme functionality
 */

document.addEventListener('DOMContentLoaded', function () {
    // Debug mode
    const DEBUG = true;

    // Configuration
    const config = {
        appScheme: "growguide://",
        appStoreUrl: "https://apps.apple.com/us/app/grow-guide/id6637720578",
        playStoreUrl: "https://play.google.com/store/apps/details?id=app.growguide",
        webDomain: "https://growguide.app"
    };

    // Device detection
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    const isAndroid = /android/i.test(navigator.userAgent);
    const isMobile = isIOS || isAndroid;

    if (DEBUG) {
        console.log('Grow Guide Theme JS loaded');
        console.log('Device info:', { isIOS, isAndroid, isMobile });
    }

    // ======================================================
    // Navigation and UI Functions
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

        if (DEBUG) {
            console.log('Mobile menu elements:', {
                mobileMenuBtn: !!mobileMenuBtn,
                mobileMenuClose: !!mobileMenuClose,
                mobileMenu: !!mobileMenu
            });
        }

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

    // Generate QR code for desktop users
    function initQRCode() {
        if (window.innerWidth >= 769) {
            const qrContainer = document.getElementById("qr-container");
            if (qrContainer && typeof QRCode !== 'undefined') {
                try {
                    new QRCode(qrContainer, {
                        text: "https://get.growguide.app/apps",
                        width: 200,
                        height: 200,
                        colorDark: "#4caf50",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H,
                    });
                    if (DEBUG) console.log('QR code generated successfully');
                } catch (error) {
                    if (DEBUG) console.error('QR code generation failed:', error);
                }
            }
        }
    }

    // ======================================================
    // App Link and Deep Link Functions
    // ======================================================

    // Handle app link clicks
    function initAppLinks() {
        const appLinks = document.querySelectorAll('.btn-app, .app-link');

        appLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                const deepLink = this.getAttribute('data-deep-link') || 'home';
                const appUrl = `${config.appScheme}${deepLink}`;

                if (DEBUG) console.log('App link clicked:', { deepLink, appUrl });

                if (isMobile) {
                    // Try to open the app
                    window.location.href = appUrl;

                    // Fallback to app store after a short delay
                    setTimeout(() => {
                        if (isIOS) {
                            window.location.href = config.appStoreUrl;
                        } else if (isAndroid) {
                            window.location.href = config.playStoreUrl;
                        }
                    }, 1000);
                } else {
                    // Desktop: show QR code or redirect to app store
                    window.open(isIOS ? config.appStoreUrl : config.playStoreUrl, '_blank');
                }
            });
        });

        if (DEBUG && appLinks.length > 0) {
            console.log(`Initialized ${appLinks.length} app links`);
        }
    }

    // ======================================================
    // Form Handling
    // ======================================================

    // Contact form handling (if exists)
    function initContactForm() {
        const contactForm = document.getElementById('contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Basic form validation
                const name = this.querySelector('[name="name"]')?.value;
                const email = this.querySelector('[name="email"]')?.value;
                const message = this.querySelector('[name="message"]')?.value;

                if (!name || !email || !message) {
                    alert('Please fill in all required fields.');
                    return;
                }

                if (DEBUG) console.log('Contact form submitted:', { name, email, message });

                // Here you would typically send the form data to your backend
                alert('Thank you for your message! We\'ll get back to you soon.');
                this.reset();
            });
        }
    }

    // ======================================================
    // Smooth Scrolling
    // ======================================================

    function initSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href === '#') return;

                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // ======================================================
    // Animation on Scroll (Basic)
    // ======================================================

    function initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe elements with animation classes
        const animatedElements = document.querySelectorAll('.fade-in, .slide-up, .card, .feature-card');
        animatedElements.forEach(el => observer.observe(el));
    }

    // ======================================================
    // Utilities
    // ======================================================

    // Copy to clipboard function
    function copyToClipboard(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                if (DEBUG) console.log('Copied to clipboard:', text);
            });
        } else {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
        }
    }

    // ======================================================
    // Initialize All Functions
    // ======================================================

    try {
        // Core UI functions
        initNavbarScroll();
        initMobileMenu();
        setCurrentYear();

        // App-specific functions
        initAppLinks();
        initQRCode();

        // Form handling
        initContactForm();

        // Enhancement functions
        initSmoothScrolling();
        initScrollAnimations();

        if (DEBUG) console.log('All theme JavaScript functions initialized successfully');

    } catch (error) {
        console.error('Error initializing theme JavaScript:', error);
    }
});

// Add some basic CSS animations via JavaScript for browsers that support it
if (typeof document !== 'undefined') {
    const style = document.createElement('style');
    style.textContent = `
        .fade-in, .slide-up, .card, .feature-card {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }
        
        .fade-in.animate-in, .slide-up.animate-in, .card.animate-in, .feature-card.animate-in {
            opacity: 1;
            transform: translateY(0);
        }
        
        .navbar {
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            background-color: rgba(18, 18, 18, 0.95);
            backdrop-filter: blur(10px);
        }
    `;
    document.head.appendChild(style);
}
