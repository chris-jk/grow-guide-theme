<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Primary Meta Tags -->
    <meta name="title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url('/'); ?>">
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <?php if (has_custom_logo()): 
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
    ?>
    <meta property="og:image" content="<?php echo esc_url($logo_url); ?>">
    <?php endif; ?>

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo home_url('/'); ?>">
    <meta property="twitter:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta property="twitter:description" content="<?php bloginfo('description'); ?>">
    <?php if (has_custom_logo()): ?>
    <meta property="twitter:image" content="<?php echo esc_url($logo_url); ?>">
    <?php endif; ?>

    <!-- App-specific Meta Tags -->
    <meta name="apple-itunes-app" content="app-id=6637720578">
    <meta name="google-play-app" content="app-id=app.growguide">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Navigation -->
<nav class="navbar">
    <div class="container">
        <a href="<?php echo home_url('/'); ?>" class="logo">
            <?php if (has_custom_logo()): ?>
                <?php the_custom_logo(); ?>
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?> Logo" />
            <?php endif; ?>
            <div class="logo-text"><?php bloginfo('name'); ?></div>
        </a>

        <div class="nav-links">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => '',
                'container' => false,
                'fallback_cb' => 'grow_guide_fallback_menu'
            ));
            ?>
        </div>

        <button class="mobile-menu-btn" aria-label="Open Menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu">
    <button class="mobile-menu-close" aria-label="Close Menu">
        <i class="fas fa-times"></i>
    </button>
    <div class="nav-links">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'mobile',
            'menu_class' => '',
            'container' => false,
            'fallback_cb' => 'grow_guide_fallback_menu'
        ));
        ?>
    </div>
</div>

<?php
// Fallback menu function
function grow_guide_fallback_menu() {
    echo '<a href="#features">Features</a>';
    echo '<a href="#tools">Tools</a>';
    echo '<a href="#how-it-works">How It Works</a>';
    echo '<a href="#testimonials">Testimonials</a>';
    echo '<a href="#pro">Pro Features</a>';
    echo '<a href="' . home_url('/learn') . '">Learn</a>';
    echo '<a href="' . home_url('/contact') . '">Contact</a>';
}
?>
