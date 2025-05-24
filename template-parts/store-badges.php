<?php
/**
 * Template part for displaying store badges
 */
?>

<div class="store-badges">
    <a href="<?php echo get_theme_mod('app_store_url', 'https://apps.apple.com/us/app/grow-guide/id6637720578'); ?>" target="_blank" rel="noopener">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/appstore.svg" alt="Download on App Store" class="store-badge" />
    </a>
    <a href="<?php echo get_theme_mod('google_play_url', 'https://play.google.com/store/apps/details?id=app.growguide'); ?>" target="_blank" rel="noopener">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/playstore.png" alt="Get it on Google Play" class="store-badge" />
    </a>
</div>
