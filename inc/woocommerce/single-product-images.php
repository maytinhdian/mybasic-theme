<?php

namespace TMT\Theme\Woo;

defined('ABSPATH') || exit;

class Single_Product_Images
{
    public static function boot()
    {
        // Bỏ renderer ảnh mặc định của Woo
        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

        // Render gallery theo hook-base của mình
        add_action('woocommerce_before_single_product_summary', [__CLASS__, 'render_gallery'], 20);

        // Đăng ký các "slot" con (hook nội bộ của mình)
        add_action('tmt/sp_gallery/before', [__CLASS__, 'sale_badge'], 5);
        add_action('tmt/sp_gallery/primary', [__CLASS__, 'primary_image'], 10);
        add_action('tmt/sp_gallery/controls', [__CLASS__, 'thumb_strip'], 10);

        // Bạn có thể thêm/tắt những thành phần khác ở đây:
        // add_action('tmt/sp_gallery/overlays', [__CLASS__, 'video_button'], 20);
        // add_action('tmt/sp_gallery/overlays', [__CLASS__, 'zoom_button'], 25);
    }

    /** Khung ngoài toàn bộ gallery (hook-base) */
    public static function render_gallery()
    {
        if (!function_exists('wc_get_product')) return;
        global $product;
        if (!$product instanceof \WC_Product) return;

        $columns = 4; // bạn có thể cho đọc từ option/theme_mod

        echo '<div class="tmt-sp__gallery">';
        echo    '<div class="woocommerce-product-gallery images woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-' . esc_attr($columns) . '" data-columns="' . esc_attr($columns) . '">';

        // Slot: trước ảnh chính (badge, sticker…)
        do_action('tmt/sp_gallery/before', $product);

        // Slot: ảnh chính
        echo '<figure class="woocommerce-product-gallery__wrapper">';
        do_action('tmt/sp_gallery/primary', $product);
        echo '</figure>';

        // Slot: overlay (nút zoom, video… nếu cần)
        echo '<div class="tmt-sp__gallery-overlays">';
        do_action('tmt/sp_gallery/overlays', $product);
        echo '</div>';

        // Slot: dải thumbnail / điều khiển
        echo '<div class="tmt-sp__gallery-controls">';
        do_action('tmt/sp_gallery/controls', $product, $columns);
        echo '</div>';

        echo    '</div>';
        echo '</div>';
    }

    /** Badge Sale (thay vì để hook mặc định) */
    public static function sale_badge(\WC_Product $product)
    {
        if ($product->is_on_sale()) {
            echo '<span class="tmt-sp__badge tmt-sp__badge--sale">' . esc_html__('Sale', 'your-textdomain') . '</span>';
        }
    }

    /** Ảnh chính */
    public static function primary_image(\WC_Product $product)
    {
        $post_thumbnail_id = $product->get_image_id();

        if ($post_thumbnail_id) {
            $img_html = wp_get_attachment_image(
                $post_thumbnail_id,
                'large',
                false,
                array(
                    'class' => 'wp-post-image',
                    'title' => get_post_field('post_title', $post_thumbnail_id),
                    'data-thumb' => wp_get_attachment_image_url($post_thumbnail_id, 'thumbnail')
                )
            );
        } else {
            $img_html = wc_placeholder_img('large');
        }

        // Bao ảnh trong thẻ a để bật lightbox (nếu bạn dùng PhotoSwipe/GLightbox…)
        $full_url = wp_get_attachment_image_url($post_thumbnail_id, 'full');
        if ($full_url) {
            echo '<a href="' . esc_url($full_url) . '" class="tmt-sp__image-link" data-lightbox="product">';
            echo $img_html;
            echo '</a>';
        } else {
            echo $img_html;
        }
    }

    /** Dải thumbnail */
    public static function thumb_strip(\WC_Product $product, $columns = 4)
    {
        $attachment_ids = $product->get_gallery_image_ids();
        if (empty($attachment_ids)) return;

        echo '<div class="tmt-sp__thumbs tmt-grid tmt-grid--cols-' . esc_attr($columns) . '">';
        foreach ($attachment_ids as $attachment_id) {
            $thumb = wp_get_attachment_image($attachment_id, 'thumbnail', false, [
                'class' => 'tmt-sp__thumb',
                'data-full' => wp_get_attachment_image_url($attachment_id, 'full'),
            ]);
            echo '<button class="tmt-sp__thumb-item" type="button" aria-label="' . esc_attr__('Xem ảnh', 'your-textdomain') . '">';
            echo $thumb;
            echo '</button>';
        }
        echo '</div>';
    }

    /** Ví dụ nút Video overlay (tùy chọn) */
    public static function video_button(\WC_Product $product)
    {
        $video_url = get_post_meta($product->get_id(), '_tmt_video_url', true);
        if (!$video_url) return;

        echo '<button class="tmt-sp__btn tmt-sp__btn--video" data-video="' . esc_url($video_url) . '" type="button" aria-label="' . esc_attr__('Xem video', 'your-textdomain') . '">';
        echo esc_html__('Video', 'your-textdomain');
        echo '</button>';
    }

    /** Ví dụ nút Zoom overlay (tùy chọn) */
    public static function zoom_button(\WC_Product $product)
    {
        echo '<button class="tmt-sp__btn tmt-sp__btn--zoom" type="button" aria-label="' . esc_attr__('Phóng to', 'your-textdomain') . '">Zoom</button>';
    }
}
