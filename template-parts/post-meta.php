<?php
/**
 * Template part for displaying post meta information
 */
?>

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
