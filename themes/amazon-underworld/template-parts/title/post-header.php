<?php
/**
 * The template-part for displaying post-header
 */

$post_id = get_the_ID();
$categories = get_the_category();
$excerpt = !empty( $post->post_excerpt ) ? wp_kses_post( $post->post_excerpt ) : '';
$terms = get_the_terms($post_id, 'category');
?>


    <div class="post-header__infos">
        <div class="post-header__head">
            <div class="post-header__tags">
                <?php
                if(!empty($categories)){
                    foreach($categories as $category){
                        if($category->slug != 'infoamazonia' && $category->slug != 'infoamazonia-es' && $category->slug != 'infoamazonia-pt-br'){ ?>
                        <a class="tag tag--<?= $category->slug ?>">
                        <?= $category->name ?>
                        </a>
                    <?php }
                    }
                }
                ?>
            </div>

            <h1 class="post-header__title"> <?php the_title(); ?> </h1>
            <div class="post-header__author container">
                <p class="post-header__author-name"><?php _e('By ', 'hacklabr') ?>
                <?php
                if ( function_exists( 'coauthors_posts_links' ) ) {
                    coauthors_posts_links();
                } else {
                    the_author_posts_link();
                } ?></p>
            </div>
        </div>

        <div class="post-header__meta container">

            <p class="post-header__date"><?= get_the_date('j F Y') ?></p>
        </div>
    </div>
    <div class="post-header__featured-image">
        <?= get_the_post_thumbnail(null, 'post-thumbnail',['class'=>'post-header__featured-image']); ?>
    </div>
