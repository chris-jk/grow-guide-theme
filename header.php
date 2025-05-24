<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#10b981">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">
        <div class="header-content">
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
            </h1>
            
            <?php if (has_nav_menu('primary')): ?>
                <nav class="main-navigation">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                    )); ?>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</header>
