<?php
get_header();
$excluded_ids = [];
?>

<div class="container archive container--wide">
    <div class="post-grid-latest-posts__background">
        <div class="post-grid-latest-posts">

            <div class="post-grid-latest-posts__featured">
                <?php
            $args_last = [
                'post_type' => 'post',
                'posts_per_page' => 1,
                'ignore_sticky_posts' => true,
                'no_found_rows' => true
            ];
            $last_post_query = new WP_Query($args_last);
            if ($last_post_query->have_posts()) :
                while ($last_post_query->have_posts()) : $last_post_query->the_post();
                    $excluded_ids[] = get_the_ID();
                    get_template_part('template-parts/post-card', 'horizontal', ['hide_excerpt' => false]);
                endwhile;
                wp_reset_postdata();
            endif;
                ?>
            </div>

        </div>
    </div>

    <div class="archive-header__infos">
        <?php get_template_part('template-parts/filter', 'posts', ['taxonomy' => 'category']); ?>
    </div>

    <div class="post-grid-filters">
        <main class="posts-grid__content">
            <?php

            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $offset = 1;

            $tax_query = [];
            if (!empty($_GET['filter_term']) && $_GET['filter_term'] !== 'all') {
                $tax_query[] = [
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($_GET['filter_term']),
                ];
            }

            $args_filtered = [
                'post_type'      => 'post',
                'posts_per_page' => 12,
                'paged'          => $paged,
                'post__not_in'   => $excluded_ids,
                'tax_query'      => $tax_query,
            ];

            $filtered_query = new WP_Query($args_filtered);
            if ($filtered_query->have_posts()) :
                while ($filtered_query->have_posts()) : $filtered_query->the_post();
                    get_template_part('template-parts/post-card', 'vertical', ['hide_excerpt' => true]);
                endwhile;
            else :
                echo '<p>' . __('Nenhum post encontrado.', 'hacklabr') . '</p>';
            endif;
            ?>
        </main>

    </div>

    <?php
     the_posts_pagination([
        'prev_text' => __( '<iconify-icon icon="iconamoon:arrow-left-2-bold"></iconify-icon>', 'hacklbr'),
        'next_text' => __( '<iconify-icon icon="iconamoon:arrow-right-2-bold"></iconify-icon>', 'hacklbr'),

    ]); ?>




</div><!-- /.container -->

<?php get_footer(); ?>
