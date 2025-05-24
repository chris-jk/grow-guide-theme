/**
 * App Links and QR Code Handler
 */

document.addEventListener('DOMContentLoaded', function () {
    // Check if we're on mobile or desktop
    const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    // Get app store links
    const appStoreLink = document.getElementById('app-store-link');
    const googlePlayLink = document.getElementById('google-play-link');

    if (appStoreLink && googlePlayLink) {
        // Set up app store URLs
        appStoreLink.href = appUrls.appStore || '#';
        googlePlayLink.href = appUrls.googlePlay || '#';

        // Add click handlers for mobile
        if (isMobile) {
            appStoreLink.addEventListener('click', function (e) {
                e.preventDefault();
                handleMobileAppDownload('ios');
            });

            googlePlayLink.addEventListener('click', function (e) {
                e.preventDefault();
                handleMobileAppDownload('android');
            });
        }
    }

    // Generate QR code for desktop
    if (!isMobile) {
        generateQRCode();
    }
});

/**
 * Handle mobile app download
 */
function handleMobileAppDownload(platform) {
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent);
    const isAndroid = /Android/.test(navigator.userAgent);

    let appUrl = '';

    if (platform === 'ios' && isIOS) {
        appUrl = appUrls.appStore;
    } else if (platform === 'android' && isAndroid) {
        appUrl = appUrls.googlePlay;
    } else {
        // Fallback to website
        appUrl = appUrls.fallback;
    }

    if (appUrl && appUrl !== '#') {
        window.location.href = appUrl;
    }
}

/**
 * Generate QR code for desktop users
 */
function generateQRCode() {
    const qrElement = document.getElementById('qr-code');
    if (!qrElement) return;

    // Determine the appropriate app store URL based on user agent
    const isAppleDevice = /Mac|iPhone|iPad|iPod/.test(navigator.userAgent);
    const qrUrl = isAppleDevice ? appUrls.appStore : appUrls.googlePlay;

    // Create QR code using a simple API (you can replace with a more robust solution)
    const qrApiUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(qrUrl || appUrls.fallback)}`;

    // Replace placeholder with actual QR code
    qrElement.innerHTML = `<img src="${qrApiUrl}" alt="QR Code to download app" style="width: 150px; height: 150px; border-radius: 8px;">`;
}

/**
 * Fallback QR code generation if API fails
 */
function generateFallbackQR() {
    const qrElement = document.getElementById('qr-code');
    if (!qrElement) return;

    // Create a simple pattern as fallback
    qrElement.innerHTML = `
        <div style="width: 150px; height: 150px; background: #000; position: relative; border-radius: 8px;">
            <div style="position: absolute; top: 10px; left: 10px; width: 20px; height: 20px; background: #fff;"></div>
            <div style="position: absolute; top: 10px; right: 10px; width: 20px; height: 20px; background: #fff;"></div>
            <div style="position: absolute; bottom: 10px; left: 10px; width: 20px; height: 20px; background: #fff;"></div>
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 30px; height: 30px; background: #fff;"></div>
        </div>
    `;
}
