/**
 * Smart Deep Linking System for Grow Guide
 *
 * This script provides intelligent deep linking that:
 * 1. Detects the current path and query parameters
 * 2. Tries to open the app directly
 * 3. Stores deep link data for deferred retrieval
 * 4. Tracks attribution data
 * 5. Shows app store badges if needed
 */

// Configuration
const DeepLinkConfig = {
  appScheme: "growguide://",
  webDomain: "https://growguide.app",
  appStoreUrl: "https://apps.apple.com/us/app/grow-guide/id6637720578",
  playStoreUrl: "https://play.google.com/store/apps/details?id=app.growguide",

  // Default paths for different sections
  defaultPaths: {
    home: "home",
    tools: "tools",
    mygrows: "mygrows",
    questions: "questions",
    user: "user"
  },

  // Storage keys
  storageKeys: {
    deepLink: "deferredDeepLink",
    timestamp: "deferredDeepLinkTimestamp",
    attribution: "attributionData"
  }
};

// Smart Deep Link Handler
class SmartDeepLink {
  constructor(options = {}) {
    this.config = { ...DeepLinkConfig, ...options };
    this.urlParams = new URLSearchParams(window.location.search);
    this.path = this._getPathFromUrl();
    this.isFirstVisit = !this._hasVisitedBefore();

    // Device detection
    this.isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    this.isAndroid = /android/i.test(navigator.userAgent);
    this.isMobile = this.isIOS || this.isAndroid;

    // Debug mode
    this.debug = this.urlParams.has('debug') || false;

    // Initialize attribution data
    this.attributionData = this._getAttributionData();
  }

  /**
   * Initialize the deep linking system
   */
  init() {
    // Log initialization
    if (this.debug) {
      console.log(`SmartDeepLink initialized with path: ${this.path}`);
    }

    // Store attribution data
    this._storeAttributionData();

    // Store deep link for deferred retrieval
    if (this.path) {
      this._storeDeferredDeepLink();

      // Check if this is a direct app path
      const appPaths = ['user/', 'post/', 'grow/', 'tools/', 'mygrows/', 'questions/', 'admin/'];
      const isDirectAppPath = appPaths.some(appPath => this.path.startsWith(appPath));

      // If this is a direct app path, show an app open button instead of auto-redirecting
      if (isDirectAppPath) {
        console.log(`Direct app path detected: ${this.path}, showing open app button`);
        this._showAppOpenButton();
      }
    }

    // Return the handler for chaining
    return this;
  }

  /**
   * Show a floating button to open the app (requires user interaction)
   * @private
   */
  _showAppOpenButton() {
    // Create button element if it doesn't exist
    if (!document.getElementById('open-app-button')) {
      const button = document.createElement('button');
      button.id = 'open-app-button';
      button.innerText = 'Open in App';
      button.style.position = 'fixed';
      button.style.bottom = '20px';
      button.style.left = '50%';
      button.style.transform = 'translateX(-50%)';
      button.style.backgroundColor = '#4ade80';
      button.style.color = '#121212';
      button.style.border = 'none';
      button.style.borderRadius = '8px';
      button.style.padding = '12px 24px';
      button.style.fontWeight = 'bold';
      button.style.fontSize = '16px';
      button.style.zIndex = '9999';
      button.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.2)';

      // Add click event listener
      button.addEventListener('click', () => {
        this.openApp();
      });

      // Add to document
      document.body.appendChild(button);
    }
  }

  /**
   * Try to open the app
   */
  openApp() {
    if (!this.isMobile) {
      console.log("Not on mobile, skipping app open attempt");
      return false;
    }

    const appUrl = this._getAppUrl();
    console.log(`Attempting to open app with URL: ${appUrl}`);

    // Try to open the app
    window.location.href = appUrl;

    // Set a timeout to check if the app opened
    setTimeout(() => {
      if (document.visibilityState === "visible") {
        console.log("App may not be installed - still visible after redirect attempt");
        // Could show app store badges here
      }
    }, 2000);

    // Return true to indicate attempt was made
    return true;
  }

  /**
   * Show app store badges if the app isn't installed
   * @param {Object} elements - DOM elements to update
   */
  showAppStoreBadges(elements = {}) {
    const { container, appStore, playStore } = elements;

    if (!container) {

      return;
    }

    // Show the appropriate badge
    if (this.isIOS && appStore) {
      appStore.style.display = "block";
      if (playStore) playStore.style.display = "none";
    } else if (this.isAndroid && playStore) {
      playStore.style.display = "block";
      if (appStore) appStore.style.display = "none";
    } else {
      // Show both on desktop
      if (appStore) appStore.style.display = "block";
      if (playStore) playStore.style.display = "block";
    }

    // Show the container
    container.style.display = "block";
  }

  /**
   * Function to check for deferred deep links (called from the app's WebView)
   */
  checkForDeferredDeepLink() {
    try {
      const deferredLink = localStorage.getItem(this.config.storageKeys.deepLink);
      const timestamp = localStorage.getItem(this.config.storageKeys.timestamp);

      // Check if the link exists
      if (!deferredLink) {

        return null;
      }

      // Check if the link is too old (more than 30 days)
      if (timestamp) {
        const linkAge = Date.now() - parseInt(timestamp);
        const thirtyDaysInMs = 30 * 24 * 60 * 60 * 1000;

        if (linkAge > thirtyDaysInMs) {

          this._clearDeferredDeepLink();
          return null;
        }
      }

      // Convert web URL to app URL
      let appUrl;
      if (deferredLink === "/" || deferredLink === "") {
        // For first-time app opens without a specific path, return the home path
        appUrl = this.config.appScheme + this.config.defaultPaths.home;
      } else {
        // Remove the leading slash and construct the app URL
        appUrl = this.config.appScheme + deferredLink.substring(1);
      }



      // Clear the stored link to prevent future redirects
      this._clearDeferredDeepLink();

      return appUrl;
    } catch (e) {
      console.error("Error checking for deferred deep link:", e);
      return null;
    }
  }

  /**
   * Function to retrieve attribution data (called from the app's WebView)
   */
  getAttributionData() {
    try {
      const attributionData = JSON.parse(localStorage.getItem(this.config.storageKeys.attribution) || "{}");

      // Clear the attribution data after retrieving
      localStorage.removeItem(this.config.storageKeys.attribution);

      return attributionData;
    } catch (e) {
      console.error("Error retrieving attribution data:", e);
      return null;
    }
  }

  /**
   * Get the path from the current URL
   * @private
   */
  _getPathFromUrl() {
    // First check query parameter
    const pathParam = this.urlParams.get("path");
    if (pathParam) {
      return pathParam;
    }

    // Then check URL path
    const pathname = window.location.pathname;
    if (pathname && pathname !== "/" && pathname !== "/index.html") {
      // Check for app-specific paths
      const appPaths = ['user/', 'post/', 'grow/', 'tools/', 'mygrows/', 'questions/', 'admin/'];

      // Remove leading slash and .html extension if present
      const cleanPath = pathname.replace(/^\//, "").replace(/\.html$/, "");

      // Check if this is a direct app path (e.g., /user/username)
      for (const appPath of appPaths) {
        if (cleanPath.startsWith(appPath)) {
          return cleanPath;
        }
      }

      // For other paths, just return the cleaned path
      return cleanPath;
    }

    // Default to home
    return "";
  }

  /**
   * Check if the user has visited before
   * @private
   */
  _hasVisitedBefore() {
    return localStorage.getItem("hasVisitedBefore") === "true";
  }

  /**
   * Mark that the user has visited
   * @private
   */
  _markAsVisited() {
    localStorage.setItem("hasVisitedBefore", "true");
  }

  /**
   * Get the app URL based on the current path
   * @private
   */
  _getAppUrl() {
    if (!this.path) {
      return this.config.appScheme + this.config.defaultPaths.home;
    }
    return this.config.appScheme + this.path;
  }

  /**
   * Store the deep link for deferred retrieval
   * @private
   */
  _storeDeferredDeepLink() {
    try {
      localStorage.setItem(this.config.storageKeys.deepLink, "/" + this.path);
      localStorage.setItem(this.config.storageKeys.timestamp, Date.now().toString());

    } catch (e) {
      console.error("Error storing deferred deep link:", e);
    }
  }

  /**
   * Clear the stored deep link
   * @private
   */
  _clearDeferredDeepLink() {
    localStorage.removeItem(this.config.storageKeys.deepLink);
    localStorage.removeItem(this.config.storageKeys.timestamp);
  }

  /**
   * Get attribution data from URL parameters
   * @private
   */
  _getAttributionData() {
    const data = {
      utm_source: this.urlParams.get("utm_source") || document.referrer || "direct",
      utm_medium: this.urlParams.get("utm_medium") || "",
      utm_campaign: this.urlParams.get("utm_campaign") || "",
      utm_content: this.urlParams.get("utm_content") || "",
      utm_term: this.urlParams.get("utm_term") || "",
      fbclid: this.urlParams.get("fbclid") || "",
      gclid: this.urlParams.get("gclid") || "",
      ttclid: this.urlParams.get("ttclid") || "",
      landing_page: "/" + this.path,
      timestamp: Date.now().toString(),
      userAgent: navigator.userAgent,
      screenSize: `${window.innerWidth}x${window.innerHeight}`
    };

    return data;
  }

  /**
   * Store attribution data
   * @private
   */
  _storeAttributionData() {
    try {
      // Only store if we have UTM parameters or click IDs
      const hasUtmParams = Object.keys(this.attributionData).some(key =>
        key.startsWith("utm_") && this.attributionData[key]
      );

      const hasClickId = this.attributionData.fbclid ||
        this.attributionData.gclid ||
        this.attributionData.ttclid;

      if (hasUtmParams || hasClickId) {
        localStorage.setItem(
          this.config.storageKeys.attribution,
          JSON.stringify(this.attributionData)
        );

      }
    } catch (e) {
      console.error("Error storing attribution data:", e);
    }
  }

  /**
   * Log debug information
   * @private
   */
  _log(message) {
    if (this.debug) {
      console.log(`[SmartDeepLink] ${message}`);
    }
  }
}

// Make the class available globally
window.SmartDeepLink = SmartDeepLink;

// Auto-initialize if the script is loaded with data-auto-init attribute
document.addEventListener("DOMContentLoaded", function () {
  const script = document.querySelector('script[data-auto-init="true"]');
  if (script) {
    window.deepLinkHandler = new SmartDeepLink().init();
  }
});
