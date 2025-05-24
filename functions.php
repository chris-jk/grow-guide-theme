<?php
/**
 * Generic WordPress Theme Functions
 */

// Theme setup
function generic_theme_setup() {
    // Add theme support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add theme support for automatic feed links
    add_theme_support('automatic-feed-links');
    
    // Add theme support for title tag
    add_theme_support('title-tag');
    
    // Add theme support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Register navigation menu
    register_nav_menus(array(
        'primary' => 'Primary Menu',
    ));
}
add_action('after_setup_theme', 'generic_theme_setup');

// Enqueue styles and scripts
function generic_theme_scripts() {
    wp_enqueue_style('generic-style', get_stylesheet_uri());
    
    // Only enqueue JS on front page
    if (is_front_page()) {
        wp_enqueue_script('generic-app-links', get_template_directory_uri() . '/app-links.js', array(), '1.0', true);
        
        // Get URLs and settings from customizer
        $app_name = get_theme_mod('app_name', 'Grow Guide');
        $app_store_url = get_theme_mod('app_store_url', 'https://apps.apple.com/us/app/grow-guide/id6637720578');
        $google_play_url = get_theme_mod('google_play_url', 'https://play.google.com/store/apps/details?id=app.growguide');
        $google_play_id = get_theme_mod('google_play_id', 'com.growguide');
        $apple_app_id = get_theme_mod('apple_app_id', '');
        
        // Localize script with app store URLs and settings
        wp_localize_script('generic-app-links', 'appUrls', array(
            'appName' => $app_name,
            'appStore' => $app_store_url,
            'googlePlay' => $google_play_url,
            'googlePlayId' => $google_play_id,
            'appleAppId' => $apple_app_id,
            'fallback' => home_url()
        ));
    }
}
add_action('wp_enqueue_scripts', 'generic_theme_scripts');

// Set content width
if (!isset($content_width)) {
    $content_width = 800;
}

// Custom excerpt length
function generic_custom_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'generic_custom_excerpt_length');

// Custom excerpt more
function generic_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'generic_excerpt_more');

// Add Customizer settings for homepage features
function generic_customize_register($wp_customize) {
    // Add section for features
    $wp_customize->add_section('homepage_features', array(
        'title' => 'Homepage Features',
        'priority' => 30,
        'description' => 'Manage the features displayed on your homepage'
    ));
    
    // Add up to 6 features
    for ($i = 1; $i <= 6; $i++) {
        // Feature title
        $wp_customize->add_setting("feature_{$i}_title", array(
            'default' => $i <= 3 ? get_default_feature_title($i) : '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control("feature_{$i}_title", array(
            'label' => "Feature {$i} Title",
            'section' => 'homepage_features',
            'type' => 'text'
        ));
        
        // Feature description
        $wp_customize->add_setting("feature_{$i}_description", array(
            'default' => $i <= 3 ? get_default_feature_description($i) : '',
            'sanitize_callback' => 'sanitize_textarea_field'
        ));
        
        $wp_customize->add_control("feature_{$i}_description", array(
            'label' => "Feature {$i} Description",
            'section' => 'homepage_features',
            'type' => 'textarea'
        ));
        
        // Feature icon (optional)
        $wp_customize->add_setting("feature_{$i}_icon", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control("feature_{$i}_icon", array(
            'label' => "Feature {$i} Icon (optional - use emoji or icon class)",
            'section' => 'homepage_features',
            'type' => 'text',
            'description' => 'Add an emoji (🌱) or icon class for this feature'
        ));
    }
    
    // App Store URLs
    $wp_customize->add_section('app_settings', array(
        'title' => 'App Store Settings',
        'priority' => 31,
        'description' => 'Configure app download links and information'
    ));
    
    // App Name
    $wp_customize->add_setting('app_name', array(
        'default' => 'Grow Guide',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('app_name', array(
        'label' => 'App Name',
        'section' => 'app_settings',
        'type' => 'text',
        'description' => 'The name of your mobile app'
    ));
    
    // App Store URL
    $wp_customize->add_setting('app_store_url', array(
        'default' => 'https://apps.apple.com/app/grow-guide',
        'sanitize_callback' => 'esc_url_raw'
    ));
    
    $wp_customize->add_control('app_store_url', array(
        'label' => 'Apple App Store URL',
        'section' => 'app_settings',
        'type' => 'url',
        'description' => 'Full URL to your app in the Apple App Store'
    ));
    
    // Google Play URL
    $wp_customize->add_setting('google_play_url', array(
        'default' => 'https://play.google.com/store/apps/details?id=com.growguide',
        'sanitize_callback' => 'esc_url_raw'
    ));
    
    $wp_customize->add_control('google_play_url', array(
        'label' => 'Google Play Store URL',
        'section' => 'app_settings',
        'type' => 'url',
        'description' => 'Full URL to your app in the Google Play Store'
    ));
    
    // App ID for Google Play (for QR codes)
    $wp_customize->add_setting('google_play_id', array(
        'default' => 'com.growguide',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('google_play_id', array(
        'label' => 'Google Play App ID',
        'section' => 'app_settings',
        'type' => 'text',
        'description' => 'Your app\'s package name (e.g., com.yourcompany.appname)'
    ));
    
    // Apple App ID (for QR codes)
    $wp_customize->add_setting('apple_app_id', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('apple_app_id', array(
        'label' => 'Apple App ID',
        'section' => 'app_settings',
        'type' => 'text',
        'description' => 'Your app\'s Apple ID number (optional, for better QR codes)'
    ));
    
    // Enable/Disable App Download Section
    $wp_customize->add_setting('show_app_download', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean'
    ));
    
    $wp_customize->add_control('show_app_download', array(
        'label' => 'Show App Download Section',
        'section' => 'app_settings',
        'type' => 'checkbox',
        'description' => 'Display the app download section on the homepage'
    ));
}
add_action('customize_register', 'generic_customize_register');

// Get default feature titles
function get_default_feature_title($number) {
    $defaults = array(
        1 => 'Plant Care Guide',
        2 => 'Watering Reminders',
        3 => 'Garden Planning'
    );
    return isset($defaults[$number]) ? $defaults[$number] : '';
}

// Get default feature descriptions
function get_default_feature_description($number) {
    $defaults = array(
        1 => 'Get personalized care instructions for your plants',
        2 => 'Never forget to water your plants again',
        3 => 'Plan and design your perfect garden space'
    );
    return isset($defaults[$number]) ? $defaults[$number] : '';
}

// Get all features for display
function get_homepage_features() {
    $features = array();
    
    for ($i = 1; $i <= 6; $i++) {
        $title = get_theme_mod("feature_{$i}_title", '');
        $description = get_theme_mod("feature_{$i}_description", '');
        $icon = get_theme_mod("feature_{$i}_icon", '');
        
        if (!empty($title) && !empty($description)) {
            $features[] = array(
                'title' => $title,
                'description' => $description,
                'icon' => $icon
            );
        }
    }
    
    return $features;
}
?>
