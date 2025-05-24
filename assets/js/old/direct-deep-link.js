/**
 * Direct Deep Link Handler
 *
 * A simplified, direct approach to handling deep links on the main domain.
 * This script is designed to be included directly in the head of the HTML
 * to ensure it runs before any other scripts.
 */

(function () {
  console.log("DIRECT DEEP LINK HANDLER LOADED - VERSION 2");

  // Configuration
  const config = {
    appScheme: "growguide://",
    webDomain: "https://growguide.app",
    appStoreUrl: "https://apps.apple.com/us/app/grow-guide/id6637720578",
    playStoreUrl: "https://play.google.com/store/apps/details?id=app.growguide",
    redirectUrl: "/redirect.html"
  };

  // App paths that should trigger deep linking
  const appPaths = ['user/', 'post/', 'grow/', 'tools/', 'mygrows/', 'questions/', 'admin/', 'profile/'];

  // Function to check if the current path is an app path
  function isAppPath(path) {
    console.log("Checking if path is app path:", path);
    console.log("Path type:", typeof path);
    console.log("Path length:", path.length);
    // Log the appPaths array to verify it contains 'profile/'
    console.log("Available app paths:", appPaths);

    // Try a direct comparison for debugging
    const isProfilePath = path.indexOf('profile/') === 0;
    console.log("Direct profile/ check:", isProfilePath);

    // Check each path prefix individually
    appPaths.forEach(prefix => {
      console.log(`Checking if path starts with '${prefix}':`, path.startsWith(prefix));
    });

    const result = appPaths.some(appPath => path.startsWith(appPath));
    console.log("Is app path result:", result);
    return result;
  }

  // Function to extract path from URL
  function getPathFromUrl() {
    const pathname = window.location.pathname;
    console.log("Raw pathname:", pathname);
    if (pathname && pathname !== "/" && pathname !== "/index.html") {
      // Remove leading slash
      const path = pathname.replace(/^\//, "");
      console.log("Extracted path:", path);
      return path;
    }
    return "";
  }

  // Function to handle the deep link
  function handleDeepLink() {
    // Get the full URL and check if it contains /profile/
    const fullUrl = window.location.href;
    console.log("Full URL:", fullUrl);

    if (fullUrl.includes('/profile/')) {
      console.log("Profile URL detected via direct check");
      // Extract username from the URL
      const urlParts = fullUrl.split('/profile/');
      if (urlParts.length > 1) {
        let username = urlParts[1];
        // Remove any query parameters
        username = username.split('?')[0];
        console.log("Extracted username:", username);

        const path = 'user/' + username;
        console.log("Mapped to user path:", path);

        // Store the path for deferred retrieval
        try {
          localStorage.setItem("deferredDeepLink", "/" + path);
          localStorage.setItem("deferredDeepLinkTimestamp", Date.now().toString());
          console.log("Stored deep link:", "/" + path);

          // Store UTM parameters if present
          const urlParams = new URLSearchParams(window.location.search);
          const utmSource = urlParams.get("utm_source");
          if (utmSource) {
            localStorage.setItem("utm_source", utmSource);
            console.log("Stored UTM source:", utmSource);
          }
        } catch (e) {
          console.error("Error storing deep link:", e);
        }

        // Show the open app button
        console.log("Showing open app button for path:", path);
        showOpenAppButton(path);
        return;
      }
    }

    // Continue with the regular path handling
    let path = getPathFromUrl();
    console.log("Initial path from URL:", path);

    // Check if this is an app path
    if (path && isAppPath(path)) {
      console.log("App path detected:", path);

      // Store the path for deferred retrieval
      try {
        localStorage.setItem("deferredDeepLink", "/" + path);
        localStorage.setItem("deferredDeepLinkTimestamp", Date.now().toString());
        console.log("Stored deep link:", "/" + path);

        // Store UTM parameters if present
        const urlParams = new URLSearchParams(window.location.search);
        const utmSource = urlParams.get("utm_source");
        if (utmSource) {
          localStorage.setItem("utm_source", utmSource);
          console.log("Stored UTM source:", utmSource);
        }
      } catch (e) {
        console.error("Error storing deep link:", e);
      }

      // Only show the button - don't try to open the app automatically
      console.log("Showing open app button for path:", path);
      showOpenAppButton(path);
    } else {
      console.log("Not an app path, skipping deep link handling. Path:", path);
    }
  }

  // Function to show the open app button
  function showOpenAppButton(path) {
    // Wait for the DOM to be ready
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", function () {
        createOpenAppButton(path);
      });
    } else {
      createOpenAppButton(path);
    }
  }

  // Function to create the open app button
  function createOpenAppButton(path) {
    // Check if we're on mobile
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    const isAndroid = /android/i.test(navigator.userAgent);
    const isMobile = isIOS || isAndroid;

    // Check if the container already exists
    if (document.getElementById('gg-deep-link-container')) {
      return; // Don't create duplicate containers
    }

    // Create a stylesheet instead of inline styles to avoid conflicts
    const styleEl = document.createElement('style');
    styleEl.textContent = `
      #gg-deep-link-container {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: auto;
        max-width: 90%;
        background-color: rgba(18, 18, 18, 0.95);
        padding: 15px 20px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        z-index: 999999;
        text-align: center;
        font-family: system-ui, -apple-system, sans-serif;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        animation: gg-fade-in 0.3s ease-out;
      }
      @keyframes gg-fade-in {
        from { opacity: 0; transform: translate(-50%, 20px); }
        to { opacity: 1; transform: translate(-50%, 0); }
      }
      #gg-deep-link-message {
        margin: 0 0 12px 0;
        color: #e0e0e0;
        font-size: 16px;
        font-weight: normal;
        line-height: 1.4;
      }
      #gg-deep-link-button {
        background-color: #4ade80;
        color: #121212;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: bold;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-block;
        position: relative;
        min-width: 140px;
      }
      #gg-deep-link-button:hover {
        background-color: #3fcf76;
        transform: translateY(-2px);
      }
      #gg-deep-link-button.loading {
        background-color: #3fcf76;
        color: transparent;
      }
      #gg-deep-link-button.loading::after {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid rgba(0,0,0,0.2);
        border-radius: 50%;
        border-top-color: #121212;
        animation: gg-spin 0.8s linear infinite;
      }
      @keyframes gg-spin {
        to { transform: rotate(360deg); }
      }
      #gg-deep-link-close {
        position: absolute;
        top: 8px;
        right: 10px;
        background-color: transparent;
        border: none;
        color: #e0e0e0;
        font-size: 20px;
        cursor: pointer;
        padding: 0;
        line-height: 1;
        opacity: 0.7;
      }
      #gg-deep-link-close:hover {
        opacity: 1;
      }
      /* Make sure our styles don't leak */
      #gg-deep-link-container * {
        box-sizing: border-box;
        font-family: system-ui, -apple-system, sans-serif;
      }
    `;
    document.head.appendChild(styleEl);

    // Create the button container with class-based styling
    const container = document.createElement('div');
    container.id = 'gg-deep-link-container';

    // Create the message
    const message = document.createElement('p');
    message.id = 'gg-deep-link-message';

    // Create the button
    const button = document.createElement('button');
    button.id = 'gg-deep-link-button';

    if (isMobile) {
      message.textContent = 'View this content in the Grow Guide app';
      button.textContent = 'Open in App';

      // Add click event to open the app
      button.addEventListener('click', function openAppHandler() {
        const appUrl = config.appScheme + path;
        console.log("Opening app URL:", appUrl);

        // Show loading state
        button.classList.add('loading');
        const originalText = button.textContent;
        button.setAttribute('disabled', 'disabled');

        // Store current time to check if app opened
        const clickTime = Date.now();
        localStorage.setItem('gg_app_open_attempt', clickTime.toString());

        // Try to open the app
        window.location.href = appUrl;

        // Check if app opened after a delay
        setTimeout(function () {
          // If we're still visible and it's been less than 3 seconds since the click
          if (document.visibilityState === 'visible' &&
            Date.now() - clickTime < 3000) {
            console.log("App didn't open, showing download message");

            // Update message to indicate app isn't installed
            message.textContent = 'It looks like you don\'t have the app installed yet';
            button.classList.remove('loading');
            button.removeAttribute('disabled');
            button.textContent = 'Try Again';

            // Add a second button for downloading
            const downloadButton = document.createElement('button');
            downloadButton.id = 'gg-deep-link-download';
            downloadButton.textContent = 'Get the App';
            downloadButton.style.marginLeft = '10px';
            downloadButton.style.backgroundColor = '#2a2a2a';
            downloadButton.style.color = '#e0e0e0';

            // Add click event to go to app store
            downloadButton.addEventListener('click', function () {
              const storeUrl = isIOS ? config.appStoreUrl : config.playStoreUrl;
              window.open(storeUrl, '_blank');
            });

            // Add the download button next to the main button
            button.parentNode.insertBefore(downloadButton, button.nextSibling);
          } else {
            // Reset button if we're somehow still here but the timeout was longer
            button.classList.remove('loading');
            button.removeAttribute('disabled');
            button.textContent = originalText;
          }
        }, 2000);
      });
    } else {
      message.textContent = 'Get the Grow Guide app to view this content';
      button.textContent = 'Download App';

      // Add click event to go to app store or redirect page
      button.addEventListener('click', function () {
        // Show loading state
        button.classList.add('loading');
        button.setAttribute('disabled', 'disabled');

        // Redirect to the redirect page which handles app store links better
        setTimeout(function () {
          window.location.href = config.redirectUrl + '?path=' + path;
        }, 300); // Small delay to show the loading state
      });
    }

    // Add close button
    const closeButton = document.createElement('button');
    closeButton.id = 'gg-deep-link-close';
    closeButton.textContent = '×';

    closeButton.addEventListener('click', function () {
      if (container.parentNode) {
        container.parentNode.removeChild(container);
      }
    });

    // Assemble the container
    container.appendChild(closeButton);
    container.appendChild(message);
    container.appendChild(button);

    // Wait for the DOM to be fully loaded before appending
    if (document.readyState === 'complete') {
      document.body.appendChild(container);
    } else {
      // If DOM not ready, wait for it
      window.addEventListener('load', function () {
        document.body.appendChild(container);
      });
    }
  }

  // Run the handler with a slight delay to ensure it doesn't interfere with page loading
  if (document.readyState === 'complete') {
    setTimeout(handleDeepLink, 500);
  } else {
    window.addEventListener('load', function () {
      setTimeout(handleDeepLink, 500);
    });
  }

  // Also try to run immediately
  console.log("Attempting to run handleDeepLink immediately");
  handleDeepLink();
})();
