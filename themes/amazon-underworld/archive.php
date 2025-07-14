<?php
get_header();

$featured_post_query = new WP_Query(['posts_per_page' => 1, 'ignore_sticky_posts' => true, 'fields' => 'ids']);
$excluded_ids = $featured_post_query->have_posts() ? $featured_post_query->posts : [];
?>

<div class="container archive container--wide">
    <div class="post-grid-latest-posts__background">
        <div class="post-grid-latest-posts">

            <div class="post-grid-latest-posts__featured">
                <?php
                if ($featured_post_query->have_posts()) :
                    $featured_post_query->the_post();
                    get_template_part('template-parts/post-card', 'horizontal', ['hide_excerpt' => false]);
                endif;
                wp_reset_postdata();
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
            $filter_term = !empty($_GET['filter_term']) ? sanitize_text_field($_GET['filter_term']) : 'all';

            $args_main = [
                'post_type'      => 'post',
                'posts_per_page' => 12,
                'paged'          => $paged,
                'post__not_in'   => $excluded_ids,
            ];

            if ($filter_term !== 'all') {
                $args_main['tax_query'] = [[
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => $filter_term,
                ]];
            }

            $main_query = new WP_Query($args_main);

            if ($main_query->have_posts()) :
                while ($main_query->have_posts()) : $main_query->the_post();
                    get_template_part('template-parts/post-card', 'vertical', ['hide_excerpt' => true]);
                endwhile;
            else :
                echo '<p>' . __('Nenhum post encontrado.', 'hacklabr') . '</p>';
            endif;
            ?>
        </main>

    </div>

    <?php
        if ($main_query->max_num_pages > 1) {
        echo '<div id="infinite-scroll-trigger"></div>';
        }
        wp_reset_postdata();
    ?>
</div><!-- /.container -->

<?php get_footer(); ?>
