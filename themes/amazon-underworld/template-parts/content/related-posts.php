<?php

use PhpParser\Node\Stmt\Echo_;

$post_id = get_the_ID();

$projects = get_the_terms( $post_id, 'category' );

if ( $projects && ! is_wp_error( $projects ) ) {
    $projects = wp_list_pluck( $projects, 'term_id' );
}

$post_type = get_post_type($post_id);
$post_type_obj = get_post_type_object($post_type);

$args = [
    'post_type'      => $post_type,
    'posts_per_page' => 3,
    'post__not_in'   => [ $post_id ],
    'orderby'        => 'date',
    'order'          => 'DESC',
];

$related_posts = new WP_Query( $args );

if ( $related_posts->have_posts() ) : ?>

<div class="related-posts container container--wide">
    <h2 class="related-posts__title">
        <?php _e('Explore more ' . $post_type_obj->label, 'hacklabr') ?></h2>
        <div class="related-posts__content">
            <?php while( $related_posts->have_posts() ) :
                $related_posts->the_post();
                // Thumbnail
                $thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail() : '<img src="' . get_stylesheet_directory_uri() . '/assets/images/default-image.png">'; ?>
                <?php get_template_part( 'template-parts/post-card'); ?>
            <?php endwhile; ?>
        </div>
    </div>

<?php endif;
wp_reset_postdata(); ?>
