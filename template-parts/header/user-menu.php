<?php

/**
 * User icon dropdown (login-aware)
 * Place: template-parts/header/user-menu.php
 */
$is_logged_in = is_user_logged_in();
$has_wc       = function_exists('wc_get_page_permalink');
$account_url  = $has_wc ? wc_get_page_permalink('myaccount') : admin_url('profile.php');
// $login_url    = $has_wc ? wp_login_url(home_url('/dang-nhap')) : wc_get_page_permalink('myaccount');
$login_url    = home_url('/dang-nhap');
$register_url = function_exists('wp_registration_url') ? wp_registration_url() : wp_login_url() . '?action=register';
$logout_url   = wp_logout_url(home_url('/dang-nhap'));
$user         = $is_logged_in ? wp_get_current_user() : null;
?>
<div class="user-menu" data-user-menu>
    <button class="user-menu__toggle" aria-expanded="false" aria-haspopup="true" aria-label="Tài khoản">
        <i class="fa-solid fa-user"></i>
        <?php if ($is_logged_in && $user): ?>
            <span class="user-menu__name"><?php echo esc_html($user->display_name); ?></span>
        <?php endif; ?>
        <i class="fa-solid fa-chevron-down user-menu__caret" aria-hidden="true"></i>
    </button>

    <ul class="user-menu__dropdown" role="menu">
        <?php if (! $is_logged_in): ?>
            <li role="none">
                <a role="menuitem" href="<?php echo esc_url($login_url); ?>">Đăng nhập</a>
            </li>
            <?php if (get_option('users_can_register')): ?>
                <li role="none">
                    <a role="menuitem" href="<?php echo esc_url($register_url); ?>">Đăng ký</a>
                </li>
            <?php endif; ?>
        <?php else: ?>
            <li role="none"><a role="menuitem" href="<?php echo esc_url($account_url); ?>">Tài khoản của tôi</a></li>
            <?php if ($has_wc): ?>
                <li role="none"><a role="menuitem" href="<?php echo esc_url(wc_get_endpoint_url('orders', '', $account_url)); ?>">Đơn hàng</a></li>
                <li role="none"><a role="menuitem" href="<?php echo esc_url(wc_get_endpoint_url('edit-address', '', $account_url)); ?>">Địa chỉ</a></li>
            <?php endif; ?>
            <li role="none"><a role="menuitem" href="<?php echo esc_url($logout_url); ?>">Đăng xuất</a></li>
        <?php endif; ?>
    </ul>
</div>