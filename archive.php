<?php get_header(); ?>

<div class="archive-container">
    <div class="archive-header">
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

    <div class="posts-grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="post-card">
                <?php if (has_post_thumbnail()): ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="post-card-content">
                    <h2 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <div class="post-meta">
                        <span class="post-date">
                            <i class="fas fa-calendar"></i>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="post-author">
                            <i class="fas fa-user"></i>
                            <?php the_author(); ?>
                        </span>
                    </div>

                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="read-more">
                        Read More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
        <?php endwhile; 
        
        // Pagination
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => '<i class="fas fa-arrow-left"></i> Previous',
            'next_text' => 'Next <i class="fas fa-arrow-right"></i>',
        ));
        
        else: ?>
            <div class="no-posts">
                <h2>No posts found</h2>
                <p>Sorry, but no posts were found for this archive. Try searching for something else.</p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.archive-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    padding-top: 100px;
}

.archive-header {
    text-align: center;
    padding: 3rem 2rem;
    background: var(--card-bg);
    border-radius: 20px;
    margin-bottom: 3rem;
    backdrop-filter: blur(10px);
}

.archive-header h1 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
}

.post-card {
    background: var(--card-bg);
    border-radius: 15px;
    overflow: hidden;
    transition: var(--transition);
    backdrop-filter: blur(10px);
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(76, 175, 80, 0.2);
}

.post-thumbnail {
    line-height: 0;
}

.post-thumbnail img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: var(--transition);
}

.post-thumbnail:hover img {
    transform: scale(1.05);
}

.post-card-content {
    padding: 1.5rem;
}

.post-title {
    margin-bottom: 1rem;
}

.post-title a {
    color: var(--text-color);
    text-decoration: none;
    transition: var(--transition);
}

.post-title a:hover {
    color: var(--primary-color);
}

.post-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.7);
}

.post-meta span {
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.post-excerpt {
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.read-more {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
}

.read-more:hover {
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

.no-posts {
    grid-column: 1 / -1;
    text-align: center;
    padding: 3rem;
    background: var(--card-bg);
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.no-posts h2 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .posts-grid {
        grid-template-columns: 1fr;
    }
    
    .post-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>

<?php get_footer(); ?>
