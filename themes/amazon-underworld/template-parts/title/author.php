<?php
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
<header class="c-title title-author">
        <h1 class="entry-title title-author__name">
            <?php  echo substr(get_the_archive_title(), strpos(get_the_archive_title(), ': ') + 2);?>
        </h1>
        <div class="title-author__infos">
            <p><?php  _e(get_queried_object()->description, 'hacklabr');?></p>
            <span class="title-author__social-network">
                <a href="<?= $linkedin ?>"> <?php _e('Linkedin, ', 'hacklabr');?></a>
                <a href="<?= $instagram ?>"> <?php _e('Instagram, ', 'hacklabr');?></a>
                <a href="<?= $facebook ?>"> <?php _e('Facebook', 'hacklabr');?></a>
            </span>
        </div>
        <div class="title-author__bio">
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

</header><!-- /.c-title.title-default -->
