/**
 * Grow Guide Director - JavaScript
 * Handles smart app redirection and user experience
 */

(function ($) {
    'use strict';

    class GrowGuideDirector {
        constructor() {
            this.config = window.ggdConfig || {};
            this.isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent);
            this.isAndroid = /Android/.test(navigator.userAgent);
            this.isMobile = this.isIOS || this.isAndroid;

            this.init();
        }

        init() {
            this.bindEvents();
            this.handleSmartRedirects();
            this.setupAppDetection();
        }

        bindEvents() {
            // Handle app link clicks
            $(document).on('click', '[data-ggd-link]', (e) => {
                e.preventDefault();
                const $link = $(e.currentTarget);
                const path = $link.data('ggd-link');
                const fallback = $link.data('fallback') || 'store';

                this.attemptAppOpen(path, fallback);
            });

            // Handle store badge clicks
            $(document).on('click', '.ggd-store-badge', (e) => {
                this.trackInteraction('store_click', $(e.currentTarget).data('store'));
            });
        }

        handleSmartRedirects() {
            $('.ggd-smart-redirect').each((index, element) => {
                const $redirect = $(element);
                const path = $redirect.data('path');
                const delay = parseInt($redirect.data('delay')) || 1000;

                setTimeout(() => {
                    this.attemptAppOpen(path, 'store');
                }, delay);
            });
        }

        setupAppDetection() {
            // Detect if app is installed
            this.detectAppInstallation();

            // Handle page visibility changes (for app open detection)
            $(document).on('visibilitychange', () => {
                if (document.hidden) {
                    this.onAppMightHaveOpened();
                }
            });
        }

        attemptAppOpen(path, fallback = 'store') {
            const deepLink = this.config.config.app_scheme + path;

            this.trackInteraction('app_link_attempt', path);

            if (this.isMobile) {
                this.openAppMobile(deepLink, fallback);
            } else {
                this.openAppDesktop(deepLink, fallback);
            }
        }

        openAppMobile(deepLink, fallback) {
            const startTime = Date.now();
            let timeout;

            // Set up fallback
            timeout = setTimeout(() => {
                if (Date.now() - startTime < 2000) {
                    this.handleFallback(fallback);
                }
            }, 1500);

            // Handle page visibility changes
            const visibilityHandler = () => {
                if (document.hidden) {
                    clearTimeout(timeout);
                    this.trackInteraction('app_opened', deepLink);
                    document.removeEventListener('visibilitychange', visibilityHandler);
                }
            };

            document.addEventListener('visibilitychange', visibilityHandler);

            // Try to open the app
            if (this.isIOS) {
                window.location.href = deepLink;
            } else if (this.isAndroid) {
                // Try intent first, then fallback to custom scheme
                const intentLink = `intent://${deepLink.replace('growguide://', '')}#Intent;scheme=growguide;package=app.growguide;end`;
                window.location.href = intentLink;

                setTimeout(() => {
                    window.location.href = deepLink;
                }, 100);
            }
        }

        openAppDesktop(deepLink, fallback) {
            // For desktop, show a modal with QR code and store links
            this.showDesktopModal(deepLink);
        }

        showDesktopModal(deepLink) {
            const modalHtml = `
                <div class="ggd-modal-overlay">
                    <div class="ggd-modal">
                        <div class="ggd-modal-header">
                            <h3>Open in Grow Guide App</h3>
                            <button class="ggd-modal-close">&times;</button>
                        </div>
                        <div class="ggd-modal-body">
                            <div class="ggd-qr-section">
                                <div class="ggd-qr-code" data-link="${deepLink}">
                                    <div class="ggd-qr-placeholder">
                                        <i class="fas fa-qrcode"></i>
                                        <p>QR Code</p>
                                    </div>
                                </div>
                                <p>Scan with your phone to open in the app</p>
                            </div>
                            <div class="ggd-download-section">
                                <p>Don't have the app? Download it:</p>
                                <div class="ggd-store-buttons">
                                    <a href="${this.config.config.app_store_url}" class="ggd-store-badge" data-store="ios" target="_blank">
                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiB2aWV3Qm94PSIwIDAgMTIwIDQwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cmVjdCB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiByeD0iNSIgZmlsbD0iYmxhY2siLz4KPHRleHQgeD0iNjAiIHk9IjIwIiBmaWxsPSJ3aGl0ZSIgZm9udC1zaXplPSIxMiIgdGV4dC1hbmNob3I9Im1pZGRsZSI+QXBwIFN0b3JlPC90ZXh0Pgo8L3N2Zz4K" alt="Download on App Store">
                                    </a>
                                    <a href="${this.config.config.play_store_url}" class="ggd-store-badge" data-store="android" target="_blank">
                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiB2aWV3Qm94PSIwIDAgMTIwIDQwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cmVjdCB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiByeD0iNSIgZmlsbD0iYmxhY2siLz4KPHRleHQgeD0iNjAiIHk9IjIwIiBmaWxsPSJ3aGl0ZSIgZm9udC1zaXplPSIxMiIgdGV4dC1hbmNob3I9Im1pZGRsZSI+R29vZ2xlIFBsYXk8L3RleHQ+Cjwvc3ZnPgo=" alt="Get it on Google Play">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('body').append(modalHtml);
            this.generateQRCode(deepLink);

            // Close modal handlers
            $('.ggd-modal-close, .ggd-modal-overlay').on('click', (e) => {
                if (e.target === e.currentTarget) {
                    $('.ggd-modal-overlay').remove();
                }
            });
        }

        generateQRCode(text) {
            // Simple QR code generation - in production, use a proper QR library
            const qrAPI = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(text)}`;
            $('.ggd-qr-placeholder').html(`<img src="${qrAPI}" alt="QR Code" style="max-width: 150px; height: auto;">`);
        }

        handleFallback(fallback) {
            switch (fallback) {
                case 'store':
                    this.showStoreBadges();
                    break;
                case 'web':
                    // Redirect to web version
                    break;
                case 'modal':
                    this.showAppPromptModal();
                    break;
                default:
                    this.showStoreBadges();
            }
        }

        showStoreBadges() {
            if ($('.ggd-app-prompt').length) {
                $('.ggd-app-prompt').show();
                return;
            }

            const promptHtml = `
                <div class="ggd-app-prompt">
                    <div class="ggd-prompt-content">
                        <h4>Get the Grow Guide App</h4>
                        <p>For the best experience, download our mobile app:</p>
                        <div class="ggd-store-buttons">
                            <a href="${this.config.config.app_store_url}" class="ggd-store-badge" data-store="ios" target="_blank">
                                <img src="${this.getStoreBadgeImage('ios')}" alt="Download on App Store">
                            </a>
                            <a href="${this.config.config.play_store_url}" class="ggd-store-badge" data-store="android" target="_blank">
                                <img src="${this.getStoreBadgeImage('android')}" alt="Get it on Google Play">
                            </a>
                        </div>
                        <button class="ggd-prompt-close">&times;</button>
                    </div>
                </div>
            `;

            $('body').append(promptHtml);

            $('.ggd-prompt-close').on('click', () => {
                $('.ggd-app-prompt').fadeOut();
            });
        }

        showAppPromptModal() {
            const modalHtml = `
                <div class="ggd-modal-overlay">
                    <div class="ggd-modal ggd-app-prompt-modal">
                        <div class="ggd-modal-header">
                            <h3>Open in App</h3>
                            <button class="ggd-modal-close">&times;</button>
                        </div>
                        <div class="ggd-modal-body">
                            <p>This content is best viewed in the Grow Guide mobile app.</p>
                            <div class="ggd-store-buttons">
                                <a href="${this.config.config.app_store_url}" class="ggd-store-badge" data-store="ios" target="_blank">
                                    Download for iOS
                                </a>
                                <a href="${this.config.config.play_store_url}" class="ggd-store-badge" data-store="android" target="_blank">
                                    Download for Android
                                </a>
                            </div>
                            <button class="ggd-continue-web">Continue on Web</button>
                        </div>
                    </div>
                </div>
            `;

            $('body').append(modalHtml);

            $('.ggd-modal-close, .ggd-continue-web').on('click', () => {
                $('.ggd-modal-overlay').remove();
            });
        }

        getStoreBadgeImage(store) {
            // Return base64 encoded store badge images
            const badges = {
                ios: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiB2aWV3Qm94PSIwIDAgMTIwIDQwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cmVjdCB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiByeD0iNSIgZmlsbD0iYmxhY2siLz4KPHRleHQgeD0iNjAiIHk9IjIwIiBmaWxsPSJ3aGl0ZSIgZm9udC1zaXplPSIxMiIgdGV4dC1hbmNob3I9Im1pZGRsZSI+QXBwIFN0b3JlPC90ZXh0Pgo8L3N2Zz4K',
                android: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiB2aWV3Qm94PSIwIDAgMTIwIDQwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cmVjdCB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiByeD0iNSIgZmlsbD0iYmxhY2siLz4KPHRleHQgeD0iNjAiIHk9IjIwIiBmaWxsPSJ3aGl0ZSIgZm9udC1zaXplPSIxMiIgdGV4dC1hbmNob3I9Im1pZGRsZSI+R29vZ2xlIFBsYXk8L3RleHQ+Cjwvc3ZnPgo='
            };
            return badges[store] || badges.ios;
        }

        detectAppInstallation() {
            // Try to detect if the app is installed
            // This is limited due to browser security, but we can try
            if (this.isMobile) {
                const testLink = this.config.config.app_scheme + 'test';
                const iframe = document.createElement('iframe');
                iframe.style.display = 'none';
                iframe.src = testLink;
                document.body.appendChild(iframe);

                setTimeout(() => {
                    document.body.removeChild(iframe);
                }, 100);
            }
        }

        onAppMightHaveOpened() {
            // Called when the page becomes hidden (might indicate app opened)
            this.trackInteraction('app_potentially_opened', window.location.pathname);
        }

        trackInteraction(type, data) {
            if (!this.config.ajax_url) return;

            $.ajax({
                url: this.config.ajax_url,
                type: 'POST',
                data: {
                    action: 'ggd_track_interaction',
                    nonce: this.config.nonce,
                    type: type,
                    path: data || window.location.pathname
                }
            });
        }

        // Public methods for external use
        static showAppPrompt() {
            if (window.ggdInstance) {
                window.ggdInstance.showStoreBadges();
            }
        }

        static openApp(path) {
            if (window.ggdInstance) {
                window.ggdInstance.attemptAppOpen(path);
            }
        }
    }

    // Initialize when DOM is ready
    $(document).ready(() => {
        window.ggdInstance = new GrowGuideDirector();

        // Expose methods globally
        window.ggdShowAppPrompt = GrowGuideDirector.showAppPrompt;
        window.ggdOpenApp = GrowGuideDirector.openApp;
    });

})(jQuery);
