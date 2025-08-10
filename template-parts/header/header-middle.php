<div class="site-header__middle">
    <div class="container header-middle__wrapper">
        <div class="site-header__branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__title">
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
        </div>
        <?php get_search_form(); ?>
        <nav class="site-nav" role="navigation" aria-label="<?php esc_attr_e('Main Menu', 'mybasic_theme'); ?>">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'site-nav__menu',
                'fallback_cb'    => false
            ));
            ?>
        </nav>
    </div>
</div>