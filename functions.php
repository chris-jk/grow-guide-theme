<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function grow_guide_setup()
{
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'menu-1' => esc_html__('Primary', 'grow-guide'),
        'footer-menu' => esc_html__('Footer Menu', 'grow-guide'),
    ));

    // Switch default core markup to output valid HTML5.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height' => 250,
        'width' => 250,
        'flex-width' => true,
        'flex-height' => true,
    ));
}
add_action('after_setup_theme', 'grow_guide_setup');

/**
 * Register widget area.
 */
function grow_guide_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'grow-guide'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'grow-guide'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'grow_guide_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function grow_guide_scripts()
{
    wp_enqueue_style('grow-guide-style', get_stylesheet_uri(), array(), _S_VERSION);

    // Add your custom CSS file
    wp_enqueue_style('grow-guide-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), _S_VERSION);

    // Add your custom JS file
    wp_enqueue_script('grow-guide-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'grow_guide_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';