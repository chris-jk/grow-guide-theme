# Grow Guide WordPress Theme - Setup Guide

## Quick Installation

### 1. Upload Theme Files

1. Download or copy the entire `wp-theme` folder
2. Rename it to `grow-guide`
3. Upload to your WordPress site's `/wp-content/themes/` directory
4. The path should be: `/wp-content/themes/grow-guide/`

### 2. Activate Theme

1. Log in to your WordPress admin panel
2. Go to **Appearance > Themes**
3. Find "Grow Guide" theme and click **Activate**

### 3. Configure Theme Settings

Go to **Appearance > Customize** to configure:

#### Hero Section

- **Hero Heading**: Main heading on homepage
- **Hero Description**: Subtitle/description text

#### App Store Links

- **iOS App Store URL**: Link to your iOS app
- **Google Play Store URL**: Link to your Android app

#### Contact Settings

- **Contact Email**: Email address for contact form submissions

### 4. Set Up Menus

1. Go to **Appearance > Menus**
2. Create a new menu called "Primary Menu"
3. Add your pages to the menu
4. Assign it to "Primary Menu" location
5. Optionally create a "Footer Menu" for footer links

### 5. Configure Widgets

1. Go to **Appearance > Widgets**
2. Add widgets to these areas:
   - **Footer Column 1**: Contact information
   - **Footer Column 2**: Quick links
   - **Footer Column 3**: Social media or app download links
   - **Sidebar**: For blog pages (optional)

### 6. Create Required Pages

Create these pages with the following slugs for automatic template assignment:

- **About** (slug: `about`) - Uses `page-about.php`
- **Contact** (slug: `contact`) - Uses `page-contact.php`
- **Learn to Grow** (slug: `learn-to-grow`) - Uses `page-learn.php`
- **Privacy Policy** (slug: `privacy`) - Uses `page-privacy.php`
- **Terms of Service** (slug: `terms`) - Uses `page-terms.php`
- **Pro Members** (slug: `pro-members`) - Uses `page-pro.php`

### 7. Add Content Using Custom Post Types

#### Features

1. Go to **Features > Add New** in WordPress admin
2. Add feature title and description
3. Set feature icon class (Font Awesome or custom icons)
4. Publish the feature

#### Testimonials

1. Go to **Testimonials > Add New** in WordPress admin
2. Add testimonial content
3. Set author name and title
4. Add author image as featured image
5. Publish the testimonial

## Advanced Configuration

### Custom CSS

Add custom styles in **Appearance > Customize > Additional CSS**

### Child Theme (Recommended)

For customizations, create a child theme to preserve changes during updates:

1. Create folder: `/wp-content/themes/grow-guide-child/`
2. Create `style.css`:

```css
/*
Theme Name: Grow Guide Child
Template: grow-guide
Version: 1.0.0
*/

@import url("../grow-guide/style.css");

/* Your custom styles here */
```

3. Create `functions.php`:

```php
<?php
function grow_guide_child_enqueue_styles() {
    wp_enqueue_style('grow-guide-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('grow-guide-child-style', get_stylesheet_uri(), array('grow-guide-style'));
}
add_action('wp_enqueue_scripts', 'grow_guide_child_enqueue_styles');
?>
```

### Email Configuration

For the contact form to work properly:

1. Install an SMTP plugin like "WP Mail SMTP"
2. Configure your email settings
3. Test the contact form

### Performance Optimization

1. Install a caching plugin
2. Optimize images
3. Use a CDN for assets
4. Enable GZIP compression

## Troubleshooting

### Common Issues

**Contact Form Not Sending Emails**

- Check WordPress email configuration
- Install and configure an SMTP plugin
- Verify the contact email in Customizer

**Custom Post Types Not Showing**

- Go to **Settings > Permalinks** and click "Save Changes" to flush rewrite rules

**Menu Not Displaying**

- Ensure menu is assigned to "Primary Menu" location in **Appearance > Menus**

**Theme Customizer Changes Not Saving**

- Check file permissions on WordPress directory
- Deactivate plugins temporarily to check for conflicts

## Support

For technical support or customization requests, please contact the development team with:

- WordPress version
- PHP version
- Active plugins list
- Detailed description of the issue

## File Structure Reference

```
grow-guide/
├── style.css (Theme info and main styles)
├── functions.php (Theme functionality)
├── index.php (Homepage template)
├── header.php (Site header)
├── footer.php (Site footer)
├── page.php (Generic page template)
├── page-about.php (About page)
├── page-contact.php (Contact page)
├── page-learn.php (Learning resources)
├── page-privacy.php (Privacy policy)
├── page-terms.php (Terms of service)
├── page-pro.php (Pro features)
├── single.php (Blog post template)
├── archive.php (Archive template)
├── search.php (Search results)
├── 404.php (Error page)
├── comments.php (Comments template)
├── sidebar.php (Sidebar template)
├── assets/
│   ├── css/ (Stylesheets)
│   ├── js/ (JavaScript files)
│   ├── images/ (Theme images)
│   └── video/ (Video assets)
└── README.md (Theme documentation)
```
