<?php
/**
 * Template Name: Learn (Blog Posts)
 * 
 * A custom page template that displays all blog posts
 * in a beautiful, modern layout.
 */

get_header(); ?>

<main class="site-main learn-page">
    <div class="container">
        <!-- Page Header -->
        <header class="page-header learn-header">
            <div class="page-header-content">
                <h1 class="page-title">
                    <span class="page-icon">📚</span>
                    Learn & Grow
                </h1>
                <p class="page-description">
                    Discover tips, guides, and expert advice to help you grow beautiful, healthy plants
                    and create the garden of your dreams.
                </p>
                
                <!-- Search Form -->
                <div class="learn-search">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </header>

        <!-- Featured Posts Section -->
        <?php
        $featured_posts = get_posts(array(
            'numberposts' => 3,
            'post_status' => 'publish',
            'meta_key' => '_featured_post',
            'meta_value' => '1'
        ));
        
        if (empty($featured_posts)) {
            // Fallback to latest 3 posts if no featured posts
            $featured_posts = get_posts(array(
                'numberposts' => 3,
                'post_status' => 'publish'
            ));
        }
        
        if (!empty($featured_posts)) : ?>
            <section class="featured-posts-section">
                <h2 class="section-title">Featured Articles</h2>
                <div class="featured-posts-grid">
                    <?php foreach ($featured_posts as $post) : setup_postdata($post); ?>
                        <article class="featured-post">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="featured-post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="featured-post-content">
                                <header class="featured-post-header">
                                    <?php if (has_category()) : ?>
                                        <div class="featured-post-category">
                                            <?php the_category(', '); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <h3 class="featured-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    
                                    <div class="featured-post-meta">
                                        <time datetime="<?php echo get_the_date('c'); ?>">
                                            <?php echo get_the_date(); ?>
                                        </time>
                                        <span class="reading-time">
                                            <?php echo generic_estimated_reading_time(get_the_content()); ?> min read
                                        </span>
                                    </div>
                                </header>
                                
                                <div class="featured-post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <footer class="featured-post-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                        Read Full Article
                                    </a>
                                </footer>
                            </div>
                        </article>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- Categories Filter -->
        <?php 
        $categories = get_categories(array(
            'hide_empty' => true,
            'number' => 8
        ));
        
        if (!empty($categories)) : ?>
            <section class="categories-filter">
                <h3 class="filter-title">Browse by Category</h3>
                <div class="categories-grid">
                    <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>" 
                       class="category-filter-item <?php echo is_home() ? 'active' : ''; ?>">
                        <span class="category-icon">📖</span>
                        <span class="category-name">All Posts</span>
                        <span class="category-count"><?php echo wp_count_posts()->publish; ?></span>
                    </a>
                    
                    <?php foreach ($categories as $category) : ?>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                           class="category-filter-item <?php echo is_category($category->term_id) ? 'active' : ''; ?>">
                            <span class="category-icon"><?php echo generic_get_category_icon($category->slug); ?></span>
                            <span class="category-name"><?php echo esc_html($category->name); ?></span>
                            <span class="category-count"><?php echo $category->count; ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- All Posts Section -->
        <section class="all-posts-section">
            <header class="posts-section-header">
                <h2 class="section-title">Latest Articles</h2>
                <div class="posts-view-toggle">
                    <button class="view-toggle active" data-view="grid">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <rect x="1" y="1" width="6" height="6" fill="currentColor"/>
                            <rect x="9" y="1" width="6" height="6" fill="currentColor"/>
                            <rect x="1" y="9" width="6" height="6" fill="currentColor"/>
                            <rect x="9" y="9" width="6" height="6" fill="currentColor"/>
                        </svg>
                        Grid
                    </button>
                    <button class="view-toggle" data-view="list">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <rect x="1" y="2" width="14" height="2" fill="currentColor"/>
                            <rect x="1" y="7" width="14" height="2" fill="currentColor"/>
                            <rect x="1" y="12" width="14" height="2" fill="currentColor"/>
                        </svg>
                        List
                    </button>
                </div>
            </header>

            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $posts_query = new WP_Query(array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 9,
                'paged' => $paged,
                'post__not_in' => wp_list_pluck($featured_posts, 'ID') // Exclude featured posts
            ));

            if ($posts_query->have_posts()) : ?>
                <div class="posts-container" data-view="grid">
                    <div class="posts-grid">
                        <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
                            <article <?php post_class('learn-post-item'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="post-content">
                                    <header class="post-header">
                                        <?php if (has_category()) : ?>
                                            <div class="post-category">
                                                <?php the_category(', '); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <h3 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        
                                        <div class="post-meta">
                                            <time datetime="<?php echo get_the_date('c'); ?>">
                                                <?php echo get_the_date(); ?>
                                            </time>
                                            <span class="reading-time">
                                                <?php echo generic_estimated_reading_time(get_the_content()); ?> min read
                                            </span>
                                        </div>
                                    </header>

                                    <div class="post-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <footer class="post-footer">
                                        <a href="<?php the_permalink(); ?>" class="read-more-link">
                                            Continue Reading →
                                        </a>
                                    </footer>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                </div>

                <!-- Pagination -->
                <?php
                $pagination = paginate_links(array(
                    'total' => $posts_query->max_num_pages,
                    'current' => $paged,
                    'format' => '?paged=%#%',
                    'show_all' => false,
                    'type' => 'array',
                    'end_size' => 2,
                    'mid_size' => 1,
                    'prev_next' => true,
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
                    'add_args' => false,
                    'add_fragment' => '',
                ));

                if ($pagination) : ?>
                    <nav class="learn-pagination" aria-label="Posts navigation">
                        <ul class="pagination-list">
                            <?php foreach ($pagination as $key => $page_link) : ?>
                                <li class="pagination-item">
                                    <?php echo $page_link; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            <?php else : ?>
                <div class="no-posts">
                    <div class="no-posts-icon">📝</div>
                    <h3>No Posts Found</h3>
                    <p>We're working on creating amazing content for you. Check back soon!</p>
                </div>
            <?php endif; 
            
            wp_reset_postdata(); ?>
        </section>
    </div>
</main>

<script>
// View toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const viewToggles = document.querySelectorAll('.view-toggle');
    const postsContainer = document.querySelector('.posts-container');
    
    viewToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const view = this.dataset.view;
            
            // Update active state
            viewToggles.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Update container view
            if (postsContainer) {
                postsContainer.dataset.view = view;
            }
        });
    });
});
</script>

<?php get_footer(); ?>
