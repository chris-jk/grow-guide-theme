<?php
/**
 * Archive template for Features post type
 *
 * @package Grow_Guide
 */

get_header(); ?>

<main id="primary" class="site-main container">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('App Features', 'grow-guide'); ?></h1>
        <p class="archive-description">
            <?php esc_html_e('Discover all the amazing features that make our cultivation app the perfect growing companion.', 'grow-guide'); ?>
        </p>
    </header>

    <div class="features-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="feature-card">
                    <?php
                    $icon_class = get_post_meta(get_the_ID(), '_feature_icon', true);
                    if ($icon_class) :
                    ?>
                        <div class="feature-icon">
                            <i class="<?php echo esc_attr($icon_class); ?>"></i>
                        </div>
                    <?php endif; ?>
                    
                    <h3 class="feature-title"><?php the_title(); ?></h3>
                    <div class="feature-description">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endwhile; ?>
            
        <?php else : ?>
            <div class="no-features">
                <h2><?php esc_html_e('No features found', 'grow-guide'); ?></h2>
                <p><?php esc_html_e('Features will be displayed here once they are added.', 'grow-guide'); ?></p>
            </div>
        <?php endif; ?>
    </div>
    
    <?php
    the_posts_navigation(array(
        'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Previous', 'grow-guide'),
        'next_text' => __('Next', 'grow-guide') . ' <i class="fas fa-chevron-right"></i>',
    ));
    ?>
</main>

<?php get_footer(); ?>
