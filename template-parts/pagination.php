<?php
/**
 * Template part for displaying pagination
 */

if (get_previous_posts_link() || get_next_posts_link()) : ?>
<div class="pagination">
    <div class="nav-previous">
        <?php previous_posts_link('<i class="fas fa-arrow-left"></i> Newer Posts'); ?>
    </div>
    <div class="nav-next">
        <?php next_posts_link('Older Posts <i class="fas fa-arrow-right"></i>'); ?>
    </div>
</div>
<?php endif; ?>
