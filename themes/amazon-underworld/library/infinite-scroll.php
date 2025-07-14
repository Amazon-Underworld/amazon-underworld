<?php

namespace hacklabr;

/**
 * Função que responde à chamada AJAX para carregar mais posts.
 */
function load_more_posts_handler() {
    check_ajax_referer('hacklabr_load_more_nonce', 'nonce');

    $paged = isset($_POST['page']) ? absint($_POST['page']) : 1;
    $filter_term = isset($_POST['filter_term']) ? sanitize_text_field($_POST['filter_term']) : 'all';

    $excluded_ids = get_posts([
        'post_type' => 'post',
        'posts_per_page' => 1,
        'ignore_sticky_posts' => true,
        'fields' => 'ids',
        'no_found_rows' => true,
    ]);

    $args = [
        'post_type'      => 'post',
        'posts_per_page' => 12,
        'paged'          => $paged,
        'post__not_in'   => $excluded_ids,
        'post_status'    => 'publish',
    ];

    if ($filter_term !== 'all') {
        $args['tax_query'] = [
            [
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $filter_term,
            ],
        ];
    }

    $query = new \WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/post-card', 'vertical', ['hide_excerpt' => true]);
        endwhile;
        $posts_html = ob_get_clean();

        wp_send_json_success(['html' => $posts_html]);
    } else {
        wp_send_json_error(['message' => 'Fim dos resultados.']);
    }

    wp_die();
}

add_action('wp_ajax_load_more_posts', __NAMESPACE__ . '\load_more_posts_handler');
add_action('wp_ajax_nopriv_load_more_posts', __NAMESPACE__ . '\load_more_posts_handler');
