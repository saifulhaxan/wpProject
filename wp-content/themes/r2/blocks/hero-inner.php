<?php

/**
 * Hero (inner) Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Create id attribute allowing for custom "anchor" value.
$id = 'hero-inner-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// base classes
$className = 'hero-inner';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// header
$overline = get_field('block_overline');
$title = get_field('block_title')?: get_the_title();
$description = get_field('block_description');
?>

<?php if( !empty( $block['data']['_is_preview'] ) ) : ?>
    <?php
        // Preview when hovering over block option.
        // Make image 600px wide and height can vary depending on how many variations of the block you want to show.
    ?>
    <img src="<?= $block['data']['image']; ?>" />
<?php else : ?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="block__wrapper">    
        <?php if ( $overline || $title || $description ) : ?>
        <div class="block__header">
            <?php if ( $overline ) : ?>
            <div class="block__overline"><?= $overline; ?></div>
            <?php endif; ?>
            <?php if ( $title ) : ?>
            <h1 class="block__title"><?= $title; ?></h1>
            <?php endif; ?>
            <?php if ( $description ) : ?>
            <div class="block__description"><?= $description; ?></div>
            <?php endif; ?>
            <?php if( have_rows('cta_buttons') ): ?>
                <div class="block__actions">
                    <?php get_template_part( 'template-parts/content', 'buttons' ); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
        
    <?php
    $hero_bg = get_field( 'hero_bg' );
    if ( !empty($hero_bg) ) : ?>
        <img class="hero-inner__bg" <?php acf_responsive_image($hero_bg['ID'],'full','1920px'); ?>  alt="<?= $hero_bg['alt']; ?>" />
    <?php endif; ?>
</section>
<?php endif; ?>