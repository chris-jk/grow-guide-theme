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
    wp_enqueue_style('generic-style', get_stylesheet_uri(), array(), '1.0');
    
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap', array(), null);
    
    // Check if unified scripts file exists, otherwise use app-links.js
    $unified_scripts_path = get_template_directory() . '/assets/js/unified-scripts.js';
    $app_links_path = get_template_directory() . '/app-links.js';
    
    if (file_exists($unified_scripts_path)) {
        // Use unified scripts if available
        wp_enqueue_script('generic-unified-scripts', get_template_directory_uri() . '/assets/js/unified-scripts.js', array(), '1.0', true);
    } elseif (file_exists($app_links_path) && is_front_page()) {
        // Fallback to app-links.js for front page only
        wp_enqueue_script('generic-app-links', get_template_directory_uri() . '/app-links.js', array(), '1.0', true);
    }
    
    // Get URLs and settings from customizer for front page
    if (is_front_page()) {
        $app_name = get_theme_mod('app_name', 'Grow Guide');
        $app_store_url = get_theme_mod('app_store_url', 'https://apps.apple.com/us/app/grow-guide/id6637720578');
        $google_play_url = get_theme_mod('google_play_url', 'https://play.google.com/store/apps/details?id=app.growguide');
        $google_play_id = get_theme_mod('google_play_id', 'com.growguide');
        $apple_app_id = get_theme_mod('apple_app_id', '');
        
        // Localize script with app store URLs and settings
        $script_handle = file_exists($unified_scripts_path) ? 'generic-unified-scripts' : 'generic-app-links';
        wp_localize_script($script_handle, 'appUrls', array(
            'appName' => $app_name,
            'appStore' => $app_store_url,
            'googlePlay' => $google_play_url,
            'googlePlayId' => $google_play_id,
            'appleAppId' => $apple_app_id,
            'fallback' => home_url()
        ));
    }
    
    // Enqueue comment reply script on single posts/pages
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
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

// Add widget areas support
function generic_widgets_init() {
    register_sidebar(array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar-1',
        'description'   => 'Add widgets here to appear in your sidebar.',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => 'Footer',
        'id'            => 'footer-1',
        'description'   => 'Add widgets here to appear in your footer.',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'generic_widgets_init');

// Custom comment callback function
function generic_comment_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    
    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    
    <div class="comment-author vcard">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
        <div class="comment-meta">
            <?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
            <div class="comment-metadata">
                <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                    <time datetime="<?php comment_time('c'); ?>">
                        <?php printf('%1$s at %2$s', get_comment_date(), get_comment_time()); ?>
                    </time>
                </a>
                <?php edit_comment_link('(Edit)', '&nbsp;&nbsp;', ''); ?>
            </div>
        </div>
    </div>
    
    <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>
        <br />
    <?php endif; ?>
    
    <div class="comment-content">
        <?php comment_text(); ?>
    </div>
    
    <div class="reply">
        <?php comment_reply_link(array_merge($args, array(
            'add_below' => $add_below,
            'depth' => $depth,
            'max_depth' => $args['max_depth']
        ))); ?>
    </div>
    
    <?php if ('div' != $args['style']) : ?>
        </div>
    <?php endif; ?>
    <?php
}

// Improve excerpt handling
function generic_custom_excerpt_more($more) {
    if (is_admin()) {
        return $more;
    }
    return '&hellip; <a href="' . get_permalink() . '" class="read-more-link">Read More</a>';
}
add_filter('excerpt_more', 'generic_custom_excerpt_more');

// Add custom body classes
function generic_custom_body_classes($classes) {
    // Add a class for the current page template
    if (is_page_template()) {
        $template = str_replace('.php', '', get_page_template_slug());
        $classes[] = 'page-template-' . $template;
    }
    
    // Add class for posts with thumbnails
    if (is_singular() && has_post_thumbnail()) {
        $classes[] = 'has-post-thumbnail';
    }
    
    // Add class for dark mode (always active for this theme)
    $classes[] = 'dark-mode';
    
    return $classes;
}
add_filter('body_class', 'generic_custom_body_classes');

// Optimize images
function generic_custom_image_sizes() {
    add_image_size('archive-thumbnail', 400, 200, true);
    add_image_size('hero-image', 1200, 600, true);
}
add_action('after_setup_theme', 'generic_custom_image_sizes');

// Add theme color customization options
function generic_color_customize_register($wp_customize) {
    // Add color section
    $wp_customize->add_section('theme_colors', array(
        'title' => 'Theme Colors',
        'priority' => 32,
        'description' => 'Customize the theme colors'
    ));
    
    // Accent color
    $wp_customize->add_setting('accent_color', array(
        'default' => '#10b981',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label' => 'Accent Color',
        'section' => 'theme_colors',
        'description' => 'The primary accent color used throughout the theme'
    )));
}
add_action('customize_register', 'generic_color_customize_register');

// Output custom colors
function generic_custom_colors() {
    $accent_color = get_theme_mod('accent_color', '#10b981');
    
    if ($accent_color !== '#10b981') {
        ?>
        <style type="text/css">
            :root {
                --accent-primary: <?php echo esc_attr($accent_color); ?>;
                --accent-secondary: <?php echo esc_attr(adjust_brightness($accent_color, -20)); ?>;
                --accent-hover: <?php echo esc_attr(adjust_brightness($accent_color, 20)); ?>;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'generic_custom_colors');

// Helper function to adjust color brightness
function adjust_brightness($hex, $percent) {
    // Remove # if present
    $hex = ltrim($hex, '#');
    
    // Convert to RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    // Adjust brightness
    $r = min(255, max(0, $r + ($r * $percent / 100)));
    $g = min(255, max(0, $g + ($g * $percent / 100)));
    $b = min(255, max(0, $b + ($b * $percent / 100)));
    
    // Convert back to hex
    return sprintf('#%02x%02x%02x', $r, $g, $b);
}
