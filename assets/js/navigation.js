/**
 * Navigation JavaScript for Mobile Menu
 */

document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenuWrapper = document.querySelector('.nav-menu-wrapper');
    const navMenu = document.querySelector('.nav-menu');

    if (mobileMenuToggle && navMenuWrapper) {
        // Toggle mobile menu
        mobileMenuToggle.addEventListener('click', function () {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            this.setAttribute('aria-expanded', !isExpanded);
            navMenuWrapper.classList.toggle('active');
            document.body.classList.toggle('mobile-menu-open');

            // Animate hamburger
            this.classList.toggle('active');

            // Announce to screen readers
            if (!isExpanded) {
                this.setAttribute('aria-label', 'Close navigation menu');
            } else {
                this.setAttribute('aria-label', 'Open navigation menu');
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.main-navigation') && navMenuWrapper.classList.contains('active')) {
                closeMenu();
            }
        });

        // Close menu when pressing Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && navMenuWrapper.classList.contains('active')) {
                closeMenu();
                mobileMenuToggle.focus();
            }
        });

        // Helper function to close menu
        function closeMenu() {
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            mobileMenuToggle.setAttribute('aria-label', 'Open navigation menu');
            navMenuWrapper.classList.remove('active');
            document.body.classList.remove('mobile-menu-open');
            mobileMenuToggle.classList.remove('active');
        }

        // Handle submenu toggles on mobile
        const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');

        menuItemsWithChildren.forEach(function (menuItem) {
            const submenuToggle = document.createElement('button');
            submenuToggle.className = 'submenu-toggle';
            submenuToggle.innerHTML = '<span class="screen-reader-text">Toggle submenu</span><svg width="12" height="12" viewBox="0 0 12 12"><path d="M6 9L1.5 4.5h9L6 9z" fill="currentColor"/></svg>';
            submenuToggle.setAttribute('aria-expanded', 'false');

            const link = menuItem.querySelector('a');
            if (link) {
                link.parentNode.insertBefore(submenuToggle, link.nextSibling);
            }

            submenuToggle.addEventListener('click', function () {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                const submenu = menuItem.querySelector('.sub-menu');

                this.setAttribute('aria-expanded', !isExpanded);
                if (submenu) {
                    submenu.classList.toggle('active');
                }
                this.classList.toggle('active');
            });
        });

        // Close mobile menu when clicking on navigation links
        const navLinks = navMenuWrapper.querySelectorAll('a');
        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                // Only close on mobile devices
                if (window.innerWidth <= 768) {
                    setTimeout(closeMenu, 100); // Small delay for smooth transition
                }
            });
        });
    }

    // Add smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href.length > 1) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const headerHeight = document.querySelector('.site-header').offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    if (navMenuWrapper && navMenuWrapper.classList.contains('active')) {
                        closeMenu();
                    }
                }
            }
        });
    });

    // Header scroll effect
    let lastScrollTop = 0;
    const header = document.querySelector('.site-header');

    window.addEventListener('scroll', function () {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop && scrollTop > 100) {
            // Scrolling down
            header.classList.add('header-hidden');
        } else {
            // Scrolling up
            header.classList.remove('header-hidden');
        }

        // Add/remove scrolled class
        if (scrollTop > 50) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }

        lastScrollTop = scrollTop;
    });

    // Initialize mobile menu toggle aria-label
    if (mobileMenuToggle) {
        mobileMenuToggle.setAttribute('aria-label', 'Open navigation menu');
    }
});
