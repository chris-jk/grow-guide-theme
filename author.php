<?php
/**
 * The template for displaying author archives
 *
 * @package Grow_Guide
 */

get_header(); ?>

<main id="primary" class="site-main container">
    <header class="page-header author-header">
        <?php $author = get_queried_object(); ?>
        
        <div class="author-info">
            <?php echo get_avatar($author->ID, 120, '', '', array('class' => 'author-avatar')); ?>
            
            <div class="author-details">
                <h1 class="page-title author-title">
                    <?php
                    printf(esc_html__('Posts by %s', 'grow-guide'), get_the_author());
                    ?>
                </h1>
                
                <?php if (!empty($author->description)) : ?>
                    <div class="author-description">
                        <p><?php echo wp_kses_post($author->description); ?></p>
                    </div>
                <?php endif; ?>
                
                <div class="author-meta">
                    <span class="post-count">
                        <i class="fas fa-edit"></i>
                        <?php
                        printf(
                            _n('%s post', '%s posts', get_the_author_posts(), 'grow-guide'),
                            number_format_i18n(get_the_author_posts())
                        );
                        ?>
                    </span>
                </div>
            </div>
        </div>
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
                                    <span class="comments-count">
                                        <i class="fas fa-comments"></i>
                                        <?php comments_number('0 comments', '1 comment', '% comments'); ?>
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
                <p><?php esc_html_e('This author hasn\'t published any posts yet.', 'grow-guide'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main><!-- #primary -->

<?php get_footer(); ?>
