<?php
/**
 * Template Name: About Us
 * Template Post Type: page
 */

get_header();
the_post();

add_action('wp_footer', function () { ?>
    <div id="author-modal">

    </div><?php
});

?>
    <div class="about-us container">
        <div class="post-content content content--normal">
            <?php the_content() ?>
        </div>
    </div>
<?php get_footer();
