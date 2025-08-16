<?php

namespace TMT\Theme\Woo;

if (! defined('ABSPATH')) exit;

class WC_Single_Product
{
    public static function boot()
    {
        // Chỉ chạy ở single product
        add_action('wp', [__CLASS__, 'setup']);
    }

    public static function setup()
    {
        if (! is_product()) return;

        // Gỡ các hook mặc định của Woo để tránh duplicate
        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

        // Lắp layout mới theo hook base
        add_action('woocommerce_before_single_product', [__CLASS__, 'part_before_product'], 5);
        add_action('woocommerce_before_single_product', [__CLASS__, 'part_breadcrumb'], 6);

        add_action('woocommerce_before_single_product_summary', [__CLASS__, 'part_product_gallery'], 10);

        add_action('woocommerce_single_product_summary', [__CLASS__, 'part_summary_open'], 1);
        add_action('woocommerce_single_product_summary', [__CLASS__, 'part_product_badges'], 5);
        add_action('woocommerce_single_product_summary', [__CLASS__, 'part_title_price'], 10);
        add_action('woocommerce_single_product_summary', [__CLASS__, 'part_rating'], 12);
        add_action('woocommerce_single_product_summary', [__CLASS__, 'part_short_desc'], 15);
        add_action('woocommerce_single_product_summary', [__CLASS__, 'part_add_to_cart'], 20);
        add_action('woocommerce_single_product_summary', [__CLASS__, 'part_meta'], 30);
        add_action('woocommerce_single_product_summary', [__CLASS__, 'part_summary_close'], 99);

        add_action('woocommerce_after_single_product_summary', [__CLASS__, 'part_tabs'], 10);
        add_action('woocommerce_after_single_product_summary', [__CLASS__, 'part_upsells'], 15);
        add_action('woocommerce_after_single_product_summary', [__CLASS__, 'part_related'], 20);

        add_action('woocommerce_after_single_product', [__CLASS__, 'part_after_product'], 100);

        // 1) Tắt sidebar WooCommerce (nếu theme dùng hook chuẩn Woo)
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

        // 2) Ẩn search form ở header khi gọi get_search_form()
        add_filter('get_search_form', function ($form) {
            return is_product() ? '' : $form; // trên single product trả về rỗng
        });
        // functions.php (hoặc trong Single_Product::setup())
        add_action('wp', function () {
            if (!is_product()) return;

            // 1) Gỡ sidebar của Woo
            remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

            // 2) Loại bỏ các body class buộc layout 2 cột của theme
            add_filter('body_class', function ($classes) {
                $remove = ['has-sidebar', 'right-sidebar', 'left-sidebar'];
                $classes = array_diff($classes, $remove);
                $classes[] = 'no-sidebar'; // class mới nếu theme có style cho full-width
                return $classes;
            });
        });


        // Thêm class wrapper cho body nếu cần CSS theo trang sản phẩm
        add_filter('body_class', function ($classes) {
            if (is_product()) $classes[] = 'tmt-single-product';
            return $classes;
        });
    }

    /** Helpers: gọi template parts */
    protected static function part($slug, $args = [])
    {
        wc_get_template_part('template-parts/woocommerce/single/' . $slug, null, ['args' => $args]);
    }

    public static function part_before_product()
    {
        self::part('before-product');
    }
    public static function part_breadcrumb()
    {
        self::part('breadcrumb');
    }

    public static function part_product_gallery()
    {
        self::part('product-gallery');
    }
    public static function part_summary_open()
    {
        self::part('product-summary-open');
    }
    public static function part_product_badges()
    {
        self::part('product-badges');
    }
    public static function part_title_price()
    {
        self::part('product-title-price');
    }
    public static function part_rating()
    {
        self::part('product-rating');
    }
    public static function part_short_desc()
    {
        self::part('product-short-desc');
    }
    public static function part_add_to_cart()
    {
        self::part('product-add-to-cart');
    }
    public static function part_meta()
    {
        self::part('product-meta');
    }
    public static function part_summary_close()
    {
        self::part('product-summary-close');
    }
    public static function part_tabs()
    {
        self::part('product-tabs');
    }
    public static function part_upsells()
    {
        self::part('product-upsells');
    }
    public static function part_related()
    {
        self::part('product-related');
    }
    public static function part_after_product()
    {
        self::part('after-product');
    }
}
