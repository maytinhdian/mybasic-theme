<?php

/**
 * Template Name: TMT — Standalone Login Form
 * Description: Form đăng nhập chỉ hiển thị nội dung form, không header/footer, style scoped.
 */

namespace TMT\Theme;

defined('ABSPATH') || exit;

// Nếu đã đăng nhập thì chuyển hướng
if (is_user_logged_in()) {
    wp_safe_redirect(home_url('/my-account/'));
    exit;
}

$redirect_to = isset($_GET['redirect_to']) ? esc_url_raw($_GET['redirect_to']) : home_url('/my-account/');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('tmt-login-standalone'); ?>>
    <div class="tmt-login-standalone__wrapper">
        <div class="tmt-login-standalone__box">
            <h1 class="tmt-login-standalone__title">Đăng nhập</h1>
            <?php
            if (isset($_GET['login']) && $_GET['login'] === 'failed') {
                echo '<div class="tmt-login-standalone__notice tmt-login-standalone__notice--error">
            Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng thử lại.
          </div>';
            }
            ?>
            <?php
            wp_login_form([
                'redirect'       => $redirect_to,
                'form_id'        => 'tmt-loginform',
                'label_username' => 'Tên đăng nhập hoặc Email',
                'label_password' => 'Mật khẩu',
                'label_remember' => 'Ghi nhớ',
                'label_log_in'   => 'Đăng nhập',
                'remember'       => true,
                'value_remember' => true,
            ]);
            ?>
            <div class="tmt-login-standalone__links">
                <a href="<?php echo esc_url(wp_lostpassword_url($redirect_to)); ?>">Quên mật khẩu?</a>
                <?php if (get_option('users_can_register')): ?>
                    · <a href="<?php echo esc_url(wp_registration_url()); ?>">Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>

</html>