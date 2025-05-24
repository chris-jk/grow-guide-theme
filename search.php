<?php get_header(); ?>

<div class="page-container">
    <div class="page-hero">
        <h1>Search Results</h1>
        <?php if (have_posts()): ?>
            <p>Found <?php echo $wp_query->found_posts; ?> results for: <strong>"<?php echo get_search_query(); ?>"</strong></p>
        <?php else: ?>
            <p>No results found for: <strong>"<?php echo get_search_query(); ?>"</strong></p>
        <?php endif; ?>
        
        <div class="search-form-container">
            <?php get_search_form(); ?>
        </div>
    </div>

    <div class="search-results">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="search-result">
                <h2 class="result-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>

                <div class="result-meta">
                    <span class="result-type">
                        <i class="fas fa-file"></i>
                        <?php echo get_post_type_object(get_post_type())->labels->singular_name; ?>
                    </span>
                    <span class="result-date">
                        <i class="fas fa-calendar"></i>
                        <?php echo get_the_date(); ?>
                    </span>
                </div>

                <div class="result-excerpt">
                    <?php the_excerpt(); ?>
                </div>

                <a href="<?php the_permalink(); ?>" class="result-link">
                    Read More <i class="fas fa-arrow-right"></i>
                </a>
            </article>
        <?php endwhile; 
        
        // Pagination
        // Pagination
        get_template_part('template-parts/pagination');
        
        else: ?>
            <div class="content-section">
                <h2>Try a Different Search</h2>
                <p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
                
                <div class="search-suggestions">
                    <h3>Search Suggestions:</h3>
                    <ul>
                        <li>Check your spelling</li>
                        <li>Try more general keywords</li>
                        <li>Try different keywords</li>
                        <li>Use fewer keywords</li>
                    </ul>
                </div>

                <div class="popular-content">
                    <h3>Popular Content:</h3>
                    <ul>
                        <li><a href="<?php echo home_url('/learn'); ?>">Learn to Grow</a></li>
                        <li><a href="<?php echo home_url('/about'); ?>">About Grow Guide</a></li>
                        <li><a href="<?php echo home_url('/pro'); ?>">Pro Features</a></li>
                        <li><a href="<?php echo home_url('/contact'); ?>">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>


<?php get_footer(); ?>
