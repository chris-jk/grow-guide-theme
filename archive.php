<?php get_header(); ?>

<div class="archive-container">
    <div class="archive-hero">
        <h1>
            <?php
            if (is_category()) {
                echo 'Category: ' . single_cat_title('', false);
            } elseif (is_tag()) {
                echo 'Tag: ' . single_tag_title('', false);
            } elseif (is_author()) {
                echo 'Author: ' . get_the_author();
            } elseif (is_date()) {
                echo 'Archive: ' . get_the_date('F Y');
            } else {
                echo 'Blog Archive';
            }
            ?>
        </h1>
        <?php if (is_category() && category_description()): ?>
            <p><?php echo category_description(); ?></p>
        <?php endif; ?>
    </div>

    <div class="archive-posts">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="archive-post">
                <?php if (has_post_thumbnail()): ?>
                    <div class="archive-post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="archive-post-content">
                    <h2 class="archive-post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <div class="archive-post-meta">
                        <span class="post-date">
                            <i class="fas fa-calendar"></i>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="post-author">
                            <i class="fas fa-user"></i>
                            <?php the_author(); ?>
                        </span>
                    </div>

                    <div class="archive-post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="btn">
                        Read More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
        <?php endwhile; 
        
        // Pagination
        get_template_part('template-parts/pagination');
        
        else: ?>
            <div class="content-section">
                <h2>No posts found</h2>
                <p>Sorry, but no posts were found for this archive. Try searching for something else.</p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
