<?php
/**
 * The template for displaying the front page
 */

get_header(); ?>

<main id="primary" class="site-main front-page">
    <section class="hero">
        <div class="container">
            <h1><?php echo get_theme_mod('front_page_heading', 'Welcome to Grow Guide'); ?></h1>
            <p class="hero-description">
                <?php echo get_theme_mod('front_page_description', 'Your complete guide to growing plants successfully'); ?>
            </p>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-primary">View
                Guides</a>
        </div>
    </section>

    <section class="featured-guides">
        <div class="container">
            <h2>Featured Growing Guides</h2>
            <div class="guides-grid">
                <?php
                // Query for featured posts
                $featured_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'meta_key' => 'featured_post',
                    'meta_value' => '1'
                ));

                if ($featured_query->have_posts()):
                    while ($featured_query->have_posts()):
                        $featured_query->the_post();
                        ?>
                        <div class="guide-card">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="guide-image">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="guide-content">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="guide-excerpt"><?php the_excerpt(); ?></div>
                                <a href="<?php the_permalink(); ?>" class="read-more">Read Full Guide</a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<p>No featured guides found.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();