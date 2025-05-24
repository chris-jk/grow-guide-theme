<?php
/**
 * Search Results Template
 */

get_header(); ?>

<main class="site-main search-results">
    <div class="container">
        <header class="search-header">
            <h1 class="search-title">
                <?php
                printf(
                    esc_html__('Search Results for: %s', 'textdomain'),
                    '<span class="search-term">' . get_search_query() . '</span>'
                );
                ?>
            </h1>
            
            <?php if (have_posts()) : ?>
                <p class="search-count">
                    <?php
                    global $wp_query;
                    printf(
                        esc_html(_n('%s result found', '%s results found', $wp_query->found_posts, 'textdomain')),
                        number_format_i18n($wp_query->found_posts)
                    );
                    ?>
                </p>
            <?php endif; ?>
        </header>

        <?php if (have_posts()) : ?>
            <div class="search-results-list">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('search-result'); ?>>
                        <header class="entry-header">
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="entry-meta">
                                <span class="post-type"><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?></span>
                                <span class="post-date">
                                    <time datetime="<?php echo get_the_date('c'); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                </span>
                            </div>
                        </header>

                        <div class="entry-excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                        <footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                Read More
                            </a>
                        </footer>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '← Previous',
                'next_text' => 'Next →',
                'class'     => 'search-pagination'
            ));
            ?>

        <?php else : ?>
            <div class="no-results">
                <h2>Nothing Found</h2>
                <p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
                
                <div class="search-suggestions">
                    <h3>Search Suggestions:</h3>
                    <ul>
                        <li>Check your spelling</li>
                        <li>Try different keywords</li>
                        <li>Try more general keywords</li>
                        <li>Try fewer keywords</li>
                    </ul>
                </div>
                
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
