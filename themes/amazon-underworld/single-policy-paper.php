<?php
/**
 * The template for displaying all single posts
 */

get_header();
the_post();
$category = get_the_category();
$excerpt = !empty( $post->post_excerpt ) ? wp_kses_post( $post->post_excerpt ) : '';
$download = pods_field('download_file');
$tags = get_tags();
?>

<div class="policy-paper-app">
    <div class="post-aside">
        <header class="post-header container">
            <div class="post-header__featured-image">
                <?= get_the_post_thumbnail(null, 'post-thumbnail',['class'=>'post-header__featured-image']); ?>
            </div>

            <div class="post-header__download">
                <?php
                    if(!empty($download)){
                        $download_link = $download['guid'];
                        ?>
                        <button type="button" type="submit" onclick="window.open('<?= $download_link ?> ')"><?= _e('Download this paper');?></button>
                    <?php
                    }
                ?>
            </div>

            <div class="post-header__language-selector">
                <span class="selector">
                    <?php _e('Español', 'hacklabr');?>
                </span>
                <span class="selector">
                    <?php _e('English', 'hacklabr');?>
                </span>
                <span class="selector">
                    <?php _e('Português', 'hacklabr');?>
                </span>
            </div>
        </header>

        <div class="post-footer">
            <div class="post-header__tags">
                <span><?= _e('Tags', 'hacklabr');?></span>
                    <?php
                    foreach($tags as $tag){ ?>
                        <a class="tag tag--<?= $tag->slug ?>" href="<?= get_term_link($tag, 'tag') ?>">
                        <?= $tag->name ?>
                    </a>
                    <?php
                    }
                    ?>
            </div>

            <?php get_template_part('template-parts/share-links', null, ['link'=>get_the_permalink()]) ?>
        </div>
    </div>


    <main class="post-content content content--normal">
        <div class="post-header__meta container">
            <p class="post-header__date"><?= get_the_date('j F Y') ?></p>
        </div>
        <h1 class="post-header__title"> <?php the_title(); ?> </h1>

        <?php the_content() ?>
    </main>
</div>

<?php get_template_part('template-parts/content/related-posts') ?>

<?php get_footer();
