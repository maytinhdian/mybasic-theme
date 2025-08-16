<?php

namespace TMT\Theme\Woo;

if (!defined('ABSPATH')) exit;

final class WC_Checkout
{
    public static function boot()
    {
        if (!class_exists('WooCommerce')) return;
        add_action('wp', [__CLASS__, 'setup']);
        // add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue']);
    }

    public static function setup()
    {
        if (!is_checkout() || is_order_received_page()) return;

        // Dời form đăng nhập & coupon vào cột trái
        remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10);
        remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);



        // Khung/columns
        add_action('woocommerce_before_checkout_form', [__CLASS__, 'open_wrapper'], 1);
        add_action('woocommerce_before_checkout_form', [__CLASS__, 'header'], 2);

        add_action('woocommerce_checkout_before_customer_details', [__CLASS__, 'open_left_col'], 0);
        add_action('woocommerce_checkout_before_customer_details', [__CLASS__, 'left_col_top'], 1);
        add_action('woocommerce_checkout_after_customer_details',  [__CLASS__, 'left_col_bottom'], 998);
        add_action('woocommerce_checkout_after_customer_details',  [__CLASS__, 'close_left_col'], 999);

        add_action('woocommerce_checkout_before_order_review', [__CLASS__, 'open_right_col'], 0);
        add_action('woocommerce_checkout_after_order_review',  [__CLASS__, 'close_right_col'], 999);

        add_action('woocommerce_after_checkout_form', [__CLASS__, 'close_wrapper'], 999);

        // Gắn lại login/coupon vào nhóm hook nội bộ của cột trái
        add_action('tmt/checkout/left/top', 'woocommerce_checkout_login_form', 10);
        add_action('tmt/checkout/left/top', 'woocommerce_checkout_coupon_form', 20);

        // Chỉnh field: class, placeholder, width
        add_filter('woocommerce_checkout_fields', [__CLASS__, 'filter_checkout_fields']);
        add_filter('woocommerce_default_address_fields', [__CLASS__, 'filter_address_fields']);
    }

    /** Assets (đặt tên handle theo theme của bạn) */
    public static function enqueue()
    {
        if (!is_checkout()) return;
        // Giả sử file CSS đã biên dịch về: assets/css/woocommerce-checkout.css
        wp_enqueue_style('tmt-woocommerce-checkout', get_stylesheet_directory_uri() . '/assets/css/woocommerce-checkout.css', [], '1.0');
    }

    /** Markup wrappers */
    public static function open_wrapper()
    {
        get_template_part('template-parts/woocommerce/checkout/wrapper', 'open');
    }
    public static function close_wrapper()
    {
        get_template_part('template-parts/woocommerce/checkout/wrapper', 'close');
    }
    public static function header()
    {
        get_template_part('template-parts/woocommerce/checkout/header');
    }

    public static function open_left_col()
    {
        get_template_part('template-parts/woocommerce/checkout/left', 'open');
    }
    public static function left_col_top()
    {
        do_action('tmt/checkout/left/top');
    }
    public static function left_col_bottom()
    {
        get_template_part('template-parts/woocommerce/checkout/left', 'bottom');
    }
    public static function close_left_col()
    {
        get_template_part('template-parts/woocommerce/checkout/left', 'close');
    }

    public static function open_right_col()
    {
        get_template_part('template-parts/woocommerce/checkout/right', 'open');
    }
    public static function close_right_col()
    {
        get_template_part('template-parts/woocommerce/checkout/right', 'close');
    }

    /** Field cosmetics */
    public static function filter_checkout_fields($fields)
    {
        foreach ($fields as $section => &$group) {
            foreach ($group as $key => &$f) {
                $f['input_class']  = array_merge($f['input_class'] ?? [], ['tmt-input']);
                $f['label_class']  = array_merge($f['label_class'] ?? [], ['tmt-label']);
                $f['class']        = array_merge($f['class'] ?? [], ['tmt-field']);
                if (empty($f['placeholder']) && !empty($f['label'])) {
                    $f['placeholder'] = wp_strip_all_tags($f['label']);
                }
            }
        }
        return $fields;
    }

    public static function filter_address_fields($fields)
    {
        // Gợi ý width 1/2 cho vài trường; phần SCSS sẽ xử lý theo class
        foreach (['first_name', 'last_name', 'city', 'state', 'postcode', 'phone'] as $k) {
            if (isset($fields[$k])) $fields[$k]['class'][] = 'tmt-col-6';
        }
        return $fields;
    }
}
