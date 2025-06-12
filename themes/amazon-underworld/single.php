<?php
/**
 * The template for displaying all single posts
 */

get_header();
the_post();

$post_id = get_the_ID();
$categories = get_the_category();
$excerpt = !empty( $post->post_excerpt ) ? wp_kses_post( $post->post_excerpt ) : '';
$terms = get_the_terms($post_id, 'category');
$intro = pods_field('intro');

if(has_term('opinion', 'category', $post_id)){ ?>
    <header class="post-header post-header__opinion container">
        <?php get_template_part('template-parts/title/post-header'); ?>
    </header>
<?php }

elseif(has_term('article', 'category', $post_id)){ ?>
    <header class="post-header post-header__article container">
        <?php get_template_part('template-parts/title/post-header'); ?>
    </header>
<?php }

elseif(has_term('chronicle', 'category', $post_id)){ ?>
    <header class="post-header post-header__chronicle container">
        <?php get_template_part('template-parts/title/post-header'); ?>
    </header>
<?php }

else{ ?>
    <header class="post-header container">
        <?php get_template_part('template-parts/title/post-header'); ?>
    </header>
<?php }
echo do_shortcode('[main-header]')
?>

<main class="post-grid">
    <aside class="post-aside">
        <div class="post-aside__meta container">
            <p class="post-aside__date"><?= get_the_date('j F Y') ?></p>
            <p class="post-aside__author"><?php _e('By ', 'hacklabr') ?><?= get_the_author() ?></p>
        </div>
        <?php get_template_part('template-parts/share-links', null, ['link'=>get_the_permalink()]) ?>
    </aside>
    <div class="post-content">
        <?php
        if( $intro ){ ?>
            <p class="post-content__intro"><?php echo $intro[0] ;?></p>
        <?php
        }
        else{
            if( $excerpt ) : ?>
            <p class="post-content__intro"><?= get_the_excerpt() ?></p>
        <?php endif;
        } ?>
        <div class="content content--normal">
            <?php the_content() ?>
    </div>
</main>

<?php get_template_part('template-parts/content/related-posts') ?>

<?php get_footer();
