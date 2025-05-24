<?php
/**
 * The template for displaying the footer
 */
?>

<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="footer-widgets">
            <div class="footer-widget">
                <h3>About Grow Guide</h3>
                <p><?php echo get_theme_mod('footer_about_text', 'Your complete resource for plant growing guides and gardening tips.'); ?>
                </p>
            </div>

            <div class="footer-widget">
                <h3>Quick Links</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'menu_class' => 'footer-menu',
                    'depth' => 1,
                ));
                ?>
            </div>

            <div class="footer-widget">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <?php if (get_theme_mod('social_facebook')): ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_facebook')); ?>" target="_blank">Facebook</a>
                    <?php endif; ?>

                    <?php if (get_theme_mod('social_twitter')): ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_twitter')); ?>" target="_blank">Twitter</a>
                    <?php endif; ?>

                    <?php if (get_theme_mod('social_instagram')): ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_instagram')); ?>" target="_blank">Instagram</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="site-info">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>