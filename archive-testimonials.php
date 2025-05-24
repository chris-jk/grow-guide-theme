<?php
/**
 * Archive template for Testimonials post type
 *
 * @package Grow_Guide
 */

get_header(); ?>

<main id="primary" class="site-main container">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('User Testimonials', 'grow-guide'); ?></h1>
        <p class="archive-description">
            <?php esc_html_e('Read what our growing community has to say about their experience with our app.', 'grow-guide'); ?>
        </p>
    </header>

    <div class="testimonials-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <blockquote>
                            <?php the_content(); ?>
                        </blockquote>
                    </div>
                    
                    <div class="testimonial-author">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="author-avatar">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="author-info">
                            <?php
                            $author_name = get_post_meta(get_the_ID(), '_testimonial_author', true);
                            $author_title = get_post_meta(get_the_ID(), '_testimonial_title', true);
                            ?>
                            
                            <?php if ($author_name) : ?>
                                <h4 class="author-name"><?php echo esc_html($author_name); ?></h4>
                            <?php endif; ?>
                            
                            <?php if ($author_title) : ?>
                                <p class="author-title"><?php echo esc_html($author_title); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            
        <?php else : ?>
            <div class="no-testimonials">
                <h2><?php esc_html_e('No testimonials found', 'grow-guide'); ?></h2>
                <p><?php esc_html_e('Testimonials will be displayed here once they are added.', 'grow-guide'); ?></p>
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
