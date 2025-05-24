/**
 * Unified JavaScript for Grow Guide Website
 *
 * This file now serves as a loader for the separated JavaScript modules:
 * - main.js: Contains general UI functionality
 * - smart-deep-link.js: Contains deep linking and attribution functionality
 *
 * This approach allows for better organization and maintenance of the codebase.
 */

// Load the main.js and smart-deep-link.js files
document.addEventListener('DOMContentLoaded', function () {
  // Get the theme directory URL from WordPress
  const themeUrl = document.body.dataset.themeUrl || window.location.origin;
  
  // Create script elements for each JS file
  const mainScript = document.createElement('script');
  mainScript.src = themeUrl + '/assets/js/main.js';

  const deepLinkingScript = document.createElement('script');
  deepLinkingScript.src = themeUrl + '/assets/js/smart-deep-link.js';
  deepLinkingScript.setAttribute('data-auto-init', 'true');

  // Append the scripts to the document
  document.head.appendChild(mainScript);
  document.head.appendChild(deepLinkingScript);

  console.log('Unified scripts loader: Loading main.js and smart-deep-link.js');
});

// Check if the current path is a deep link path
function isDeepLinkPath(path) {
  const deepLinkPaths = ['user/', 'post/', 'grow/', 'tools/', 'mygrows/', 'questions/', 'admin/', 'profile/'];
  return deepLinkPaths.some(prefix => path.startsWith(prefix));
}
