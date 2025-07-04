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
?>
<article id="post-ID-<?php the_ID(); ?>" class="post-card <?=$modifiers?>">

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
    <header class="post-card__image">
        <a href="<?php the_permalink();?>" aria-label="<?= esc_attr(get_the_title()) ?>">
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail($image_size); ?>
            <?php else: ?>
                <img src="<?= get_stylesheet_directory_uri() ?>/assets/images/placeholder.png" alt="">
            <?php endif; ?>
        </a>
    </header>

    <main class="post-card__content">
        <?php if (!$hide_categories && !empty($categories)): ?>
            <div class="post-card__category">
                <?php foreach ($categories as $category): ?>
                    <a class="tag tag--solid tag--category-<?= $category->slug ?>">
                        <?= $category->name ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <h3 class="post-card__title">
            <a href="<?php the_permalink();?>"><?php the_title();?></a>
        </h3>

        <div class="post-card__excerpt">
            <?= get_the_excerpt(); ?>
        </div>
    </main>
</article>

<?php
$post = $original_post;
