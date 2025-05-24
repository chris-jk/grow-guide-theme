<?php get_header(); ?>

<div class="page-container">
    <div class="page-hero">
        <h1><?php the_title(); ?></h1>
        <?php if (has_excerpt()): ?>
            <p><?php the_excerpt(); ?></p>
        <?php endif; ?>
    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="content-section">
            <?php the_content(); ?>
            
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="comments-section">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
        </article>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
