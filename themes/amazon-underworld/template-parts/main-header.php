<header x-data="{ menuOpen: false, searchOpen: false }" class="main-header main-header-lateral main-header-lateral-secondary alignfull" :class="{ 'main-header-lateral--menu-open': menuOpen, 'main-header-lateral--search-open': searchOpen }">
    <div class="container container--x-wide">
        <div class="main-header-lateral__content main-header-lateral-secondary__content">
                <div class="main-header-lateral__logo main-header-lateral-secondary__logo">
                    <?php if ( has_custom_logo() ): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <a href="<?= home_url() ?>">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/logo-pos.svg" alt="<?= get_bloginfo( 'name' ) ?>">
                        </a>
                    <?php endif; ?>
                </div>

                <div class="main-header-lateral__desktop-content main-header-lateral-secondary__desktop-content">
                    <?= wp_nav_menu(['theme_location' => 'main-menu', 'container' => 'nav', 'menu_class' => 'menu', 'container_class' => 'main-header-lateral__menu-desktop main-header-lateral-secondary__menu-desktop']) ?>
                </div>

                <div class="main-header-lateral__search main-header-lateral-secondary__search" x-init="$watch('searchOpen', (isOpen) => isOpen && document.querySelector('#search').focus())">
                    <?php get_search_form(); ?>
                    <button type="button" class="main-header__toggle-search main-header-lateral__toggle-search" aria-label="<?= __( 'Toggle search form visibility', 'hacklabr' ) ?>" @click="searchOpen = !searchOpen">
                        <img src="<?= get_template_directory_uri() ?>/assets/images/search-icon-pos.svg" alt="Search">
                    </button>
                </div>

                <div class="main-header-lateral__language-selector main-header-lateral-secondary__language-selector">
                    <div class="wpml-language-switcher">
                        <?php do_action('wpml_add_language_selector');?>
                    </div>
                </div>

                <button type="button" class="main-header__toggle-menu main-header-lateral__toggle-menu main-header-lateral-secondary__toggle-menu" aria-label="<?= __('Toggle menu visibility', 'hacklabr') ?>" @click="menuOpen = !menuOpen">
                    <svg class="hamburger" :class="{ 'hamburger--open': menuOpen }" role="img" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <title>Exibir menu</title>
                        <rect width="16" height="2" x="0" y="2"/>
                        <rect width="16" height="2" x="0" y="7"/>
                        <rect width="16" height="2" x="0" y="12"/>
                    </svg>
                </button>
        </div>
    </div>

    <div class="main-header-lateral__mobile-content main-header-lateral-secondary__mobile-content">
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
    <?php do_action( 'hacklabr/header/menus-end' ); ?>

</header>