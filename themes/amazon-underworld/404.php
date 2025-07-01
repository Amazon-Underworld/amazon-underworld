<?php get_header(); ?>
<div class="error-404">
    <div class="error-404__message-box">
        <p class="error-label"><?php _e('ERROR 404', 'hacklabr') ?></p>
        <h1 class="page-not-found-title"><?php _e('PAGE NOT FOUND', 'hacklabr') ?></h1>
        <p class="not-found-description"><?php _e('Lo sentimos, no hemos encontrado resultados que coincidan con tu criterio de búsqueda', 'hacklabr') ?></p>
        <a href="<?= home_url() ?>" class="button"> <span><?php _e('IR A LA HOME', 'hacklabr') ?></span> </a>
    </div>
</div>

<?php get_footer(); ?>
