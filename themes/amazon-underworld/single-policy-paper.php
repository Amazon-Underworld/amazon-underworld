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
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" viewBox="0 0 23 24" fill="none">
                        <path d="M0 12.0001C0 6.77535 -1.39078e-07 4.16299 1.62311 2.53986C3.24624 0.916748 5.8586 0.916748 11.0833 0.916748C16.308 0.916748 18.9204 0.916748 20.5436 2.53986C22.1667 4.16299 22.1667 6.77535 22.1667 12.0001C22.1667 17.2248 22.1667 19.8372 20.5436 21.4604C18.9204 23.0834 16.308 23.0834 11.0833 23.0834C5.8586 23.0834 3.24624 23.0834 1.62311 21.4604C-1.39078e-07 19.8372 0 17.2248 0 12.0001Z" fill="#48441D"/>
                        <path d="M11.0859 6.21167L11.0859 14.4371M11.0859 14.4371C11.4663 14.4421 11.8416 14.1807 12.1186 13.8615L13.973 11.7817M11.0859 14.4371C10.7189 14.4322 10.3472 14.1721 10.0533 13.8615L8.18809 11.7817M6.40039 17.8783L15.7337 17.8783" stroke="#F8F3EB" stroke-linecap="round"/>
                        </svg>
                        <?= __('Download this paper', 'hacklabr'); ?></p>

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

<?php get_template_part('template-parts/content/related-posts') ?>

<?php get_footer();
