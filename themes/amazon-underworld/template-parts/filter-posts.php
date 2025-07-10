<?php
global $wp;

$current_url = get_post_type_archive_link( get_post_type() ) . '?&';

$taxonomy = ( isset( $args['taxonomy'] ) ) ? $args['taxonomy'] : 'category';
$taxonomy_terms = get_terms( $taxonomy );

$selected_term_slug = isset($_GET['filter_term']) ? sanitize_title($_GET['filter_term']) : '';
$button_text = __('Filter by', 'hacklabr');
$button_class = '';

if ($selected_term_slug) {
    $current_term = get_term_by('slug', $selected_term_slug, $taxonomy);
    if ($current_term) {
        $button_text = $current_term->name;
        $button_class = 'category-' . $current_term->slug;
    }
}

if ( $taxonomy_terms && ! is_wp_error( $taxonomy_terms ) ) :

    $selected = '';

    if ( isset( $_GET['filter_term'] ) ) {
        $selected = sanitize_title( $_GET['filter_term'] );
    } ?>

    <div class="filter-posts">
        <span class="filter-posts__label"><?php _e('FILTER BY', 'hacklabr'); ?></span>
        <button type="button" class="filter-posts__toggle <?php echo esc_attr($button_class); ?>">
            <span class="filter-by"><?php echo esc_html($button_text); ?></span>
            <span class="arrow-down">
                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L9 1" stroke="#F8F3EB"/>
                </svg>
            </span>
        </button>

        <ul class="filter-posts__list">
            <?php foreach ($taxonomy_terms as $term) :
                $active_class = ($selected_term_slug === $term->slug) ? 'active' : '';

                $term_link = add_query_arg('filter_term', $term->slug, $current_url);
                $category_class = 'category-' . $term->slug;
            ?>
                <li>
                    <a href="<?php echo esc_url($term_link); ?>" class="filter-posts__link <?php echo $active_class; ?> <?php echo $category_class; ?>">
                        <span><?php echo $term->name; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>
