<?php

/***
 * Theme setup function 
 * 
 */

function mybasic_setup_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');

    // Khai báo hỗ trợ WOOCOMMERCE 
    add_theme_support('woocommerce');
}
function mybasic_register_menus()
{
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'mybasic-theme'),
        'footer'  => esc_html__('Footer Menu', 'mybasic-theme'),
        'topbar'  => esc_html__('Top Quick Menu', 'mybasic-theme'),
    ));
}
function mytheme_theme_setup()
{
    mybasic_setup_theme_support();
    mybasic_register_menus();
}
add_action('after_setup_theme', 'mytheme_theme_setup');
