<?php

/**
 * Theme WooCommerce setup
 */

namespace TMT\Theme\Woo;

if (!defined('ABSPATH')) exit;

final class Setup
{
    private static bool $booted = false; // ✅ Thêm biến tĩnh

    public static function boot(): void
    {
        // ✅ Nếu đã boot rồi thì thoát luôn
        if (self::$booted) return;
        self::$booted = true;

        // Không làm gì nếu WooCommerce chưa kích hoạt
        if (!class_exists('WooCommerce')) return;

        // Đăng ký hỗ trợ theme
        add_action('after_setup_theme', [__CLASS__, 'theme_support'], 11);

        // Khởi tạo các thành phần/hook con
        add_action('init', [__CLASS__, 'init_components']);

        // Tabs single product
        add_filter('woocommerce_product_tabs', [__CLASS__, 'filter_tabs'], 20);

        // Layout tabs nội bộ (nếu bạn có filter này trong theme)
        add_filter('tmt_tabs_layout', [__CLASS__, 'tabs_layout']);

        // Nút checkout
        add_filter('woocommerce_order_button_html', [__CLASS__, 'order_button_html'], 10, 1);
    }

    public static function theme_support(): void
    {
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }

    public static function init_components(): void
    {

        // Gỡ sidebar WooCommerce
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

        // Ưu tiên autoload PSR-4 nếu có. Nếu chưa, fallback require file.
        // Dùng get_stylesheet_directory() để child theme có thể override.
        $base = trailingslashit(get_stylesheet_directory()) . 'template-parts/woocommerce/';

        $card   = $base . 'product-card.php';
        $single = $base . 'single-product.php';

        if (is_readable($card)) {
            require_once $card;
            if (class_exists(\TMT\Theme\Woo\WC_Product_Card::class)) {
                \TMT\Theme\Woo\WC_Product_Card::boot();
            }
        }

        if (is_readable($single)) {
            require_once $single;
            if (class_exists(\TMT\Theme\Woo\WC_Single_Product::class)) {
                \TMT\Theme\Woo\WC_Single_Product::boot();
            }
        }
    }

    public static function filter_tabs(array $tabs): array
    {
        // Ví dụ tuỳ biến:
        // unset($tabs['additional_information']);
        // $tabs['video'] = [
        //     'title'    => __('Video', 'tmt'),
        //     'priority' => 50,
        //     'callback' => [__CLASS__, 'render_video_tab'],
        // ];
        return $tabs;
    }

    public static function tabs_layout(string $layout): string
    {
        // 'horizontal' | 'accordion' | 'vertical'
        return 'horizontal';
    }

    public static function order_button_html(string $html): string
    {
        return str_replace('button alt', 'tmt-btn checkout-button', $html);
    }

    // public static function render_video_tab() { echo '...'; }
}

// Khởi động
Setup::boot();
