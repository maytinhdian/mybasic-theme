    <nav class="nav-bar">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'top-bar',
            'container'      => false,
            'menu_class'     => 'flex-row quick-link menu-list',
            'fallback_cb'    => false
        ));
        ?>
    </nav>
    <div class="header-top__cta">
        <a href="#"><i class="fa-solid fa-phone fa-shake"></i><?php echo '<span class="cta_text">' . wp_kses_post(get_theme_mod('cellphone_number_setting', '')) . '</span>'  ?></a>
    </div>