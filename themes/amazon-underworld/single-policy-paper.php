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
$post_url = get_permalink(get_the_ID());
$post_url_es = apply_filters( 'wpml_permalink', $post_url, 'es');
$post_url_pt = apply_filters( 'wpml_permalink', $post_url, 'pt-br');
$post_url_en = apply_filters( 'wpml_permalink', $post_url, 'en');
?>

<div class="policy-paper-app">
    <div class="post-aside">
        <header class="post-header-pp container">
            <div class="post-header-pp__meta post-header-pp__meta-mobile">
                <p class="post-header-pp__date"><?= get_the_date('j F Y') ?></p>
                <h1 class="post-header-pp__title"> <?php the_title(); ?> </h1>
            </div>
            <div class="post-header-pp__featured-image">
                <?= get_the_post_thumbnail(null, 'post-thumbnail',['class'=>'post-header__featured-img']); ?>
            </div>

            <div class="post-header-pp__download">
                <?php
                    if(!empty($download)){
                        $download_link = $download['guid'];
                        ?>
                        <button type="button" type="submit" onclick="window.open('<?= $download_link ?> ')"><?= _e('Download this paper', 'hacklabr');?></button>
                    <?php
                    }
                ?>
            </div>

            <div class="post-header-pp__language-selector">
                <span class="selector">
                    <a href="<?php $post_url_es; ?>">
                        <?php _e('Español', 'hacklabr');?>
                    </a>
                </span>
                <span class="selector">
                    <a href="<?php $post_url_en; ?>">
                        <?php _e('English', 'hacklabr');?>
                    </a>
                </span>
                <span class="selector">
                    <a href="<?php $post_url_pt; ?>">
                        <?php _e('Português', 'hacklabr');?>
                    </a>
                </span>
            </div>
        </header>

        <div class="post-footer post-footer__desktop">
            <div class="post-header-pp__tags">
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


    <main class="post-content content content--normal">
        <div class="post-header-pp__meta post-header__meta-desktop container">
            <p class="post-header-pp__date"><?= get_the_date('j F Y') ?></p>
            <h1 class="post-header-pp__title"> <?php the_title(); ?> </h1>
        </div>

        <?php the_content() ?>
    </main>

    <div class="post-footer post-footer__mobile">
            <div class="post-header-pp__tags">
                <span><?= _e('Tags', 'hacklabr');?></span>
                    <?php
                    if(!empty($tags)){
                        foreach($tags as $tag){ ?>
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

<?php get_template_part('template-parts/content/related-posts') ?>

<?php get_footer();
