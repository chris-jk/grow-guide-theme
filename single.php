<?php get_header(); ?>

<div class="single-container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="single-post">
            <header class="post-header">
                <h1 class="post-title"><?php the_title(); ?></h1>
                <?php get_template_part('template-parts/post-meta'); ?>
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
                <?php if (function_exists('ggd_app_link')): ?>
                    <div class="app-link-section">
                        <p><strong>💡 Get the best reading experience:</strong></p>
                        <?php echo ggd_app_link('post/' . get_the_ID(), 'Open in Grow Guide App', 'btn btn-app'); ?>
                        <p class="app-link-description">Read this post in our mobile app with enhanced features, offline access, and personalized recommendations.</p>
                    </div>
                <?php endif; ?>

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

<?php get_footer(); ?>
