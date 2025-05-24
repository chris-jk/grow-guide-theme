<?php
/**
 * 404 Error Page Template
 */

get_header(); ?>

<main class="site-main error-404">
    <div class="container">
        <div class="error-content">
            <div class="error-visual">
                <div class="error-number">404</div>
                <div class="error-icon">🌱</div>
            </div>
            
            <header class="error-header">
                <h1 class="error-title">Oops! Page Not Found</h1>
                <p class="error-description">
                    The page you're looking for seems to have wandered off into the garden. 
                    Don't worry, we'll help you find your way back!
                </p>
            </header>

            <div class="error-actions">
                <div class="search-section">
                    <h2>Try Searching</h2>
                    <p>Maybe you can find what you're looking for with a search:</p>
                    <?php get_search_form(); ?>
                </div>

                <div class="navigation-section">
                    <h2>Quick Links</h2>
                    <ul class="quick-links">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>" class="home-link">🏠 Go Home</a></li>
                        <li><a href="<?php echo esc_url(home_url('/blog')); ?>" class="blog-link">📝 Visit Blog</a></li>
                        <li><a href="mailto:<?php echo get_option('admin_email'); ?>" class="contact-link">📧 Contact Us</a></li>
                    </ul>
                </div>

                <?php
                // Show recent posts if available
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 3,
                    'post_status' => 'publish'
                ));
                
                if (!empty($recent_posts)) : ?>
                    <div class="recent-posts-section">
                        <h2>Recent Posts</h2>
                        <ul class="recent-posts-list">
                            <?php foreach ($recent_posts as $post) : ?>
                                <li>
                                    <a href="<?php echo get_permalink($post['ID']); ?>">
                                        <?php echo esc_html($post['post_title']); ?>
                                    </a>
                                    <span class="post-date"><?php echo get_the_date('', $post['ID']); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
