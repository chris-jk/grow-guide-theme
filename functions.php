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
?>
