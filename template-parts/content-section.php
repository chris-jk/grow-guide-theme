<?php
/**
 * Template part for displaying content sections
 * 
 * @param string $title - Section title (optional)
 * @param string $content - Section content
 * @param string $class - Additional CSS class (optional)
 */

$title = $args['title'] ?? '';
$content = $args['content'] ?? '';
$class = $args['class'] ?? 'content-section';
?>

<div class="<?php echo esc_attr($class); ?>">
    <?php if ($title): ?>
        <h2><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
    
    <?php if ($content): ?>
        <div class="section-content">
            <?php echo wp_kses_post($content); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($args['include_content']) && $args['include_content']): ?>
        <?php the_content(); ?>
    <?php endif; ?>
</div>
