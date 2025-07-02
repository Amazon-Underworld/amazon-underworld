<?php
/**
 * Template Name: About Us
 * Template Post Type: page
 */

get_header();
the_post();
?>
    <div class="about-us container">
        <div class="post-content content content--normal">
            <?php the_content() ?>
        </div>
    </div>
<?php get_footer();
