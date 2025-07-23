<?php
global $post;
$original_post = $post;
$post = $args['post'] ?? $post;

$image_size = $args['image_size'] ?? 'card-large';

$hide_author = (bool) ($args['hide_author'] ?? false);
$hide_categories = (bool) ($args['hide_categories'] ?? false);
$hide_date = (bool) ($args['hide_date'] ?? false);
$hide_excerpt = (bool) ($args['hide_excerpt'] ?? false);

$modifiers = (array) ($args['modifiers'] ?? []);
$modifiers = array_map(fn ($modifier) => "post-card--{$modifier}", $modifiers);
$modifiers = implode(' ', $modifiers);

$categories = get_the_category();

$primary_category = null;
if (!empty($categories)) {
    $primary_category_id = 0;

    if (function_exists('yoast_get_primary_term_id')) {
        $yoast_id = yoast_get_primary_term_id('category', get_the_ID());
        if ($yoast_id) {
            $primary_category_id = $yoast_id;
        }
    }
    if ($primary_category_id > 0) {
        $primary_category = get_term($primary_category_id, 'category');
    } else {
        $primary_category = $categories[0];
    }
}

$main_category_class = '';
if ($primary_category && !is_wp_error($primary_category)) {
    $main_category_class = 'category-' . $primary_category->slug;
}

$external_link = get_post_meta(get_the_ID(), 'external-source-link', true);

if (!empty($external_link) && filter_var($external_link, FILTER_VALIDATE_URL)) {
    $post_url = $external_link;
    $link_target = 'target="_blank" rel="noopener noreferrer"';
} else {
    $post_url = get_permalink();
    $link_target = '';
}
?>
<article id="post-ID-<?php the_ID(); ?>" class="post-card <?php echo $main_category_class; ?> <?=$modifiers?>">

    <?php if (is_singular('policy-paper')): ?>
        <div class="post-card__meta">
            <?php if (!$hide_author): ?>
            <div class="post-card__author">
                <?php the_author(); ?>
            </div>
            <?php endif; ?>
            <time class="post-card__date">
                <?php echo get_the_date('j F Y'); ?>
            </time>
        </div>
    <?php endif; ?>

    <header class="post-card__image">
        <a href="<?php echo esc_url($post_url); ?>" aria-label="<?= esc_attr(get_the_title()) ?>" <?php echo $link_target; ?>>
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail($image_size); ?>
            <?php else: ?>
                <img src="<?= get_stylesheet_directory_uri() ?>/assets/images/placeholder.png" alt="">
            <?php endif; ?>
        </a>
    </header>

    <main class="post-card__content">
        <?php if (!$hide_categories && $primary_category && !is_wp_error($primary_category)): ?>
            <div class="post-card__category">
                <a class="tag tag--solid tag--category-<?= esc_attr($primary_category->slug) ?>">
                    <?= esc_html($primary_category->name) ?>
                </a>
            </div>
        <?php endif; ?>

        <h3 class="post-card__title">
            <a href="<?php echo esc_url($post_url); ?>" <?php echo $link_target; ?>><?php the_title();?></a>
        </h3>

        <?php if (!$hide_excerpt): ?>
            <div class="post-card__excerpt">
                <?= get_the_excerpt(); ?>
            </div>
        <?php endif; ?>

        <div class="post-card__meta">
            <?php if (!$hide_author): ?>
            <div class="post-card__author">
                <?= _e('by', 'hacklabr') ?>
                <?php
                if (function_exists('coauthors_posts_links')) {
                    coauthors_posts_links();
                } else {
                    the_author_posts_link();
                }
                ?>
            </div>
            <?php endif; ?>
        </div>
    </main>
</article>

<?php
$post = $original_post;
