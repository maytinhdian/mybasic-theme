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

//Register Sidebar 
add_action('widgets_init', function () {
    register_sidebar([
        'name'          => __('Primary Sidebar', 'tmt'),
        'id'            => 'primary',
        'description'   => __('Main sidebar area', 'tmt'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
});

//Kirki Framework
require_once get_template_directory() . '/inc/kirki/kirki.php';
require_once get_template_directory() . '/inc/customizer-kirki.php';

//Default theme setup 
require get_template_directory() . '/inc/theme-setup.php';

// Custom icon cho menu
require get_template_directory() . '/inc/menu-icons.php';

// Custom login page
// require get_template_directory() . '/inc/login-page.php';
// require get_template_directory() . '/inc/login-route.php';


// 1) Login fail -> quay lại trang login custom, giữ redirect_to nếu có
add_action('wp_login_failed', function ($username) {
    $login_page  = home_url('/form-login/');
    $redirect_to = isset($_POST['redirect_to']) ? esc_url_raw($_POST['redirect_to']) : '';
    $url = add_query_arg(['login' => 'failed'], $login_page);
    if ($redirect_to) $url = add_query_arg(['redirect_to' => $redirect_to], $url);
    wp_safe_redirect($url);
    exit;
});

// 2) Đổi link trong email reset về trang custom /reset-password/
add_filter('retrieve_password_message', function ($message, $key, $user_login, $user_data) {
    $reset_url = add_query_arg(['key' => $key, 'login' => rawurlencode($user_login)], home_url('/reset-password/'));
    $site = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
    $msg  = "Xin chào {$user_login},\n\n";
    $msg .= "Bạn vừa yêu cầu đặt lại mật khẩu trên {$site}.\n";
    $msg .= "Nhấp vào liên kết sau để đặt lại mật khẩu:\n{$reset_url}\n\n";
    $msg .= "Nếu không phải bạn yêu cầu, hãy bỏ qua email này.\n";
    return $msg;
}, 10, 4);

// (Tuỳ chọn) Nếu chưa đăng nhập mà vào /wp-admin, chuyển về form custom
add_filter('login_redirect', function ($redirect_to, $request, $user) {
    if (isset($user->ID)) return $redirect_to; // đăng nhập OK
    return $redirect_to;
}, 10, 3);


//Woocommerce Initial Setup 
require_once get_stylesheet_directory() . '/inc/woocommerce-setup.php';
\TMT\Theme\Woo\Setup::boot();
