# Grow Guide Director WordPress Plugin

A comprehensive WordPress plugin that intelligently directs users to your mobile app with smart deep linking, fallback options, and user experience enhancements.

## Features

- **Smart Deep Linking**: Automatically detects mobile devices and attempts to open your app
- **Fallback Handling**: Shows app store badges when the app isn't installed
- **Desktop Support**: QR codes and download links for desktop users
- **Analytics Tracking**: Built-in interaction tracking and statistics
- **Shortcode Support**: Easy integration with WordPress content
- **Theme Integration**: PHP helper functions for developers
- **Responsive Design**: Works perfectly on all device sizes
- **Dark Theme Support**: Adapts to user's color scheme preferences

## Installation

1. Upload the `grow-guide-director` folder to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings > App Director to configure your app URLs
4. Start using shortcodes or PHP functions in your theme

## Configuration

### Basic Settings

Navigate to **Settings > App Director** in your WordPress admin to configure:

- **App URL Scheme**: Your custom app scheme (e.g., `growguide://`)
- **App Store URL**: Link to your iOS app on the App Store
- **Google Play Store URL**: Link to your Android app on Google Play
- **Fallback Behavior**: What happens when the app can't be opened

### App Paths

The plugin automatically handles these URL patterns:

- `/user/...` - User-related pages
- `/post/...` - Individual posts
- `/grow/...` - Grow-related content
- `/tools/...` - App tools
- `/mygrows/...` - User's grows
- `/questions/...` - Q&A sections
- `/admin/...` - Admin interfaces
- `/profile/...` - User profiles
- `/settings/...` - App settings
- `/help/...` - Help content

You can customize these paths using the `ggd_app_paths` filter in your theme.

## Usage

### Shortcodes

#### App Link Shortcode

Create buttons that open specific app sections:

```php
[app_link path="user/profile" text="Open Profile" class="btn btn-primary"]
```

**Parameters:**

- `path` - The app path to open
- `text` - Button text (default: "Open in App")
- `class` - CSS classes (default: "ggd-app-link btn")
- `fallback` - Fallback behavior: "store", "modal", or "web"

#### Smart Redirect Shortcode

Automatically redirect users with a loading message:

```php
[smart_redirect path="post/123" delay="1000" message="Loading your post..."]
```

**Parameters:**

- `path` - The app path to redirect to
- `delay` - Delay in milliseconds (default: 1000)
- `message` - Loading message text

### PHP Functions

#### Generate App Links

```php
echo ggd_app_link('mygrows', 'View My Grows', 'custom-btn-class');
```

#### Direct App Redirection

```php
ggd_redirect_to_app('tools/calculator');
```

### JavaScript Integration

The plugin exposes global JavaScript functions:

```javascript
// Show app download prompt
window.ggdShowAppPrompt();

// Attempt to open app at specific path
window.ggdOpenApp("user/settings");
```

## Customization

### CSS Customization

All plugin styles are in `/assets/css/director.css`. You can override them in your theme:

```css
.ggd-app-link {
  background: your-brand-color !important;
}

.ggd-modal {
  border-radius: 20px !important;
}
```

### Adding Custom App Paths

Use the filter in your theme's `functions.php`:

```php
function custom_app_paths($paths) {
    $paths[] = 'custom-section';
    $paths[] = 'special-tools';
    return $paths;
}
add_filter('ggd_app_paths', 'custom_app_paths');
```

### Custom Fallback Behavior

Hook into the redirection process:

```php
function custom_fallback_handler($path, $config) {
    // Your custom logic here
    wp_redirect(home_url('/custom-fallback/'));
    exit;
}
add_action('ggd_app_redirect_fallback', 'custom_fallback_handler', 10, 2);
```

## Advanced Features

### Analytics & Tracking

The plugin automatically tracks:

- App link clicks
- Successful app opens
- Store badge clicks
- Redirect page views

View statistics in **Settings > App Director**.

### Desktop Experience

For desktop users, the plugin shows:

- QR codes for easy mobile access
- App store download buttons
- Responsive modal interfaces

### Mobile Detection

Automatically detects:

- iOS devices (uses custom URL schemes)
- Android devices (uses intent URLs with fallbacks)
- Mobile browsers vs desktop

## Troubleshooting

### App Not Opening

1. Verify your app URL scheme is correct
2. Check that your app handles the deep link format
3. Ensure the app is installed on the test device

### Store URLs Not Working

1. Verify App Store and Google Play URLs are correct
2. Check that the apps are published and available
3. Test URLs in a browser first

### JavaScript Errors

1. Check that jQuery is loaded
2. Verify no conflicts with other plugins
3. Check browser console for specific errors

## Development

### File Structure

```
grow-guide-director/
├── grow-guide-director.php    # Main plugin file
├── assets/
│   ├── css/
│   │   └── director.css       # Plugin styles
│   └── js/
│       └── director.js        # Plugin JavaScript
├── templates/
│   ├── admin-page.php         # Admin settings page
│   └── app-redirect.php       # App redirect template
└── README.md                  # This file
```

### Hooks & Filters

**Filters:**

- `ggd_app_paths` - Modify app paths that trigger redirection
- `ggd_config` - Modify plugin configuration
- `ggd_deep_link` - Modify generated deep links

**Actions:**

- `ggd_before_redirect` - Before app redirection
- `ggd_after_redirect` - After app redirection
- `ggd_app_redirect_fallback` - Custom fallback handling

## Changelog

### 1.0.0

- Initial release
- Smart deep linking for iOS and Android
- Desktop QR code support
- Admin interface with analytics
- Shortcode and PHP function support
- Dark theme compatibility

## Support

For support, feature requests, or bug reports, please contact the Grow Guide development team.

## License

This plugin is licensed under the GPL v2 or later.
