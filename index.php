<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">
        <h1 class="site-title">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        </h1>
        
        <?php if (has_nav_menu('primary')): ?>
            <nav class="main-navigation">
                <?php wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                )); ?>
            </nav>
        <?php endif; ?>
    </div>
</header>

<main class="site-main">
    <div class="container">
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php if (is_singular()): ?>
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        <?php else: ?>
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                        <?php endif; ?>
                        
                        <div class="entry-meta">
                            Posted on <?php the_date(); ?> by <?php the_author(); ?>
                        </div>
                    </header>
                    
                    <div class="entry-content">
                        <?php if (is_singular()): ?>
                            <?php the_content(); ?>
                        <?php else: ?>
                            <?php the_excerpt(); ?>
                            <p><a href="<?php the_permalink(); ?>">Read more</a></p>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endwhile; ?>
            
            <?php if (!is_singular()): ?>
                <div class="pagination">
                    <?php previous_posts_link('← Newer Posts'); ?>
                    <?php next_posts_link('Older Posts →'); ?>
                </div>
            <?php endif; ?>
            
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</main>

<footer class="site-footer">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
