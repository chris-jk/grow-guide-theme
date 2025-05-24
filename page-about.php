<?php
/*
Template Name: About Page
*/
get_header(); ?>

<div class="about-container">
    <div class="about-hero">
        <h1>About Grow Guide</h1>
        <p>Empowering growers with technology and community</p>
    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="about-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; endif; ?>

    <!-- Default content if no page content exists -->
    <?php if (!have_posts() || !get_the_content()): ?>
        <div class="about-content">
            <div class="about-section">
                <h2>Our Mission</h2>
                <p>
                    At Grow Guide, we believe that successful cultivation should be accessible to everyone. 
                    Our mission is to democratize growing knowledge by combining cutting-edge technology 
                    with the wisdom of experienced cultivators.
                </p>
            </div>

            <div class="about-section">
                <h2>What We Do</h2>
                <p>
                    We've created a comprehensive platform that serves as your personal growing assistant. 
                    From tracking your plants' progress to connecting you with a community of expert growers, 
                    Grow Guide is designed to help you achieve the best possible results.
                </p>
            </div>

            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>Innovation</h3>
                    <p>We continuously innovate to bring you the latest in growing technology and AI-powered insights.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Community</h3>
                    <p>We foster a supportive community where growers of all levels can learn and share experiences.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Results</h3>
                    <p>We're committed to helping you achieve measurable improvements in your growing success.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Trust</h3>
                    <p>We prioritize your privacy and data security while providing reliable, accurate information.</p>
                </div>
            </div>

            <div class="about-section">
                <h2>Our Team</h2>
                <p>
                    Our team combines decades of growing experience with expertise in mobile development, 
                    AI, and data science. We're passionate growers ourselves, and we understand the challenges 
                    and rewards of cultivation.
                </p>
            </div>

            <div class="about-section">
                <h2>Join Our Community</h2>
                <p>
                    Ready to take your growing to the next level? Download Grow Guide today and join 
                    thousands of successful growers who trust our platform for their cultivation journey.
                </p>
                
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
    <?php endif; ?>
</div>

<style>
.about-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    padding-top: 100px;
}

.about-hero {
    text-align: center;
    padding: 6rem 2rem;
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
        url("https://images.unsplash.com/photo-1520412099551-62b6bafeb5bb?ixlib=rb-4.0.3") center/cover;
    color: white;
    border-radius: 20px;
    margin: 0 0 3rem 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.about-section {
    margin: 3rem 0;
    background: var(--card-bg);
    padding: 2rem;
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.about-section h2 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.value-card {
    background: var(--card-bg);
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    backdrop-filter: blur(10px);
    transition: var(--transition);
}

.value-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(76, 175, 80, 0.2);
}

.value-icon {
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.value-card h3 {
    margin-bottom: 1rem;
    color: var(--primary-color);
}

.store-badges {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.store-badge {
    height: 60px;
    transition: var(--transition);
}

.store-badge:hover {
    transform: scale(1.05);
}
</style>

<?php get_footer(); ?>
