<?php get_header(); ?>

<div class="single-container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="single-post">
            <header class="post-header">
                <h1 class="post-title"><?php the_title(); ?></h1>
                <div class="post-meta">
                    <span class="post-date">
                        <i class="fas fa-calendar"></i>
                        <?php echo get_the_date(); ?>
                    </span>
                    <span class="post-author">
                        <i class="fas fa-user"></i>
                        <?php the_author(); ?>
                    </span>
                    <?php if (has_category()): ?>
                        <span class="post-categories">
                            <i class="fas fa-folder"></i>
                            <?php the_category(', '); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </header>

            <?php if (has_post_thumbnail()): ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="post-content">
                <?php the_content(); ?>
            </div>

            <footer class="post-footer">
                <?php if (has_tag()): ?>
                    <div class="post-tags">
                        <strong>Tags:</strong>
                        <?php the_tags('', ', '); ?>
                    </div>
                <?php endif; ?>

                <div class="post-navigation">
                    <div class="nav-previous">
                        <?php previous_post_link('%link', '<i class="fas fa-arrow-left"></i> Previous Post'); ?>
                    </div>
                    <div class="nav-next">
                        <?php next_post_link('%link', 'Next Post <i class="fas fa-arrow-right"></i>'); ?>
                    </div>
                </div>
            </footer>

            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="comments-section">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
        </article>
    <?php endwhile; endif; ?>
</div>

<style>
.single-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    padding-top: 100px;
}

.single-post {
    background: var(--card-bg);
    border-radius: 20px;
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.post-header {
    padding: 2rem;
    text-align: center;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
}

.post-title {
    margin-bottom: 1rem;
    font-size: 2.5rem;
}

.post-meta {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
    opacity: 0.9;
}

.post-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.post-thumbnail {
    line-height: 0;
}

.post-thumbnail img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.post-content {
    padding: 2rem;
    line-height: 1.8;
}

.post-content h2,
.post-content h3,
.post-content h4 {
    color: var(--primary-color);
    margin: 2rem 0 1rem 0;
}

.post-content p {
    margin-bottom: 1.5rem;
}

.post-content ul,
.post-content ol {
    margin: 1rem 0 1.5rem 2rem;
}

.post-content li {
    margin-bottom: 0.5rem;
}

.post-footer {
    padding: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.post-tags {
    margin-bottom: 2rem;
    padding: 1rem;
    background: rgba(76, 175, 80, 0.1);
    border-radius: 10px;
}

.post-tags a {
    color: var(--primary-color);
    text-decoration: none;
}

.post-tags a:hover {
    color: var(--primary-light);
}

.post-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.post-navigation a {
    color: var(--primary-color);
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    transition: var(--transition);
}

.post-navigation a:hover {
    background: var(--primary-color);
    color: white;
}

.comments-section {
    padding: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

@media (max-width: 768px) {
    .post-meta {
        flex-direction: column;
        gap: 1rem;
    }
    
    .post-navigation {
        flex-direction: column;
        gap: 1rem;
    }
}

/* Dark theme styles */
@media (prefers-color-scheme: dark) {
    .single-post {
        background: rgba(30, 30, 30, 0.9);
        color: #e0e0e0;
    }
    
    .post-content {
        color: #e0e0e0;
    }
    
    .post-content h2,
    .post-content h3,
    .post-content h4 {
        color: var(--primary-light, #81c784);
    }
    
    .post-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .comments-section {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .post-tags {
        background: rgba(76, 175, 80, 0.2);
        color: #e0e0e0;
    }
}
</style>

<?php get_footer(); ?>
