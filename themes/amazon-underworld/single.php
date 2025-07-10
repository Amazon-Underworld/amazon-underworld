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
$close_text = pods_field('closing_text');
$tags = get_tags();
$post_url = get_permalink(get_the_ID());

echo do_shortcode('[main-header]');

if(has_term('opinion', 'category', $post_id) || has_term('opiniao', 'category', $post_id) || has_term('opinion-es', 'category', $post_id)  ){ ?>
    <header id="post-header" class="post-header post-header__opinion container">
        <?php get_template_part('template-parts/title/post-header'); ?>
    </header>
<?php }

elseif(has_term('article', 'category', $post_id) || has_term('artigo', 'category', $post_id) || has_term('articulo', 'category', $post_id) ){ ?>
    <header id="post-header"  class="post-header post-header__article container">
        <?php get_template_part('template-parts/title/post-header'); ?>
    </header>
<?php }

elseif(has_term('chronicle', 'category', $post_id) || has_term('cronica', 'category', $post_id)  || has_term('cronica-es', 'category', $post_id) ){ ?>
    <header id="post-header"  class="post-header post-header__chronicle container">
        <?php get_template_part('template-parts/title/post-header'); ?>
    </header>
<?php }

else{ ?>
    <header id="post-header" class="post-header post-header__no-term container">
        <?php get_template_part('template-parts/title/post-header'); ?>
    </header>
<?php }

?>

<main class="post-grid">
    <aside class="post-aside">
        <div class="post-aside__meta container">

            <?php get_template_part('template-parts/share-links', null, ['link'=>get_the_permalink()]) ?>
        </div>

    </aside>
    <div class="post-content content content--normal">
        <?php
        if( !empty($intro[0]) ){ ?>
            <h2 class="post-content__intro alignwide"><?php echo $intro[0] ;?></h2>
        <?php
        }
        else{
            if( !empty($excerpt) ) : ?>
            <h2 class="post-content__intro alignwide"><?= get_the_excerpt() ?></h2>
        <?php endif;
        } ?>
        <?php the_content() ?>
    </div>

</main>

<div class="post-footer">
    <div class="post-footer__heading">
        <div class="post-footer__tags">
            <?php
            if(!empty($tags)){ ?>
                <span><?= _e('Tags', 'hacklabr');?></span>
                <?php foreach($tags as $tag){ ?>
                    <a class="tag tag--<?= $tag->slug ?>">
                    <?= $tag->name ?>
                </a>
                <?php
                }
            }
            ?>

        </div>
        <?php get_template_part('template-parts/share-links', null, ['link'=>get_the_permalink()]) ?>
    </div>

</div>





<?php get_footer();
