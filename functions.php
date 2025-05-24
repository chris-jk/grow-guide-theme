<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Grow_Guide_Theme
 */

if (!defined('GROW_GUIDE_THEME_VERSION')) {
    // Replace with your theme version.
    define('GROW_GUIDE_THEME_VERSION', '1.0.0');
}

if (!function_exists('grow_guide_theme_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function grow_guide_theme_setup()
    {

        // Make theme available for translation.
        load_theme_textdomain('grow-guide-theme', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Register navigation menus.
        register_nav_menus(
            array(
                'primary' => esc_html__('Primary Menu', 'grow-guide-theme'),
                'footer' => esc_html__('Footer Menu', 'grow-guide-theme'),
            )
        );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'grow_guide_theme_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'grow_guide_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function grow_guide_theme_content_width()
{
    $GLOBALS['content_width'] = apply_filters('grow_guide_theme_content_width', 640);
}
add_action('after_setup_theme', 'grow_guide_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function grow_guide_theme_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'grow-guide-theme'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'grow-guide-theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}
add_action('widgets_init', 'grow_guide_theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function grow_guide_theme_scripts()
{
    wp_enqueue_style('grow-guide-theme-style', get_stylesheet_uri(), array(), GROW_GUIDE_THEME_VERSION);
    wp_style_add_data('grow-guide-theme-style', 'rtl', 'replace');

    // Enqueue your main JavaScript file
    // You might want to create a js/main.js file or similar for your custom scripts
    // wp_enqueue_script( 'grow-guide-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), GROW_GUIDE_THEME_VERSION, true );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'grow_guide_theme_scripts');

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
// require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
// 	require get_template_directory() . '/inc/jetpack.php';
// }

?>