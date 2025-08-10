<div class="site-header__top">
    <div class="container header-top__wrapper">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'topbar',
            'container_class' => 'header-top__nav',
            'menu_class'     => 'menu-list',
            'fallback_cb'    => false
        ));
        ?>
        <div class="header-top__cta">
            <a href="#"><i class="fa-solid fa-phone "></i><?php echo '<span class="cta_text">' . wp_kses_post(get_theme_mod('cellphone_number_setting', '')) . '</span>'  ?></a>
        </div>
        <div class="flex-row">
            <div class="header-top__social">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"> <i class="fa-brands fa-linkedin"></i></a>
                <a href="#"> <i class="fa-brands fa-telegram"></i></a>
            </div>
        </div>
        <div class="header-top__user">
            <a href="#"><i class="fa-regular fa-user"></i></a>
        </div>
    </div>
</div>