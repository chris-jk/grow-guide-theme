<?php
/**
 * Single Post Template
 */

get_header(); ?>

<main class="site-main single-post">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-article'); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    
                    <div class="entry-meta">
                        <span class="post-date">
                            <time datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                        </span>
                        <span class="post-author">
                            By <?php the_author(); ?>
                        </span>
                        <?php if (has_category()) : ?>
                            <span class="post-categories">
                                In <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <?php if (has_tag()) : ?>
                    <footer class="entry-footer">
                        <div class="post-tags">
                            <?php the_tags('<span class="tags-label">Tags:</span> ', ', '); ?>
                        </div>
                    </footer>
                <?php endif; ?>
            </article>

            <nav class="post-navigation">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>
                
                <?php if ($prev_post) : ?>
                    <div class="nav-previous">
                        <a href="<?php echo get_permalink($prev_post); ?>" class="nav-link">
                            <span class="nav-direction">← Previous</span>
                            <span class="nav-title"><?php echo get_the_title($prev_post); ?></span>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ($next_post) : ?>
                    <div class="nav-next">
                        <a href="<?php echo get_permalink($next_post); ?>" class="nav-link">
                            <span class="nav-direction">Next →</span>
                            <span class="nav-title"><?php echo get_the_title($next_post); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
            </nav>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
