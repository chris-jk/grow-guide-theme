<?php
/**
 * Functions and definitions for Grow Guide theme
 */

// Theme setup
function grow_guide_setup() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'mobile' => 'Mobile Menu'
    ));
}
add_action('after_setup_theme', 'grow_guide_setup');

// Enqueue styles and scripts
function grow_guide_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('grow-guide-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue unified styles
    wp_enqueue_style('grow-guide-unified', get_template_directory_uri() . '/assets/css/unified-styles.css', array(), '1.0.0');
    
    // Enqueue Google Fonts
    wp_enqueue_style('grow-guide-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Enqueue JavaScript files
    wp_enqueue_script('qr-code', 'https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js', array(), '1.0.0', true);
    wp_enqueue_script('grow-guide-direct-deep-link', get_template_directory_uri() . '/assets/js/direct-deep-link.js', array(), '1.0.0', true);
    wp_enqueue_script('grow-guide-unified', get_template_directory_uri() . '/assets/js/unified-scripts.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('grow-guide-unified', 'grow_guide_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('grow_guide_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'grow_guide_scripts');

// Widget areas
function grow_guide_widgets_init() {
    // Main sidebar for blog pages
    register_sidebar(array(
        'name'          => 'Primary Sidebar',
        'id'            => 'sidebar-1',
        'description'   => 'Main sidebar for blog pages',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => 'Footer Widget Area 1',
        'id'            => 'footer-1',
        'description'   => 'Footer widget area 1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => 'Footer Widget Area 2',
        'id'            => 'footer-2',
        'description'   => 'Footer widget area 2',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => 'Footer Widget Area 3',
        'id'            => 'footer-3',
        'description'   => 'Footer widget area 3',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'grow_guide_widgets_init');

// Custom post types
function grow_guide_custom_post_types() {
    // Features post type
    register_post_type('features', array(
        'labels' => array(
            'name' => 'Features',
            'singular_name' => 'Feature'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-star-filled'
    ));
    
    // Testimonials post type
    register_post_type('testimonials', array(
        'labels' => array(
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote'
    ));
}
add_action('init', 'grow_guide_custom_post_types');

// Add custom meta boxes
function grow_guide_add_meta_boxes() {
    add_meta_box(
        'testimonial_details',
        'Testimonial Details',
        'grow_guide_testimonial_meta_box',
        'testimonials'
    );
}
add_action('add_meta_boxes', 'grow_guide_add_meta_boxes');

function grow_guide_testimonial_meta_box($post) {
    wp_nonce_field('grow_guide_testimonial_nonce', 'grow_guide_testimonial_nonce');
    
    $author_name = get_post_meta($post->ID, '_testimonial_author', true);
    $rating = get_post_meta($post->ID, '_testimonial_rating', true);
    
    echo '<table>';
    echo '<tr><td><label for="testimonial_author">Author Name:</label></td>';
    echo '<td><input type="text" id="testimonial_author" name="testimonial_author" value="' . esc_attr($author_name) . '" /></td></tr>';
    echo '<tr><td><label for="testimonial_rating">Rating (1-5):</label></td>';
    echo '<td><input type="number" id="testimonial_rating" name="testimonial_rating" min="1" max="5" value="' . esc_attr($rating) . '" /></td></tr>';
    echo '</table>';
}

function grow_guide_save_testimonial_meta($post_id) {
    if (!isset($_POST['grow_guide_testimonial_nonce']) || !wp_verify_nonce($_POST['grow_guide_testimonial_nonce'], 'grow_guide_testimonial_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['testimonial_author'])) {
        update_post_meta($post_id, '_testimonial_author', sanitize_text_field($_POST['testimonial_author']));
    }
    
    if (isset($_POST['testimonial_rating'])) {
        update_post_meta($post_id, '_testimonial_rating', intval($_POST['testimonial_rating']));
    }
}
add_action('save_post', 'grow_guide_save_testimonial_meta');

// Customizer options
function grow_guide_customize_register($wp_customize) {
    // Hero section
    $wp_customize->add_section('hero_section', array(
        'title' => 'Hero Section',
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default' => 'Master Your Cultivation Journey',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => 'Hero Title',
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Track your grows, connect with expert growers, and get AI-powered recommendations for successful cultivation.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => 'Hero Subtitle',
        'section' => 'hero_section',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('hero_video', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_video', array(
        'label' => 'Hero Background Video',
        'section' => 'hero_section',
        'mime_type' => 'video',
    )));
    
    // App Store Links
    $wp_customize->add_section('app_links', array(
        'title' => 'App Store Links',
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('app_store_url', array(
        'default' => 'https://apps.apple.com/us/app/grow-guide/id6637720578',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('app_store_url', array(
        'label' => 'App Store URL',
        'section' => 'app_links',
        'type' => 'url',
    ));
    
    $wp_customize->add_setting('google_play_url', array(
        'default' => 'https://play.google.com/store/apps/details?id=app.growguide',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('google_play_url', array(
        'label' => 'Google Play URL',
        'section' => 'app_links',
        'type' => 'url',
    ));
}
add_action('customize_register', 'grow_guide_customize_register');

// Add admin styles
function grow_guide_admin_styles() {
    wp_enqueue_style('grow-guide-admin', get_template_directory_uri() . '/admin-style.css');
}
add_action('admin_enqueue_scripts', 'grow_guide_admin_styles');

// Contact form handler
function grow_guide_handle_contact_form() {
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'grow_guide_contact_nonce')) {
        wp_die('Security check failed');
    }
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);
    
    $to = get_option('admin_email');
    $email_subject = 'New Contact Form Submission: ' . $subject;
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n\n";
    $email_message .= "Message:\n$message";
    
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    if (wp_mail($to, $email_subject, $email_message, $headers)) {
        wp_redirect(add_query_arg('contact', 'success', wp_get_referer()));
    } else {
        wp_redirect(add_query_arg('contact', 'error', wp_get_referer()));
    }
    exit;
}
add_action('admin_post_grow_guide_contact', 'grow_guide_handle_contact_form');
add_action('admin_post_nopriv_grow_guide_contact', 'grow_guide_handle_contact_form');

// Security enhancements
function grow_guide_security_enhancements() {
    // Remove WordPress version from head
    remove_action('wp_head', 'wp_generator');
    
    // Remove RSD link
    remove_action('wp_head', 'rsd_link');
    
    // Remove Windows Live Writer link
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove adjacent posts links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');
    
    // Remove feed links (optional - comment out if you want RSS feeds)
    // remove_action('wp_head', 'feed_links', 2);
    // remove_action('wp_head', 'feed_links_extra', 3);
}
add_action('init', 'grow_guide_security_enhancements');

// Performance optimizations
function grow_guide_performance_optimizations() {
    // Remove emoji scripts and styles
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    
    // Remove jQuery migrate in frontend
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, null, true);
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'grow_guide_performance_optimizations');

// Add image sizes
function grow_guide_image_sizes() {
    add_image_size('feature-icon', 80, 80, true);
    add_image_size('testimonial-avatar', 60, 60, true);
    add_image_size('hero-image', 1200, 600, true);
}
add_action('after_setup_theme', 'grow_guide_image_sizes');

// Add excerpt support to pages
function grow_guide_add_excerpts_to_pages() {
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'grow_guide_add_excerpts_to_pages');

// Custom excerpt length
function grow_guide_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'grow_guide_excerpt_length');

// Custom excerpt more
function grow_guide_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'grow_guide_excerpt_more');

// Add body classes for better styling
function grow_guide_body_classes($classes) {
    // Add page slug to body class
    if (is_page()) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }
    
    // Add post type to body class
    if (is_singular()) {
        global $post;
        $classes[] = 'single-' . $post->post_type;
    }
    
    return $classes;
}
add_filter('body_class', 'grow_guide_body_classes');

// Clean up wp_head
function grow_guide_clean_head() {
    // Remove DNS prefetch to //s.w.org
    remove_action('wp_head', 'wp_resource_hints', 2);
}
add_action('init', 'grow_guide_clean_head');
?>
