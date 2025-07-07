<?php
get_header();

$name = get_post_meta(get_queried_object_id(),'display_', true);
$bio_en = get_post_meta(get_queried_object_id(),'full_biography', true);
$bio_es = get_post_meta(get_queried_object_id(),'full_biography_es', true);
$bio_pt = get_post_meta(get_queried_object_id(),'full_biography_pt_br', true);
$description_es = get_post_meta(get_queried_object_id(),'info_bio_es', true);
$description_pt = get_post_meta(get_queried_object_id(),'info_bio_pt_br', true);
$facebook =  get_post_meta(get_queried_object_id(),'facebook', true);
$instagram =  get_post_meta(get_queried_object_id(),'instagram', true);
$linkedin =  get_post_meta(get_queried_object_id(),'linkedin', true);
$avatar =  get_avatar(get_queried_object_id(), 365);
$email = get_queried_object()->user_email;
$locale = get_locale();

?>
<div class="index-wrapper">
    <div class="content container">
        <?php
            get_template_part( 'template-parts/title/author' ); ?>
            <main class="">
                <?php
                while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/content/post' ); ?>
                <?php endwhile; ?>

                <?php get_template_part( 'template-parts/content/pagination' ); ?>
            </main>

            <aside class="">
                <?php dynamic_sidebar( 'sidebar-default' ) ?>
            </aside>
    </div><!-- /.container -->
</div><!-- /.index-wrapper -->

</div>
    <div class="card-modal alignfull">
        <div class="card-modal__body" id="modal-card-body">
        <button type="button" class="close-modal">
        </button>
            <figure class="card-modal__img">
                    <?php echo $avatar ?>
            </figure>
            <h1 class="card-modal__title"> <?php  echo substr(get_the_archive_title(), strpos(get_the_archive_title(), ': ') + 2);?> </h1>
            <div class="card-modal__infos">
                <p class="card-modal__description">
                <?php if($locale === 'en_US'){ ?>
                    <p><?= _e(get_queried_object()->description, 'hacklabr');?> </p>
                <?php }
                elseif($locale === 'pt_BR'){?>
                    <p><?= _e($description_pt,'hacklabr');?> </p>
                <?php }
                else{ ?>
                    <p><?= _e($description_es,'hacklabr');?> </p>
                <?php } ?>

                </p>
                <p class="card-modal__email"><?php
                    _e($email, 'hacklabr');?>
                </p>
                <span class="card-modal__social-network">
                    <a href="<?= $linkedin ?>"> <?php _e('Linkedin, ', 'hacklabr');?></a>
                    <a href="<?= $instagram ?>"> <?php _e('Instagram, ', 'hacklabr');?></a>
                    <a href="<?= $facebook ?>"> <?php _e('Facebook', 'hacklabr');?></a>
                </span>
            </div>

            <button class="card-modal__close"><?= _e('See articles');?></button>

            <div class="card-modal__bio">
                <?php if($locale === 'en_US'){ ?>
                    <p><?= _e($bio_en,'hacklabr');?> </p>
                <?php }
                elseif($locale === 'pt_BR'){?>
                    <p><?= _e($bio_pt,'hacklabr');?> </p>
                <?php }
                else{ ?>
                    <p><?= _e($bio_es,'hacklabr');?> </p>
                <?php } ?>
            </div>
        </div>
    </div>

<?php get_footer();
