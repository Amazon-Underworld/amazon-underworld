<?php
get_header();

$name = get_post_meta(get_queried_object_id(),'display_', true);
$bio = get_post_meta(get_queried_object_id(),'full_biography', true);
$facebook =  get_post_meta(get_queried_object_id(),'facebook', true);
$instagram =  get_post_meta(get_queried_object_id(),'instagram', true);
$linkedin =  get_post_meta(get_queried_object_id(),'linkedin', true);
$avatar =  get_avatar(get_queried_object_id(), 186);
$email = get_queried_object()->user_email;
?>
</div>

<div class="index-wrapper">
    <div class="content container">
        <?php
            if(get_queried_object()->type === 'guest-author'){ ?>
                <div class="card-modal alignfull">
                    <div class="card-modal__body">
                    <button type="button" class="close-modal">
                    </button>
                        <figure class="card-modal__img">
                             <?php echo $avatar ?>
                        </figure>
                        <h1> <?php  echo substr(get_the_archive_title(), strpos(get_the_archive_title(), ': ') + 2);?> </h1>
                        <div class="card-modal__infos">
                            <p class="card-modal__description"><?php
                                _e(get_queried_object()->description, 'hacklabr');?>
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
                            <p><?= _e($bio,'hacklabr');?> </p>
                        </div>
                    </div>
                </div>
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

            <?php }
            else{
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

            <?php }
        ?>


    </div><!-- /.container -->
</div><!-- /.index-wrapper -->

<?php get_footer();
