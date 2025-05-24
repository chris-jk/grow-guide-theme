<?php
/**
 * The template for displaying date archives
 *
 * @package Grow_Guide
 */

get_header(); ?>

<main id="primary" class="site-main container">
    <header class="page-header">
        <h1 class="page-title">
            <?php
            if (is_year()) {
                printf(esc_html__('Year: %s', 'grow-guide'), get_the_date('Y'));
            } elseif (is_month()) {
                printf(esc_html__('Month: %s', 'grow-guide'), get_the_date('F Y'));
            } elseif (is_day()) {
                printf(esc_html__('Day: %s', 'grow-guide'), get_the_date('F j, Y'));
            } else {
                esc_html_e('Archives', 'grow-guide');
            }
            ?>
        </h1>
    </header><!-- .page-header -->

    <div class="content-area">
        <?php if (have_posts()) : ?>
            <div class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-content">
                            <header class="entry-header">
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <i class="fas fa-calendar"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="posted-by">
                                        <i class="fas fa-user"></i>
                                        <?php the_author_posts_link(); ?>
                                    </span>
                                </div>
                            </header>
                            
                            <div class="entry-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                <?php esc_html_e('Read More', 'grow-guide'); ?>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <?php
            the_posts_navigation(array(
                'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Older posts', 'grow-guide'),
                'next_text' => __('Newer posts', 'grow-guide') . ' <i class="fas fa-chevron-right"></i>',
            ));
            ?>
            
        <?php else : ?>
            <div class="no-posts-found">
                <h2><?php esc_html_e('Nothing here', 'grow-guide'); ?></h2>
                <p><?php esc_html_e('It looks like nothing was found for this date. Maybe try a search?', 'grow-guide'); ?></p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</main><!-- #primary -->

<?php get_footer(); ?>
