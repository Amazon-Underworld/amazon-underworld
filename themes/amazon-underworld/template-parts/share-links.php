<div class="share-links">
    <span><?php _e( 'Share this:', 'hacklabr' ) ?></span>

    <div class="share-links__icons">
         <a href="https://telegram.me/share/url?url=<?= get_the_title().' - '.get_the_permalink() ?>" target="_blank">
            <iconify-icon icon="file-icons:telegram"></iconify-icon>
        </a>
        <a class=".copy" href="" target="_blank">
            <img src="<?= get_template_directory_uri() ?>/assets/images/copy-link.svg" alt="Copy link" width="14" height="14">
        </a>
        <a href="https://twitter.com/intent/tweet?text=<?= urlencode(get_the_title()) ?>&url=<?= get_the_permalink() ?>" target="_blank">
            <iconify-icon icon="fa6-brands:x-twitter"></iconify-icon>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= get_the_permalink() ?>" target="_blank">
            <iconify-icon icon="fa6-brands:facebook-f"></iconify-icon>
        </a>

        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= (get_the_title().' - '.get_the_permalink()) ?>" class="show-for-large" target="_blank">
            <iconify-icon icon="bi:linkedin"></iconify-icon>
        </a>

    </div>
</div>
