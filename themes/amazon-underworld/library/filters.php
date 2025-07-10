<?php

namespace hacklabr;

/**
 * Filtra os posts no arquivo principal com base no parâmetro 'filter_term' da URL.
 *
 * @param \WP_Query
 */
function pre_get_posts_category_filter($query) {
    if (!$query->is_admin() && $query->is_main_query() && $query->is_post_type_archive()) {

        if (isset($_GET['filter_term']) && !empty($_GET['filter_term']) && $_GET['filter_term'] !== 'all') {

            $taxonomy = 'category';
            $term_slug = sanitize_title($_GET['filter_term']);

            $tax_query = [
                'tax_query' => [
                    [
                        'taxonomy' => $taxonomy,
                        'field'    => 'slug',
                        'terms'    => $term_slug,
                    ],
                ],
            ];

            $query->set('tax_query', $tax_query['tax_query']);
        }
    }
}
add_action('pre_get_posts', __NAMESPACE__ . '\pre_get_posts_category_filter');
