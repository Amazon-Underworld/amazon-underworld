<?php
/**
 * The template for displaying all single posts
 */

get_header();
the_post();
$category = get_the_category();
$excerpt = !empty( $post->post_excerpt ) ? wp_kses_post( $post->post_excerpt ) : '';
$download_en = pods_field('download_file_en');
$download_es = pods_field('download_file_es');
$download_pt = pods_field('download_file_pt');
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

                $download_en = pods_field('download_file_en');
                $download_es = pods_field('download_file_es');
                $download_pt = pods_field('download_file_pt');


                if ($download_en || $download_es || $download_pt) :
                ?>
                    <p><?= __('Download this paper', 'hacklabr'); ?></p>

                    <div class="post-header-pp__language-selector">

                        <?php
                        if (!empty($download_en)) {
                            $download_url = is_array($download_en) ? $download_en['guid'] : wp_get_attachment_url($download_en);
                            if ($download_url): ?>
                                <button type="button" onclick="window.open('<?= esc_js($download_url); ?>')">
                                    <?= __('English', 'hacklabr'); ?>
                                </button>
                            <?php endif;
                        }

                        if (!empty($download_es)) {
                            $download_url = is_array($download_es) ? $download_es['guid'] : wp_get_attachment_url($download_es);
                            if ($download_url): ?>
                                <button type="button" onclick="window.open('<?= esc_js($download_url); ?>')">
                                    <?= __('Español', 'hacklabr'); ?>
                                </button>
                            <?php endif;
                        }

                        if (!empty($download_pt)) {
                            $download_url = is_array($download_pt) ? $download_pt['guid'] : wp_get_attachment_url($download_pt);
                            if ($download_url): ?>
                                <button type="button" onclick="window.open('<?= esc_js($download_url); ?>')">
                                    <?= __('Português', 'hacklabr'); ?>
                                </button>
                            <?php endif;
                        }
                        ?>
                    </div>
                <?php endif; ?>
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

<?php get_footer();
