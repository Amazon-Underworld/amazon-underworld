<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head()?>
	<title><?= is_front_page() ? get_bloginfo('name') : wp_title()?></title>
	<link rel="icon" href="<?= get_site_icon_url() ?>" />
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header x-data="{ menuOpen: false, searchOpen: false }" class="main-header main-header-lateral" :class="{ 'main-header-lateral--menu-open': menuOpen, 'main-header-lateral--search-open': searchOpen }">
        <div class="container container--x-wide">
			<div class="main-header-lateral__content">
				<div class="main-header-lateral__logo">
                    <?php if ( has_custom_logo() ): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <a href="<?= home_url() ?>">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/logo-pos.svg" alt="<?= get_bloginfo( 'name' ) ?>">
                        </a>
                    <?php endif; ?>
				</div>

                <div class="main-header-lateral__desktop-content">
                    <?= wp_nav_menu(['theme_location' => 'main-menu', 'container' => 'nav', 'menu_class' => 'menu', 'container_class' => 'main-header-lateral__menu-desktop']) ?>
                </div>

                <div class="main-header-lateral__helper-content">

                    <div class="main-header-lateral__search" x-init="$watch('searchOpen', (isOpen) => isOpen && document.querySelector('#search').focus())">
                        <?php get_search_form(); ?>
                        <button type="button" class="main-header__toggle-search main-header-lateral__toggle-search" aria-label="<?= __( 'Toggle search form visibility', 'hacklabr' ) ?>" @click="searchOpen = !searchOpen">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/search-icon-pos.svg" alt="Search">
                        </button>
                    </div>

                    <div class="main-header-lateral__language-selector">
                        <div class="wpml-language-switcher">
                            <?php do_action('wpml_add_language_selector');?>
                        </div>
                    </div>
                </div>

                <button type="button" class="main-header__toggle-menu main-header-lateral__toggle-menu" aria-label="<?= __('Toggle menu visibility', 'hacklabr') ?>" @click="menuOpen = !menuOpen">
                    <svg class="hamburger" :class="{ 'hamburger--open': menuOpen }" role="img" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <title>Exibir menu</title>
                        <rect width="16" height="2" x="0" y="2"/>
                        <rect width="16" height="2" x="0" y="7"/>
                        <rect width="16" height="2" x="0" y="12"/>
                    </svg>
                </button>

                <?php do_action( 'hacklabr/header/menus-end' ); ?>
				</div>
			</div>
        </div>

        <div class="main-header-lateral__mobile-content">
            <div class="main-header-lateral__mobile-content-main">
            <?php
                get_template_part('template-parts/search-form');
                wp_nav_menu(['theme_location' => 'main-menu', 'container' => 'nav', 'menu_class' => 'menu', 'container_class' => 'main-header-lateral__menu-mobile']); ?>
            </div>
            <div class="main-header-lateral__mobile-social">
                <span class="follow-us"><?= _e('Follow us', 'hacklabr') ?></span>
                <?php the_social_networks_menu( false ); ?>
            </div>
        </div>
	</header>

	<div id="app">
