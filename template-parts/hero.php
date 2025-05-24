<?php
/**
 * Template part for displaying hero sections
 * 
 * @param string $title - Hero title
 * @param string $subtitle - Hero subtitle
 * @param string $background_image - Background image URL (optional)
 * @param string $class - Additional CSS class (optional)
 */

$title = $args['title'] ?? get_the_title();
$subtitle = $args['subtitle'] ?? '';
$background_image = $args['background_image'] ?? '';
$class = $args['class'] ?? 'page-hero';

$style = '';
if ($background_image) {
    $style = 'style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(' . esc_url($background_image) . ') center/cover;"';
    $class .= ' hero-with-bg';
}
?>

<div class="<?php echo esc_attr($class); ?>" <?php echo $style; ?>>
    <h1><?php echo esc_html($title); ?></h1>
    <?php if ($subtitle): ?>
        <p><?php echo esc_html($subtitle); ?></p>
    <?php endif; ?>
</div>
