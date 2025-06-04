<?php
namespace hacklabr;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function render_amazon_slider_callback( $attributes ) {
    $category_slugs_string          = $attributes['categorySlugs'] ?? 'infoamazonia';
    $number_of_posts        = $attributes['numberOfPosts'] ?? 11;
    $order_by               = $attributes['orderBy'] ?? 'date';
    $order                  = $attributes['order'] ?? 'DESC';
    $external_link_meta_key = $attributes['externalLinkMetaKey'] ?? 'infoamazonia_redirect_url';
    $display_author_meta_key = $attributes['displayAuthorMetaKey'] ?? 'displayed_author_name';

    $slides_desktop     = $attributes['slidesPerViewDesktop'] ?? 4;
    $slides_tablet      = $attributes['slidesPerViewTablet'] ?? 2;
    $slides_mobile      = $attributes['slidesPerViewMobile'] ?? 1;
    $loop_slides        = $attributes['loopSlides'] ?? true;

    $query_args = [
        'post_type'      => 'post',
        'posts_per_page' => $number_of_posts,
        'orderby'        => $order_by,
        'order'          => $order,
        'post_status'    => 'publish',
    ];

    if ( ! empty( $category_slugs_string ) ) {
        $query_args['category_name'] = $category_slugs_string;
    }

    $slider_posts_query = new \WP_Query( $query_args );

    if ( ! $slider_posts_query->have_posts() ) {
        if (current_user_can('edit_posts')) {
            return '<p>' . sprintf( __( 'No posts found for category slug "%s". Please check block settings and ensure posts have the category and the custom field for external links.', 'hacklabr' ), esc_html($category_slugs_string) ) . '</p>';
        }
        return '';
    }

    $slider_id          = 'amazon-tiny-slider-' . wp_unique_id();
    $block_wrapper_attributes = get_block_wrapper_attributes( [
        'class' => 'amazon-slider-wrapper-frontend',
    ] );

    ob_start();
    ?>
    <div <?php echo $block_wrapper_attributes; ?>>
        <div
            id="<?php echo esc_attr( $slider_id ); ?>"
            class="amazon-tiny-slider-container"
            data-slides-desktop="<?php echo esc_attr( $slides_desktop ); ?>"
            data-slides-tablet="<?php echo esc_attr( $slides_tablet ); ?>"
            data-slides-mobile="<?php echo esc_attr( $slides_mobile ); ?>"
            data-loop="<?php echo esc_attr( $loop_slides ? 'true' : 'false' ); ?>"
        >
            <?php while ( $slider_posts_query->have_posts() ) : $slider_posts_query->the_post(); ?>
                <?php
                $current_post_id = get_the_ID();
                $external_url = get_post_meta( $current_post_id, $external_link_meta_key, true );

                if ( empty( $external_url ) || ! filter_var( $external_url, FILTER_VALIDATE_URL ) ) {
                    if ( current_user_can( 'edit_posts' ) ) {
                        error_log("Amazon Slider: External URL missing or invalid for post ID {$current_post_id} with meta key '{$external_link_meta_key}'.");
                    }
                     continue;
                }

                $image_url    = get_the_post_thumbnail_url( $current_post_id, 'large' );
                $image_alt    = get_post_meta( get_post_thumbnail_id( $current_post_id ), '_wp_attachment_image_alt', true ) ?: get_the_title( $current_post_id );

                $all_post_categories = get_the_category( $current_post_id );
                $category_display_name = '';
                $category_css_class = '';

                $infoamazonia_slug_reference = 'infoamazonia';

                if ( ! empty( $all_post_categories ) ) {
                    $chosen_category_object = null;
                    $other_category_temp_object = null;
                    $infoamazonia_object = null;

                    foreach ( $all_post_categories as $cat_obj ) {
                        if ( strtolower( $cat_obj->slug ) === $infoamazonia_slug_reference ) {
                            $infoamazonia_object = $cat_obj;
                        } elseif ( !$other_category_temp_object ) {
                            $other_category_temp_object = $cat_obj;
                        }
                    }

                    if ( $other_category_temp_object ) {
                        $chosen_category_object = $other_category_temp_object;
                    } elseif ( $infoamazonia_object ) {
                        $chosen_category_object = $infoamazonia_object;
                    } elseif (!empty($all_post_categories)) {
                        $chosen_category_object = $all_post_categories[0];
                    }

                    if ( $chosen_category_object ) {
                        $category_display_name = esc_html( $chosen_category_object->name );
                        $category_css_class = 'category-slug--' . esc_attr( $chosen_category_object->slug );
                    }
                }

                $title        = get_the_title( $current_post_id );
                $author = get_post_meta( $current_post_id, $display_author_meta_key, true );
                if ( empty( $author ) ) {
                    $author = get_the_author_meta( 'display_name', get_post_field( 'post_author', $current_post_id ) );
                }
                ?>
                <div class="amazon-slide-item <?php echo esc_attr( $category_css_class ); ?>">
                    <a href="<?php echo esc_url( $external_url ); ?>" target="_blank" rel="noopener noreferrer" class="amazon-slide-link">
                        <div class="amazon-slide-image-container">
                            <?php if ( $image_url ) : ?>
                                <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="amazon-slide-image" loading="lazy"/>
                            <?php else : ?>
                                <div class="amazon-slide-image-placeholder"><span><?php esc_html_e( 'Image', 'hacklabr' ); ?></span></div>
                            <?php endif; ?>
                        </div>
                        <div class="amazon-slide-content">
                            <?php if ( $category_display_name ) : ?>
                                <span class="amazon-slide-category <?php echo $category_css_class; ?>"><?php echo $category_display_name; ?></span>
                            <?php endif; ?>
                            <h3 class="amazon-slide-title"><?php echo esc_html( $title ); ?></h3>
                            <?php if ( $author ) :  ?>
                                <p class="amazon-slide-author">
                                    <?php
                                    printf( esc_html__( 'By %s', 'hacklabr' ), esc_html( $author ) );
                                    ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <div class="amazon-slider-controls">
            <button class="amazon-slider-prev" aria-label="<?php esc_attr_e('Previous slide', 'hacklabr'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right-amazon-slider.svg" alt="<?php esc_attr_e('Previous slide', 'hacklabr'); ?>" />
            </button>
            <button class="amazon-slider-next" aria-label="<?php esc_attr_e('Next slide', 'hacklabr'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right-amazon-slider.svg" alt="<?php esc_attr_e('Next slide', 'hacklabr'); ?>" />
            </button>
        </div>
    </div>
    <?php
    return ob_get_clean();
}