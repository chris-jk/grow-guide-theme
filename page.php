<?php get_header(); ?>

<div class="page-container">
    <div class="page-hero">
        <h1><?php the_title(); ?></h1>
        <?php if (has_excerpt()): ?>
            <p><?php the_excerpt(); ?></p>
        <?php endif; ?>
    </div>

    <div class="page-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="page-article">
                <?php the_content(); ?>
                
                <?php if (comments_open() || get_comments_number()) : ?>
                    <div class="comments-section">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </article>
        <?php endwhile; endif; ?>
    </div>
</div>

<style>
.page-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    padding-top: 100px;
}

.page-hero {
    text-align: center;
    padding: 3rem 2rem;
    background: var(--card-bg);
    border-radius: 20px;
    margin-bottom: 3rem;
    backdrop-filter: blur(10px);
}

.page-hero h1 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.page-content {
    background: var(--card-bg);
    padding: 2rem;
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.page-article {
    line-height: 1.8;
}

.page-article h2,
.page-article h3,
.page-article h4 {
    color: var(--primary-color);
    margin: 2rem 0 1rem 0;
}

.page-article p {
    margin-bottom: 1.5rem;
}

.page-article ul,
.page-article ol {
    margin: 1rem 0 1.5rem 2rem;
}

.page-article li {
    margin-bottom: 0.5rem;
}

.comments-section {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}
</style>

<?php get_footer(); ?>
