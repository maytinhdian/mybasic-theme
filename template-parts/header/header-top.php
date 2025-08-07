<div class="header-top">

    <div class="header-top__cta">
        <a href="#"><i class="fa-solid fa-phone fa-shake"></i><?php echo '<span class="cta_text">' . wp_kses_post(get_theme_mod('cellphone_number_setting', '')) . '</span>'  ?></a>
    </div>
    <div class="header-top__logon">
        <?php
        get_template_part('template-parts/component/account', 'none', array());
        ?>
    </div>
</div>