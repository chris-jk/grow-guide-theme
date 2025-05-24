<?php get_header(); ?>

<?php if (is_front_page()): ?>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title"><?php echo esc_html(get_theme_mod('app_name', 'Grow Guide')); ?></h1>
                <p class="hero-subtitle">Your ultimate companion for growing healthy plants and creating beautiful gardens.</p>
                
                <?php if (get_theme_mod('show_app_download', true)): ?>
                <div class="app-download-section">
                    <h2 class="download-title">Download the App</h2>
                    
                    <!-- Mobile: Show download buttons -->
                    <div class="download-buttons mobile-only">
                        <a href="#" class="app-store-btn" id="app-store-link">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiB2aWV3Qm94PSIwIDAgMTIwIDQwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iNDAiIHJ4PSI4IiBmaWxsPSIjMDAwIi8+PHRleHQgeD0iNjAiIHk9IjI1IiBmaWxsPSJ3aGl0ZSIgZm9udC1zaXplPSIxNCIgdGV4dC1hbmNob3I9Im1pZGRsZSI+QXBwIFN0b3JlPC90ZXh0Pjwvc3ZnPg==" alt="Download on App Store">
                        </a>
                        <a href="#" class="google-play-btn" id="google-play-link">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiB2aWV3Qm94PSIwIDAgMTIwIDQwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iNDAiIHJ4PSI4IiBmaWxsPSIjMDE4NzVGIi8+PHRleHQgeD0iNjAiIHk9IjI1IiBmaWxsPSJ3aGl0ZSIgZm9udC1zaXplPSIxNCIgdGV4dC1hbmNob3I9Im1pZGRsZSI+R29vZ2xlIFBsYXk8L3RleHQ+PC9zdmc+" alt="Get it on Google Play">
                        </a>
                    </div>
                    
                    <!-- Desktop: Show QR code -->
                    <div class="qr-code-section desktop-only">
                        <div class="qr-code-container">
                            <div class="qr-code" id="qr-code">
                                <!-- QR code will be generated here -->
                                <div class="qr-placeholder">
                                    <svg width="150" height="150" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="150" height="150" fill="#f0f0f0" rx="8"/>
                                        <text x="75" y="80" text-anchor="middle" font-size="12" fill="#666">QR Code</text>
                                    </svg>
                                </div>
                            </div>
                            <p class="qr-instructions">Scan with your phone to download the app</p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">Features</h2>
            <div class="features-grid">
                <?php 
                $features = get_homepage_features();
                if (!empty($features)): 
                    foreach ($features as $feature): ?>
                        <div class="feature-item">
                            <?php if (!empty($feature['icon'])): ?>
                                <div class="feature-icon"><?php echo esc_html($feature['icon']); ?></div>
                            <?php endif; ?>
                            <h3><?php echo esc_html($feature['title']); ?></h3>
                            <p><?php echo esc_html($feature['description']); ?></p>
                        </div>
                    <?php endforeach;
                else: ?>
                    <!-- Default features if none are set -->
                    <div class="feature-item">
                        <div class="feature-icon">🌱</div>
                        <h3>Plant Care Guide</h3>
                        <p>Get personalized care instructions for your plants</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">💧</div>
                        <h3>Watering Reminders</h3>
                        <p>Never forget to water your plants again</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🏡</div>
                        <h3>Garden Planning</h3>
                        <p>Plan and design your perfect garden space</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php else: ?>
    <!-- Blog/Posts Content -->
    <main class="site-main blog-content">
        <div class="container">
            <?php if (have_posts()): ?>
                <div class="posts-grid">
                    <?php while (have_posts()): the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
                            <?php if (has_post_thumbnail()): ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('archive-thumbnail'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    
                                    <div class="entry-meta">
                                        <span class="post-date">
                                            <time datetime="<?php echo get_the_date('c'); ?>">
                                                <?php echo get_the_date(); ?>
                                            </time>
                                        </span>
                                        <span class="post-author">
                                            By <?php the_author(); ?>
                                        </span>
                                        <?php if (has_category()): ?>
                                            <span class="post-categories">
                                                <?php the_category(', '); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </header>
                                
                                <div class="entry-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                        Read More
                                    </a>
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <?php
                // Pagination
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
                    'class'     => 'blog-pagination'
                ));
                ?>
                
            <?php else: ?>
                <div class="no-posts">
                    <h2>No Posts Found</h2>
                    <p>It looks like there are no posts to display. Check back later for new content!</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
<?php endif; ?>

<?php get_footer(); ?>
