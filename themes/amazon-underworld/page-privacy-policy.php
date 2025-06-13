<?php
/**
 * Template Name: Layout Política de Privacidade
 * Template Post Type: page
 */

get_header();
?>
    <div class="privacy-policy container">
        <div class="post-header post-header__separator">
            <h1 class="post-header__title"><?php the_title() ?></h1>
        </div>
        <div class="post-content content content--normal">
            <?php the_content() ?>
        </div>
    </div>
<?php get_footer();
