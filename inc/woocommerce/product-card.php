<?php
namespace TMT\Theme;

defined('ABSPATH') || exit;

class WC_Product_Card {
    public static function boot(): void {
        // Cho phép tắt/bật bằng filter nếu cần
        if (false === apply_filters('tmt_wc_product_card_enabled', true)) return;

        // Gỡ mặc định
        add_action('init', [__CLASS__, 'unhook_defaults']);

        // Bơm markup mới
        add_action('woocommerce_before_shop_loop_item',        [__CLASS__, 'open_card'], 1);
        add_action('woocommerce_before_shop_loop_item_title',  [__CLASS__, 'media'], 10);
        add_action('woocommerce_shop_loop_item_title',         [__CLASS__, 'title'], 10);
        add_action('woocommerce_after_shop_loop_item_title',   [__CLASS__, 'meta'], 10);
        add_action('woocommerce_after_shop_loop_item',         [__CLASS__, 'actions'], 20);
        add_action('woocommerce_after_shop_loop_item',         [__CLASS__, 'close_card'], 99);
    }

    public static function unhook_defaults(): void {
        remove_action('woocommerce_before_shop_loop_item',        'woocommerce_template_loop_product_link_open', 10);
        remove_action('woocommerce_before_shop_loop_item_title',  'woocommerce_show_product_loop_sale_flash',   10);
        remove_action('woocommerce_before_shop_loop_item_title',  'woocommerce_template_loop_product_thumbnail',10);
        remove_action('woocommerce_shop_loop_item_title',         'woocommerce_template_loop_product_title',    10);
        remove_action('woocommerce_after_shop_loop_item_title',   'woocommerce_template_loop_rating',           5);
        remove_action('woocommerce_after_shop_loop_item_title',   'woocommerce_template_loop_price',            10);
        remove_action('woocommerce_after_shop_loop_item',         'woocommerce_template_loop_product_link_close',5);
        remove_action('woocommerce_after_shop_loop_item',         'woocommerce_template_loop_add_to_cart',      10);
    }

    private static function guard(): bool {
        global $product;
        if (!is_a($product, \WC_Product::class) || !$product->is_visible()) return false;

        // Ví dụ chỉ áp dụng cho shop & category (bỏ nếu muốn áp mọi nơi)
        if (! (is_shop() || is_product_taxonomy())) return false;
        return true;
    }

    public static function open_card(): void {
        if (!self::guard()) return;
        echo '<article class="product-card product-card--yb">';
    }

    public static function media(): void {
        if (!self::guard()) return;
        global $product;
        $permalink = get_permalink($product->get_id());
        $img = $product->get_image('woocommerce_thumbnail', ['class'=>'product-card__img'], false);

        // Badge %
        $badge = '';
        $reg = (float)$product->get_regular_price();
        $sale = (float)$product->get_sale_price();
        if ($product->is_on_sale() && $reg > 0 && $sale > 0 && $sale < $reg) {
            $pct = round((($reg - $sale) / $reg) * 100);
            $badge .= '<span class="product-card__badge product-card__badge--sale">-' . esc_html($pct) . '%</span>';
        }
        // NEW/HOT demo (bạn có thể thay bằng logic tag/attr riêng)
        $badge .= '<span class="product-card__badge product-card__badge--new">NEW</span>';

        // Hết hàng
        $oos = $product->is_in_stock() ? '' : '<span class="product-card__badge product-card__badge--oos">Hết hàng</span>';

        echo '<div class="product-card__media">';
        echo '<div class="product-card__badges">'.$badge.'</div>'.$oos;
        echo '<a class="product-card__image" href="'.esc_url($permalink).'">'.$img.'</a>';
        echo '</div>';
    }

    public static function title(): void {
        if (!self::guard()) return;
        echo '<h3 class="product-card__title"><a href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title()).'</a></h3>';
        // Excerpt ngắn (2–3 dòng)
        $excerpt = wp_strip_all_tags( get_the_excerpt() ?: get_post_meta(get_the_ID(), '_short_description', true) );
        if ($excerpt) {
            echo '<p class="product-card__excerpt">'.esc_html($excerpt).'</p>';
        }
    }

    public static function meta(): void {
        if (!self::guard()) return;
        global $product;
        $rating = function_exists('wc_get_rating_html') ? wc_get_rating_html((float)$product->get_average_rating()) : '';
        echo '<div class="product-card__meta">';
        if ($rating) echo '<div class="product-card__rating">'.$rating.'</div>';
        echo '<div class="product-card__price">'.$product->get_price_html().'</div>';
        echo '</div>';
    }

    public static function actions(): void {
        if (!self::guard()) return;
        echo '<div class="product-card__actions">';
        \woocommerce_template_loop_add_to_cart();
        echo '</div>';
    }

    public static function close_card(): void {
        if (!self::guard()) return;
        echo '</article>';
    }
}
