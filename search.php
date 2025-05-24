<?php get_header(); ?>

<div class="search-container">
    <div class="search-header">
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
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => '<i class="fas fa-arrow-left"></i> Previous',
            'next_text' => 'Next <i class="fas fa-arrow-right"></i>',
        ));
        
        else: ?>
            <div class="no-results">
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

<style>
.search-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    padding-top: 100px;
}

.search-header {
    text-align: center;
    padding: 2rem;
    background: var(--card-bg);
    border-radius: 20px;
    margin-bottom: 3rem;
    backdrop-filter: blur(10px);
}

.search-header h1 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.search-form-container {
    margin-top: 2rem;
}

.search-form {
    display: flex;
    max-width: 400px;
    margin: 0 auto;
    gap: 1rem;
}

.search-field {
    flex: 1;
    padding: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    background: rgba(255, 255, 255, 0.1);
    color: var(--text-color);
    font-family: inherit;
}

.search-field:focus {
    outline: none;
    border-color: var(--primary-color);
}

.search-submit {
    padding: 1rem 2rem;
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: var(--transition);
}

.search-submit:hover {
    background: var(--primary-dark);
}

.search-results {
    space-y: 2rem;
}

.search-result {
    background: var(--card-bg);
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 2rem;
    backdrop-filter: blur(10px);
}

.result-title {
    margin-bottom: 1rem;
}

.result-title a {
    color: var(--text-color);
    text-decoration: none;
    transition: var(--transition);
}

.result-title a:hover {
    color: var(--primary-color);
}

.result-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.7);
}

.result-meta span {
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.result-excerpt {
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.result-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
}

.result-link:hover {
    color: var(--primary-light);
}

.no-results {
    background: var(--card-bg);
    padding: 3rem;
    border-radius: 20px;
    text-align: center;
    backdrop-filter: blur(10px);
}

.no-results h2 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.search-suggestions,
.popular-content {
    background: rgba(76, 175, 80, 0.1);
    padding: 2rem;
    border-radius: 15px;
    margin: 2rem 0;
    text-align: left;
}

.search-suggestions h3,
.popular-content h3 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.search-suggestions ul,
.popular-content ul {
    list-style: none;
    padding: 0;
}

.search-suggestions li,
.popular-content li {
    margin-bottom: 0.5rem;
    padding-left: 1rem;
    position: relative;
}

.search-suggestions li:before {
    content: "•";
    color: var(--primary-color);
    position: absolute;
    left: 0;
}

.popular-content a {
    color: var(--primary-color);
    text-decoration: none;
    transition: var(--transition);
}

.popular-content a:hover {
    color: var(--primary-light);
}

.navigation.pagination {
    margin-top: 3rem;
    text-align: center;
}

.page-numbers {
    display: inline-block;
    padding: 0.5rem 1rem;
    margin: 0 0.25rem;
    background: var(--card-bg);
    color: var(--text-color);
    text-decoration: none;
    border-radius: 5px;
    transition: var(--transition);
}

.page-numbers:hover,
.page-numbers.current {
    background: var(--primary-color);
    color: white;
}

@media (max-width: 768px) {
    .search-form {
        flex-direction: column;
    }
    
    .result-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>

<?php get_footer(); ?>
