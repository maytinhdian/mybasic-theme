<?php

namespace TMT\Theme\Woo;

defined('ABSPATH') || exit;

class WC_Product_Card
{
    private static bool $booted = false;

    public static function boot(): void
    {
        if (self::$booted) return;
        self::$booted = true;

        if (false === apply_filters('tmt_wc_product_card_enabled', true)) return;

        // 1) Gỡ hook mặc định NGAY LẬP TỨC (Woo đã load wc-template-hooks ở plugin load)
        self::unhook_defaults();

        // 2) Gỡ lại SỚM ở init (phòng plugin/theme khác gắn thêm)
        add_action('init', [__CLASS__, 'unhook_defaults'], 0);

        // 3) (Tùy chọn) Gỡ “cứng” mọi callback mặc định còn sót trước khi render mỗi loop
        add_action('woocommerce_before_shop_loop', [__CLASS__, 'nuclear_unhook'], 0);
        add_action('woocommerce_before_single_product', [__CLASS__, 'nuclear_unhook'], 0); // nếu có loop upsells/related

        // 4) Gắn markup mới – CHỈ 1 LẦN
        add_action('woocommerce_before_shop_loop_item',        [__CLASS__, 'open_card'], 1);
        add_action('woocommerce_before_shop_loop_item_title',  [__CLASS__, 'media'], 10);
        add_action('woocommerce_shop_loop_item_title',         [__CLASS__, 'title'], 10);
        add_action('woocommerce_after_shop_loop_item_title',   [__CLASS__, 'meta'], 10);
        add_action('woocommerce_after_shop_loop_item',         [__CLASS__, 'actions'], 20);
        add_action('woocommerce_after_shop_loop_item',         [__CLASS__, 'close_card'], 99);

        // 1) Sửa markup nút add-to-cart trước khi render (phòng trường hợp theme đổi text thành VIEW CART)
        add_filter('woocommerce_loop_add_to_cart_link', [__CLASS__, 'filter_loop_add_to_cart_link'], 10, 3);

        // 2) Chặn Woo thêm link "View cart" bằng cách sửa tham số JS được localize
        add_filter('woocommerce_get_script_data', [__CLASS__, 'filter_wc_script_data'], 10, 3);
    }

    public static function unhook_defaults(): void
    {
        // Gỡ các template mặc định của Woo
        remove_action('woocommerce_before_shop_loop_item',        'woocommerce_template_loop_product_link_open', 10);
        remove_action('woocommerce_before_shop_loop_item_title',  'woocommerce_show_product_loop_sale_flash',   10);
        remove_action('woocommerce_before_shop_loop_item_title',  'woocommerce_template_loop_product_thumbnail', 10);
        remove_action('woocommerce_shop_loop_item_title',         'woocommerce_template_loop_product_title',    10);
        remove_action('woocommerce_after_shop_loop_item_title',   'woocommerce_template_loop_rating',           5);
        remove_action('woocommerce_after_shop_loop_item_title',   'woocommerce_template_loop_price',            10);
        remove_action('woocommerce_after_shop_loop_item',         'woocommerce_template_loop_product_link_close', 5);
        remove_action('woocommerce_after_shop_loop_item',         'woocommerce_template_loop_add_to_cart',      10);
    }

    // “Nuclear option” – đảm bảo không còn callback nào khác dính vào 4 hook loop
    public static function nuclear_unhook(): void
    {
        // Nếu vẫn còn double, mở 4 dòng dưới (xóa mọi callback ở các hook vòng lặp)
        // remove_all_actions('woocommerce_before_shop_loop_item');
        // remove_all_actions('woocommerce_before_shop_loop_item_title');
        // remove_all_actions('woocommerce_shop_loop_item_title');
        // remove_all_actions('woocommerce_after_shop_loop_item_title');
        // remove_all_actions('woocommerce_after_shop_loop_item');
        // Sau đó, các hook của class này sẽ gắn lại card từ đầu (đã add ở boot()).
    }

    private static function guard(): bool
    {
        global $product;
        if (!is_a($product, \WC_Product::class) || !$product->is_visible()) return false;
        // Chỉ áp dụng ở archive/loop (shop, category, tag). Tránh chạy ở single trừ upsell/related.
        if (! (is_shop() || is_product_taxonomy() || is_product_tag())) return false;
        return true;
    }

    public static function open_card(): void
    {
        if (!self::guard()) return;
        echo '<article class="product-card product-card--yb">';
    }

    // public static function media(): void {
    //     if (!self::guard()) return;
    //     global $product;
    //     $permalink = get_permalink($product->get_id());
    //     $img = $product->get_image('woocommerce_thumbnail', ['class'=>'product-card__img'], false);

    //     $badge = '';
    //     $reg = (float)$product->get_regular_price();
    //     $sale = (float)$product->get_sale_price();
    //     if ($product->is_on_sale() && $reg > 0 && $sale > 0 && $sale < $reg) {
    //         $pct = round((($reg - $sale) / $reg) * 100);
    //         $badge .= '<span class="product-card__badge product-card__badge--sale">-' . esc_html($pct) . '%</span>';
    //     }
    //     $badge .= '<span class="product-card__badge product-card__badge--new">Sale</span>';

    //     $oos = $product->is_in_stock() ? '' : '<span class="product-card__badge product-card__badge--oos">Hết hàng</span>';

    //     echo '<div class="product-card__media">';
    //     echo '<div class="product-card__badges">'.$badge.'</div>'.$oos;
    //     echo '<a class="product-card__image" href="'.esc_url($permalink).'">'.$img.'</a>';
    //     echo '</div>';
    // }

    public static function media(): void
    {
        if (!self::guard()) return;
        global $product;

        $permalink = get_permalink($product->get_id());
        $img       = $product->get_image('woocommerce_thumbnail', ['class' => 'product-card__img'], false);

        echo '<div class="product-card__media">';

        $style = get_theme_mod('sale_badge_style', 'pill'); // 'pill' | 'flag'
        $pos = get_theme_mod( 'sale_badge_position', 'tl' );
        // SALE badge overlay
        if (class_exists(\TMT\Theme\Woo\WC_Sale_Badge::class)) {
            $pct = \TMT\Theme\Woo\WC_Sale_Badge::discount_pct($product);
            if ($pct > 0) {
                echo \TMT\Theme\Woo\WC_Sale_Badge::render($pct, $style, $pos); // skin: ribbon|pill|circle|flag  pos: tl|tr|bl|br
            }
        }

        // NEW / OOS (đặt ở các góc còn lại)
        echo '<span class="product-card__badge product-card__badge--new">New</span>';
        if (!$product->is_in_stock()) {
            echo '<span class="product-card__badge product-card__badge--oos">Hết hàng</span>';
        }

        echo '<a class="product-card__image" href="' . esc_url($permalink) . '">' . $img . '</a>';
        echo '</div>';
    }



    public static function title(): void
    {
        if (!self::guard()) return;
        echo '<h3 class="product-card__title"><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h3>';
        $excerpt = wp_strip_all_tags(get_the_excerpt() ?: get_post_meta(get_the_ID(), '_short_description', true));
        if ($excerpt) echo '<p class="product-card__excerpt">' . esc_html($excerpt) . '</p>';
    }

    public static function meta(): void
    {
        if (!self::guard()) return;
        global $product;
        $rating = function_exists('wc_get_rating_html') ? wc_get_rating_html((float)$product->get_average_rating()) : '';
        echo '<div class="product-card__meta">';
        if ($rating) echo '<div class="product-card__rating">' . $rating . '</div>';
        echo '<div class="product-card__price">' . $product->get_price_html() . '</div>';
        echo '</div>';
    }

    public static function actions(): void
    {
        if (!self::guard()) return;
        echo '<div class="product-card__actions">';
        \woocommerce_template_loop_add_to_cart(); // dùng lại template Woo cho nút
        echo '</div>';
    }

    public static function close_card(): void
    {
        if (!self::guard()) return;
        echo '</article>';
    }

    public static function filter_loop_add_to_cart_link($button, $product, $args)
    {
        // Nếu vì lý do nào đó text nút bị đổi thành VIEW CART sau khi added,
        // bạn có thể ép lại text (tuỳ ý):
        $button = str_replace('VIEW CART', 'Thêm vào giỏ', $button);
        return $button;
    }

    // Trước: public static function filter_wc_script_data($data, $handle, $name)
    public static function filter_wc_script_data($data, $handle)
    {
        // Chỉ can thiệp vào script 'wc-add-to-cart'
        if ($handle === 'wc-add-to-cart') {
            // Chặn Woo thêm link "View cart"
            $data['cart_url'] = '';
            $data['i18n_view_cart'] = '';

            // tuỳ chọn: tắt luôn thông báo đi kèm
            if (isset($data['added_to_cart_notice'])) {
                $data['added_to_cart_notice'] = '';
            }
        }
        return $data;
    }
}
