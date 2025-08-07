<?php
function mybasic_enqueue_styles()
{
    wp_enqueue_style('mybasic-style', get_stylesheet_uri());
    // CSS Owl-Carousel 
    // wp_enqueue_style('owl-carousel-css', get_template_directory_uri() . '/vendors/owl-carousel/owl.carousel.min.css');
    // wp_enqueue_style('owl-theme-css', get_template_directory_uri() . '/vendors/owl-carousel/owl.theme.default.min.css');
    // CSS Swiper
    wp_enqueue_style('swiper-css',  get_template_directory_uri()  . '/vendors/swiper/swiper-bundle.min.css');
    wp_enqueue_style(
        'fontawesome',
        get_template_directory_uri() . '/assets/css/all.min.css',
        [],
        '6.5.2' // phiên bản tải về
    );
}
add_action('wp_enqueue_scripts', 'mybasic_enqueue_styles');

function theme_enqueue_scripts()
{
    // JS Owl-Carousel 
    // wp_enqueue_script('jquery');
    // wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/vendors/owl-carousel/owl.carousel.min.js', array('jquery'), null, true);

    //JS Swiper
    wp_enqueue_script('swiper-js', get_template_directory_uri()  . '/vendors/swiper/swiper-bundle.min.js', array(), null, true);

    // Thêm file JS chính
    wp_enqueue_script(
        'theme-main-js', // handle
        get_template_directory_uri() . '/assets/js/main.js', // đường dẫn tới file
        array('swiper-js'), // dependencies (ví dụ: array('jquery','owl-carousel-js'))
        '1.0.0', // phiên bản
        true // in footer (nên để true)
    );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

//Kirki Framework
require_once get_template_directory() . '/inc/kirki/kirki.php';
require_once get_template_directory() . '/inc/customizer-kirki.php';

//Default theme setup 
require get_template_directory() . '/inc/theme-setup.php';
