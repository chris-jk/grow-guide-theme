<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()):
            the_title('<h1 class="entry-title">', '</h1>');
        else:
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type()):
            ?>
            <div class="entry-meta">
                <span class="posted-on"><?php echo get_the_date(); ?></span>
                <span class="byline"> by <?php the_author(); ?></span>
            </div>
        <?php endif; ?>
    </header>

    <?php if (has_post_thumbnail() && !is_singular()): ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if (is_singular()):
            the_content();
        else:
            the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
        <?php endif; ?>
    </div>

    <footer class="entry-footer">
        <?php
        if ('post' === get_post_type()) {
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                echo '<span class="cat-links">Posted in ' . $categories_list . '</span>';
            }

            $tags_list = get_the_tag_list('', ', ');
            if ($tags_list) {
                echo '<span class="tags-links">Tagged ' . $tags_list . '</span>';
            }
        }
        ?>
    </footer>
</article>