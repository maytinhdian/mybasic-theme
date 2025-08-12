<?php

/**
 * Template Name: TMT — Auth: Reset Password (Standalone)
 */

defined('ABSPATH') || exit;

$key   = isset($_GET['key'])   ? sanitize_text_field($_GET['key'])   : '';
$login = isset($_GET['login']) ? sanitize_text_field($_GET['login']) : '';

$user  = ($key && $login) ? check_password_reset_key($key, $login) : new WP_Error('invalid_key', 'Liên kết đặt lại không hợp lệ.');
$done  = false;
$err   = new WP_Error();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_admin_referer('tmt_resetpass');
    $pass1 = isset($_POST['pass1']) ? $_POST['pass1'] : '';
    $pass2 = isset($_POST['pass2']) ? $_POST['pass2'] : '';
    $login = isset($_POST['login']) ? sanitize_text_field($_POST['login']) : '';
    $key   = isset($_POST['key'])   ? sanitize_text_field($_POST['key'])   : '';
    $user  = check_password_reset_key($key, $login);

    if (is_wp_error($user)) {
        $err = $user;
    } elseif ($pass1 !== $pass2) {
        $err->add('password_reset_mismatch', 'Mật khẩu nhập lại không khớp.');
    } elseif (empty($pass1)) {
        $err->add('password_reset_empty', 'Vui lòng nhập mật khẩu.');
    } else {
        reset_password($user, $pass1);
        $done = true;
    }
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class('auth--reset'); ?>>
    <main class="auth__wrap">
        <section class="auth__card" role="region" aria-labelledby="auth-title">
            <h1 id="auth-title" class="auth__title">Đặt lại mật khẩu</h1>

            <?php if ($done): ?>
                <div class="auth__notice auth__notice--success">Mật khẩu đã được cập nhật.</div>
                <p class="auth__links">
                    <a href="<?php echo esc_url(home_url('/form-login/?reset=success')); ?>">Đến trang đăng nhập</a>
                </p>

            <?php elseif (is_wp_error($user)): ?>
                <div class="auth__notice auth__notice--error">
                    <?php foreach ($user->get_error_messages() as $m) echo esc_html($m) . '<br>'; ?>
                </div>

            <?php else: ?>
                <?php if ($err->has_errors()): ?>
                    <div class="auth__notice auth__notice--error">
                        <?php foreach ($err->get_error_messages() as $m) echo esc_html($m) . '<br>'; ?>
                    </div>
                <?php endif; ?>

                <form method="post" class="auth__form" novalidate>
                    <?php wp_nonce_field('tmt_resetpass'); ?>
                    <input type="hidden" name="login" value="<?php echo esc_attr($login); ?>">
                    <input type="hidden" name="key" value="<?php echo esc_attr($key); ?>">

                    <p class="auth__field">
                        <label for="pass1">Mật khẩu mới</label>
                        <input type="password" id="pass1" name="pass1" autocomplete="new-password">
                    </p>
                    <p class="auth__field">
                        <label for="pass2">Nhập lại mật khẩu</label>
                        <input type="password" id="pass2" name="pass2" autocomplete="new-password">
                    </p>

                    <div class="auth__actions">
                        <button type="submit" class="auth__btn">Cập nhật mật khẩu</button>
                    </div>
                </form>

                <p class="auth__links"><a href="<?php echo esc_url(home_url('/form-login/')); ?>">Hủy và quay lại đăng nhập</a></p>
            <?php endif; ?>
        </section>
    </main>
    <?php wp_footer(); ?>
</body>

</html>