<?php

/**
 * Skinnable Sale Badge (single file component)
 * Usage:
 *   require_once __DIR__.'/class-sale-badge.php';
 *   if (class_exists(\TMT\Theme\Woo\WC_Sale_Badge::class)) {
 *       \TMT\Theme\Woo\WC_Sale_Badge::boot();
 *   }
 */

namespace TMT\Theme\Woo;

defined('ABSPATH') || exit;

final class WC_Sale_Badge
{

    /**
     * Khởi động component.
     * Mặc định: thay thế sale flash của WooCommerce bằng badge mới.
     * Nếu bạn đã remove_action('woocommerce_show_product_loop_sale_flash', ...),
     * filter dưới sẽ không được gọi — khi đó hãy gọi ::render() thủ công trong card.
     */
    public static function boot(): void
    {
        add_filter('woocommerce_sale_flash', [__CLASS__, 'filter_sale_flash'], 10, 3);
    }

    /** Woo filter → in badge mới */
    public static function filter_sale_flash($html, $post, $product)
    {
        if (!($product instanceof \WC_Product)) return $html;

        $pct = self::discount_pct($product);
        if ($pct <= 0) return ''; // không on-sale thì không in

        // Cho phép đổi skin/position qua filter hoặc theme_mod
        $skin = apply_filters('tmt_sale_badge_skin', get_theme_mod('tmt_sale_badge_skin', 'ribbon')); // 'pill'|'ribbon'|'circle'|'flag'
        $pos  = apply_filters('tmt_sale_badge_pos',  get_theme_mod('tmt_sale_badge_pos',  'tl'));     // 'tl'|'tr'|'bl'|'br'

        return self::render($pct, $skin, $pos);
    }

    /** Tính phần trăm giảm giá an toàn (0–99) */
    public static function discount_pct(\WC_Product $product): int
    {
        $reg  = (float) $product->get_regular_price();
        $sale = (float) $product->get_sale_price();
        if (!$product->is_on_sale() || $reg <= 0 || $sale <= 0 || $sale >= $reg) return 0;
        return (int) min(99, max(0, round((($reg - $sale) / $reg) * 100)));
    }

    /**
     * Render badge (có thể gọi thủ công ở bất kỳ chỗ nào)
     * @param int    $percent 0–99
     * @param string $skin    'pill'|'ribbon'|'circle'|'flag'
     * @param string $pos     'tl'|'tr'|'bl'|'br'
     */
    public static function render(int $percent, string $skin = 'ribbon', string $pos = 'tl'): string
    {
        $percent = (int) min(99, max(0, $percent));
        $classes = sprintf('sale-badge sale-badge--%s sale-badge--%s', esc_attr($skin), esc_attr($pos));

        return sprintf(
            '<span class="%s" aria-label="%s"><em class="sale-badge__label">Sale</em><strong class="sale-badge__pct">-%d%%</strong></span>',
            $classes,
            esc_attr(sprintf(__('Giảm %d%%', 'tmt'), $percent)),
            $percent
        );
    }
}
