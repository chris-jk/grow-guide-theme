<?php get_header(); ?>

<div class="error-404-container">
    <div class="error-content">
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
            <a href="<?php echo home_url('/'); ?>" class="btn btn-primary">
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

<style>
.error-404-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    padding-top: 100px;
    text-align: center;
}

.error-content {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 3rem;
    backdrop-filter: blur(10px);
}

.error-visual {
    position: relative;
    margin-bottom: 2rem;
}

.error-code {
    font-size: 8rem;
    font-weight: bold;
    color: var(--primary-color);
    margin: 0;
    opacity: 0.3;
    position: relative;
}

.error-plant {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 4rem;
    color: var(--primary-color);
    animation: sway 3s ease-in-out infinite;
}

@keyframes sway {
    0%, 100% { transform: translate(-50%, -50%) rotate(-5deg); }
    50% { transform: translate(-50%, -50%) rotate(5deg); }
}

.error-text h2 {
    color: var(--primary-color);
    margin-bottom: 1rem;
    font-size: 2.5rem;
}

.error-text p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.error-actions {
    margin: 3rem 0;
}

.btn {
    display: inline-block;
    background: var(--primary-color);
    color: white;
    padding: 1rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
    margin-bottom: 2rem;
}

.btn:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

.search-form-container h3 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.search-form {
    display: flex;
    max-width: 400px;
    margin: 0 auto;
    gap: 1rem;
}

.search-field {
    flex: 1;
    padding: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    background: rgba(255, 255, 255, 0.1);
    color: var(--text-color);
    font-family: inherit;
}

.search-field:focus {
    outline: none;
    border-color: var(--primary-color);
}

.search-submit {
    padding: 1rem 2rem;
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: var(--transition);
}

.search-submit:hover {
    background: var(--primary-dark);
}

.helpful-links {
    margin: 3rem 0;
    padding: 2rem 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.helpful-links h3 {
    color: var(--primary-color);
    margin-bottom: 2rem;
}

.links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.help-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1.5rem;
    background: rgba(76, 175, 80, 0.1);
    border-radius: 15px;
    text-decoration: none;
    color: var(--text-color);
    transition: var(--transition);
}

.help-link:hover {
    background: rgba(76, 175, 80, 0.2);
    transform: translateY(-3px);
}

.help-link i {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.help-link span {
    font-weight: 500;
}

.app-download {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.app-download h3 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.app-download p {
    margin-bottom: 2rem;
}

.store-badges {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.store-badge {
    height: 60px;
    transition: var(--transition);
}

.store-badge:hover {
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .error-code {
        font-size: 6rem;
    }
    
    .error-plant {
        font-size: 3rem;
    }
    
    .error-text h2 {
        font-size: 2rem;
    }
    
    .search-form {
        flex-direction: column;
    }
    
    .links-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .store-badges {
        flex-direction: column;
        align-items: center;
    }
}
</style>

<?php get_footer(); ?>
