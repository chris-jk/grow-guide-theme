<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<main id="primary" class="site-main single-post">
    <?php
    while (have_posts()):
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                <div class="entry-meta">
                    <?php
                    // Display post author and date
                    echo '<span class="posted-on">Posted on ' . get_the_date() . '</span>';
                    echo '<span class="byline"> by ' . get_the_author() . '</span>';
                    ?>
                </div>
            </header>

            <?php if (has_post_thumbnail()): ?>
                <div class="featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <footer class="entry-footer">
                <?php
                // Display categories and tags
                $categories_list = get_the_category_list(', ');
                if ($categories_list) {
                    echo '<span class="cat-links">Posted in ' . $categories_list . '</span>';
                }

                $tags_list = get_the_tag_list('', ', ');
                if ($tags_list) {
                    echo '<span class="tags-links">Tagged ' . $tags_list . '</span>';
                }
                ?>
            </footer>
        </article>

        <nav class="post-navigation">
            <div class="nav-previous"><?php previous_post_link('%link', '← Previous Guide'); ?></div>
            <div class="nav-next"><?php next_post_link('%link', 'Next Guide →'); ?></div>
        </nav>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()):
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>
</main>

<?php
get_sidebar();
get_footer();