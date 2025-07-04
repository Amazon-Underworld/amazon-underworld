</div>
<?php wp_reset_postdata() ?>
<?php if ( is_active_sidebar( 'footer_widgets' ) ):?>
    <footer class="main-footer">
        <div class="main-footer__widgets container">
            <?php dynamic_sidebar('footer_widgets') ?>
        </div>
        <div class="main-footer__copyright">
            <span><?=_e('© 2025 AMAZON UNDERWORLD', 'hacklabr'); ?></span>
            <span class="font-copyright"><?=_e('WEB DESING BY RÉPLICA | OPEN SOURCE FONT BY ', 'hacklabr'); ?><a href="http://www.whence.com/kamal/" target="_blank">KAMAL MOSTAFA </a></span>
        </div>
    </footer>
<?php endif; ?>
<?php wp_footer() ?>

</body>
</html>
