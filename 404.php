<?php get_header(); ?>

<div class="page-container">
    <div class="content-section">
        <div class="error-visual">
            <h1 class="error-code">404</h1>
            <div class="error-plant">
                <i class="fas fa-seedling"></i>
            </div>
        </div>
        
        <div class="error-text">
            <h2>Oops! This Page Didn't Grow</h2>
            <p>It looks like the page you're looking for has wandered off into the garden. Don't worry, we can help you find what you're looking for!</p>
        </div>

        <div class="error-actions">
            <a href="<?php echo home_url('/'); ?>" class="btn">
                <i class="fas fa-home"></i> Back to Home
            </a>
            
            <div class="search-form-container">
                <h3>Search for what you need:</h3>
                <?php get_search_form(); ?>
            </div>
        </div>

        <div class="helpful-links">
            <h3>Popular Pages</h3>
            <div class="links-grid">
                <a href="<?php echo home_url('/learn'); ?>" class="help-link">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Learn to Grow</span>
                </a>
                
                <a href="<?php echo home_url('/pro'); ?>" class="help-link">
                    <i class="fas fa-star"></i>
                    <span>Pro Features</span>
                </a>
                
                <a href="<?php echo home_url('/about'); ?>" class="help-link">
                    <i class="fas fa-info-circle"></i>
                    <span>About Us</span>
                </a>
                
                <a href="<?php echo home_url('/contact'); ?>" class="help-link">
                    <i class="fas fa-envelope"></i>
                    <span>Contact</span>
                </a>
            </div>
        </div>

        <div class="app-download">
            <h3>Download Our App</h3>
            <p>Get the full Grow Guide experience on your mobile device.</p>
            
            <div class="store-badges">
                <a href="<?php echo get_theme_mod('app_store_url', 'https://apps.apple.com/us/app/grow-guide/id6637720578'); ?>" target="_blank" rel="noopener">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/appstore.svg" alt="Download on App Store" class="store-badge" />
                </a>
                <a href="<?php echo get_theme_mod('google_play_url', 'https://play.google.com/store/apps/details?id=app.growguide'); ?>" target="_blank" rel="noopener">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/playstore.png" alt="Get it on Google Play" class="store-badge" />
                </a>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
