<?php
/**
 * Single template for Testimonials post type
 *
 * @package Grow_Guide
 */

get_header(); ?>

<main id="primary" class="site-main container">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-testimonial'); ?>>
            <div class="testimonial-content-large">
                <blockquote class="testimonial-quote">
                    <?php the_content(); ?>
                </blockquote>
                
                <div class="testimonial-author-large">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="author-avatar-large">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="author-details">
                        <?php
                        $author_name = get_post_meta(get_the_ID(), '_testimonial_author', true);
                        $author_title = get_post_meta(get_the_ID(), '_testimonial_title', true);
                        ?>
                        
                        <?php if ($author_name) : ?>
                            <h2 class="author-name"><?php echo esc_html($author_name); ?></h2>
                        <?php endif; ?>
                        
                        <?php if ($author_title) : ?>
                            <p class="author-title"><?php echo esc_html($author_title); ?></p>
                        <?php endif; ?>
                        
                        <div class="testimonial-date">
                            <i class="fas fa-calendar"></i>
                            <?php echo get_the_date(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="entry-footer">
                <div class="testimonial-navigation">
                    <div class="nav-links">
                        <?php
                        $prev_post = get_previous_post(false, '', 'testimonials');
                        $next_post = get_next_post(false, '', 'testimonials');
                        
                        if ($prev_post) :
                        ?>
                            <div class="nav-previous">
                                <a href="<?php echo get_permalink($prev_post); ?>" rel="prev">
                                    <i class="fas fa-chevron-left"></i>
                                    <?php esc_html_e('Previous Testimonial', 'grow-guide'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($next_post) : ?>
                            <div class="nav-next">
                                <a href="<?php echo get_permalink($next_post); ?>" rel="next">
                                    <?php esc_html_e('Next Testimonial', 'grow-guide'); ?>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="back-to-testimonials">
                    <a href="<?php echo get_post_type_archive_link('testimonials'); ?>" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i>
                        <?php esc_html_e('Back to All Testimonials', 'grow-guide'); ?>
                    </a>
                </div>
            </footer>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
