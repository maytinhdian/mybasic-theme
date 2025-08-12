<?php

/**
 * Template Name: TMT — Auth: Login (Standalone)
 * Description: Trang đăng nhập standalone, BEM style.
 */

defined('ABSPATH') || exit;

// Đã đăng nhập thì chuyển về my-account (sửa theo nhu cầu)
if (is_user_logged_in()) {
    wp_safe_redirect(home_url('/my-account/'));
    exit;
}

$redirect_to = isset($_GET['redirect_to']) ? esc_url_raw($_GET['redirect_to']) : home_url('/my-account/');
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class('auth--login'); ?>>
    <main class="auth__wrap">
        <section class="auth__card" role="region" aria-labelledby="auth-title">
            <h1 id="auth-title" class="auth__title">Đăng nhập</h1>

            <?php if (isset($_GET['login']) && $_GET['login'] === 'failed'): ?>
                <div class="auth__notice auth__notice--error">Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng thử lại.</div>
            <?php elseif (isset($_GET['reset']) && $_GET['reset'] === 'success'): ?>
                <div class="auth__notice auth__notice--success">Mật khẩu đã được cập nhật. Hãy đăng nhập.</div>
            <?php endif; ?>

            <?php
            // Render form WP, rồi mình tối ưu DOM bằng CSS theo ID/structure mặc định
            wp_login_form([
                'redirect'       => $redirect_to,
                'form_id'        => 'auth-loginform',
                'label_username' => 'Tên đăng nhập hoặc Email',
                'label_password' => 'Mật khẩu',
                'label_remember' => 'Ghi nhớ',
                'label_log_in'   => 'Đăng nhập',
                'remember'       => true,
                'value_remember' => true,
            ]);
            ?>

            <div class="auth__links">
                <a href="<?php echo esc_url(home_url('/lost-password/')); ?>">Quên mật khẩu?</a>
                <?php if (get_option('users_can_register')): ?>
                    · <a href="<?php echo esc_url(wp_registration_url()); ?>">Đăng ký</a>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php wp_footer(); ?>
</body>

</html>