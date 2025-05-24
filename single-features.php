<?php
/**
 * Single template for Features post type
 *
 * @package Grow_Guide
 */

get_header(); ?>

<main id="primary" class="site-main container">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-feature'); ?>>
            <header class="entry-header">
                <?php
                $icon_class = get_post_meta(get_the_ID(), '_feature_icon', true);
                if ($icon_class) :
                ?>
                    <div class="feature-icon-large">
                        <i class="<?php echo esc_attr($icon_class); ?>"></i>
                    </div>
                <?php endif; ?>
                
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <footer class="entry-footer">
                <div class="feature-navigation">
                    <div class="nav-links">
                        <?php
                        $prev_post = get_previous_post(false, '', 'features');
                        $next_post = get_next_post(false, '', 'features');
                        
                        if ($prev_post) :
                        ?>
                            <div class="nav-previous">
                                <a href="<?php echo get_permalink($prev_post); ?>" rel="prev">
                                    <i class="fas fa-chevron-left"></i>
                                    <?php echo esc_html($prev_post->post_title); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($next_post) : ?>
                            <div class="nav-next">
                                <a href="<?php echo get_permalink($next_post); ?>" rel="next">
                                    <?php echo esc_html($next_post->post_title); ?>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="back-to-features">
                    <a href="<?php echo get_post_type_archive_link('features'); ?>" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i>
                        <?php esc_html_e('Back to All Features', 'grow-guide'); ?>
                    </a>
                </div>
            </footer>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
