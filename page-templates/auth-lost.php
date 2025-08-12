<?php
/**
 * Template Name: TMT — Auth: Lost Password (Standalone)
 */

defined('ABSPATH') || exit;

$done   = false;
$errors = new WP_Error();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  check_admin_referer('tmt_lostpassword');
  $user_login = isset($_POST['user_login']) ? sanitize_text_field($_POST['user_login']) : '';
  if (empty($user_login)) {
    $errors->add('empty_login', 'Vui lòng nhập email hoặc tên đăng nhập.');
  } else {
    $result = retrieve_password($user_login);
    if (is_wp_error($result)) $errors = $result; else $done = true;
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
<body <?php body_class('auth--lost'); ?>>
  <main class="auth__wrap">
    <section class="auth__card" role="region" aria-labelledby="auth-title">
      <h1 id="auth-title" class="auth__title">Quên mật khẩu</h1>

      <?php if ($done): ?>
        <div class="auth__notice auth__notice--success">Nếu thông tin hợp lệ, email đặt lại mật khẩu đã được gửi.</div>
        <p class="auth__links"><a href="<?php echo esc_url( home_url('/form-login/') ); ?>">Quay lại đăng nhập</a></p>
      <?php else: ?>
        <?php if ($errors->has_errors()): ?>
          <div class="auth__notice auth__notice--error">
            <?php foreach ($errors->get_error_messages() as $m) echo esc_html($m) . '<br>'; ?>
          </div>
        <?php endif; ?>

        <form method="post" class="auth__form" novalidate>
          <?php wp_nonce_field('tmt_lostpassword'); ?>
          <p class="auth__field">
            <label for="user_login">Email hoặc Tên đăng nhập</label>
            <input type="text" id="user_login" name="user_login" autocomplete="username">
          </p>

          <!-- (Tuỳ chọn) reCAPTCHA ở đây -->

          <div class="auth__actions">
            <button type="submit" class="auth__btn">Gửi liên kết đặt lại</button>
          </div>
        </form>

        <p class="auth__links"><a href="<?php echo esc_url( home_url('/form-login/') ); ?>">Quay lại đăng nhập</a></p>
      <?php endif; ?>
    </section>
  </main>
<?php wp_footer(); ?>
</body>
</html>
