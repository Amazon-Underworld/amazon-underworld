</div>
<?php wp_reset_postdata() ?>
<?php if ( is_active_sidebar( 'footer_widgets' ) ):?>
    <footer class="main-footer">
        <div class="main-footer__widgets container">
            <?php dynamic_sidebar('footer_widgets') ?>
        </div>
        <div class="main-footer__copyright">
            <span><?=_e('© 2025 AMAZON UNDERWORLD', 'hacklabr'); ?></span>
            <?php get_template_part('template-parts/site-by-hacklab');?>
        </div>
    </footer>
<?php endif; ?>
<?php wp_footer() ?>

</body>
</html>
