<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero">
    <?php 
    $hero_video = get_theme_mod('hero_video');
    if ($hero_video): ?>
        <video class="hero-video" autoplay muted loop playsinline>
            <source src="<?php echo esc_url($hero_video); ?>" type="video/mp4" />
        </video>
    <?php else: ?>
        <video class="hero-video" autoplay muted loop playsinline>
            <source src="<?php echo get_template_directory_uri(); ?>/assets/video/starie.mp4" type="video/mp4" />
        </video>
    <?php endif; ?>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <h1 class="hero-title"><?php echo get_theme_mod('hero_title', 'Master Your Cultivation Journey!!!'); ?></h1>
        <p class="hero-subtitle">
            <?php echo get_theme_mod('hero_subtitle', 'Track your grows, connect with expert growers, and get AI-powered recommendations for successful cultivation.'); ?>
        </p>

        <div class="store-badges">
            <a href="<?php echo get_theme_mod('app_store_url', 'https://apps.apple.com/us/app/grow-guide/id6637720578'); ?>" target="_blank" rel="noopener">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/appstore.svg" alt="Download on App Store" class="store-badge" />
            </a>
            <a href="<?php echo get_theme_mod('google_play_url', 'https://play.google.com/store/apps/details?id=app.growguide'); ?>" target="_blank" rel="noopener">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/playstore.png" alt="Get it on Google Play" class="store-badge" />
            </a>
        </div>

        <div class="hero-features">
            <div class="feature-item">
                <i class="fas fa-seedling"></i>
                <span>Track Your Grows</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-users"></i>
                <span>Expert Community</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-robot"></i>
                <span>AI Recommendations</span>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="section features">
    <div class="container">
        <div class="section-title">
            <h2>Powerful Features</h2>
            <p>Everything you need to master your cultivation journey</p>
        </div>

        <div class="features-grid">
            <?php
            $features_query = new WP_Query(array(
                'post_type' => 'features',
                'posts_per_page' => 6,
                'post_status' => 'publish'
            ));

            if ($features_query->have_posts()): 
                while ($features_query->have_posts()): $features_query->the_post(); ?>
                    <div class="feature-card">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="feature-icon">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                        <?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                        <p><?php the_excerpt(); ?></p>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else: 
                // Default features if no posts exist
                $default_features = array(
                    array('icon' => 'fas fa-seedling', 'title' => 'Smart Tracking', 'description' => 'Track your plants with precision timing and detailed logs.'),
                    array('icon' => 'fas fa-chart-line', 'title' => 'Growth Analytics', 'description' => 'Visualize your progress with detailed charts and insights.'),
                    array('icon' => 'fas fa-users', 'title' => 'Community', 'description' => 'Connect with expert growers and share experiences.'),
                    array('icon' => 'fas fa-robot', 'title' => 'AI Assistant', 'description' => 'Get personalized recommendations powered by AI.'),
                    array('icon' => 'fas fa-calendar-alt', 'title' => 'Schedule Reminders', 'description' => 'Never miss important care tasks with smart notifications.'),
                    array('icon' => 'fas fa-trophy', 'title' => 'Achievement System', 'description' => 'Unlock achievements and track your growing milestones.')
                );

                foreach ($default_features as $feature): ?>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="<?php echo $feature['icon']; ?>"></i>
                        </div>
                        <h3><?php echo $feature['title']; ?></h3>
                        <p><?php echo $feature['description']; ?></p>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- Tools Section -->
<section id="tools" class="section tools">
    <div class="container">
        <div class="section-title">
            <h2>Essential Tools</h2>
            <p>Professional-grade tools for serious growers</p>
        </div>

        <div class="tools-grid">
            <div class="tool-card">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/actions.png" alt="Growth Tracking" />
                <h3>Growth Tracking</h3>
                <p>Monitor every stage of your plant's development with detailed logging and photo documentation.</p>
            </div>

            <div class="tool-card">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stats.png" alt="Analytics Dashboard" />
                <h3>Analytics Dashboard</h3>
                <p>Comprehensive analytics to help you understand what works best for your growing environment.</p>
            </div>

            <div class="tool-card">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ai.png" alt="AI Recommendations" />
                <h3>AI Recommendations</h3>
                <p>Get personalized advice based on your specific growing conditions and plant varieties.</p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="section how-it-works">
    <div class="container">
        <div class="section-title">
            <h2>How It Works</h2>
            <p>Simple steps to growing success</p>
        </div>

        <div class="steps-container">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Download & Setup</h3>
                <p>Download the app and create your growing profile in minutes.</p>
            </div>

            <div class="step">
                <div class="step-number">2</div>
                <h3>Track Your Grows</h3>
                <p>Log your plants, track progress, and document your journey.</p>
            </div>

            <div class="step">
                <div class="step-number">3</div>
                <h3>Get AI Insights</h3>
                <p>Receive personalized recommendations to optimize your results.</p>
            </div>

            <div class="step">
                <div class="step-number">4</div>
                <h3>Connect & Learn</h3>
                <p>Join the community and learn from experienced growers.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="section testimonials">
    <div class="container">
        <div class="section-title">
            <h2>What Growers Say</h2>
            <p>Real feedback from our growing community</p>
        </div>

        <div class="testimonials-grid">
            <?php
            $testimonials_query = new WP_Query(array(
                'post_type' => 'testimonials',
                'posts_per_page' => 3,
                'post_status' => 'publish'
            ));

            if ($testimonials_query->have_posts()): 
                while ($testimonials_query->have_posts()): $testimonials_query->the_post();
                    $author = get_post_meta(get_the_ID(), '_testimonial_author', true);
                    $rating = get_post_meta(get_the_ID(), '_testimonial_rating', true);
                ?>
                    <div class="testimonial-card">
                        <div class="stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?php echo $i <= $rating ? 'active' : ''; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p><?php the_content(); ?></p>
                        <div class="testimonial-author">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('thumbnail', array('class' => 'author-avatar')); ?>
                            <?php endif; ?>
                            <strong><?php echo $author ? $author : get_the_title(); ?></strong>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else: 
                // Default testimonials
                $default_testimonials = array(
                    array(
                        'rating' => 5,
                        'content' => 'This app completely transformed my growing experience. The AI recommendations are spot on!',
                        'author' => 'Sarah M.'
                    ),
                    array(
                        'rating' => 5,
                        'content' => 'Love the community aspect. Learning from experienced growers has been invaluable.',
                        'author' => 'Mike R.'
                    ),
                    array(
                        'rating' => 4,
                        'content' => 'Great tracking features and the analytics help me optimize my grows perfectly.',
                        'author' => 'Jenny L.'
                    )
                );

                foreach ($default_testimonials as $testimonial): ?>
                    <div class="testimonial-card">
                        <div class="stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?php echo $i <= $testimonial['rating'] ? 'active' : ''; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p><?php echo $testimonial['content']; ?></p>
                        <div class="testimonial-author">
                            <strong><?php echo $testimonial['author']; ?></strong>
                        </div>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- Pro Features Section -->
<section id="pro" class="section pro-features">
    <div class="container">
        <div class="section-title">
            <h2>Pro Features</h2>
            <p>Unlock advanced capabilities for serious growers</p>
        </div>

        <div class="pro-content">
            <div class="pro-features-list">
                <div class="pro-feature">
                    <i class="fas fa-chart-pie"></i>
                    <div>
                        <h3>Advanced Analytics</h3>
                        <p>Deep insights into your growing patterns and optimization opportunities.</p>
                    </div>
                </div>

                <div class="pro-feature">
                    <i class="fas fa-cloud"></i>
                    <div>
                        <h3>Cloud Backup</h3>
                        <p>Secure cloud storage for all your growing data and photos.</p>
                    </div>
                </div>

                <div class="pro-feature">
                    <i class="fas fa-users-cog"></i>
                    <div>
                        <h3>Expert Support</h3>
                        <p>Direct access to growing experts for personalized advice.</p>
                    </div>
                </div>

                <div class="pro-feature">
                    <i class="fas fa-infinity"></i>
                    <div>
                        <h3>Unlimited Grows</h3>
                        <p>Track unlimited plants and growing projects simultaneously.</p>
                    </div>
                </div>
            </div>

            <div class="pro-cta">
                <a href="<?php echo home_url('/pro-members'); ?>" class="btn btn-primary">Learn More</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
