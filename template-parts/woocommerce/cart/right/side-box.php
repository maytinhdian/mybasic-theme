<?php if (!defined('ABSPATH')) exit; ?>
<div class="tmt-right-box">
    <!-- Tổng tiền -->
    <section class="tmt-right-section tmt-cart__totals">
        <h2 class="tmt-card__title">Tổng tiền</h2>
        <?php woocommerce_cart_totals(); /* Woo in ra Subtotal, Shipping, Discount, Total */ ?>
    </section>

    <!-- Vận chuyển (chỉ là bổ sung UX; Woo đã hiển thị trong totals khi cần) -->
    <section class="tmt-right-section tmt-cart__shipping">
        <h3 class="tmt-card__title">🚚 Phí vận chuyển</h3>
        <?php if (wc_shipping_enabled()) : ?>
            <?php woocommerce_shipping_calculator(); ?>
        <?php else: ?>
            <p>Vận chuyển sẽ được tính ở bước tiếp theo.</p>
        <?php endif; ?>
    </section>

    <!-- Coupon phụ (ẩn form mặc định trong bảng bằng CSS nếu muốn) -->
    <?php if (wc_coupons_enabled()) : ?>
        <section class="tmt-right-section tmt-cart__coupon">
            <h3 class="tmt-card__title">Mã giảm giá</h3>
            <form class="tmt-coupon-form" method="post">
                <div class="row">
                    <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e('Nhập mã...', 'woocommerce'); ?>" />
                    <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
                        Áp dụng
                    </button>
                </div>
                <?php wp_nonce_field('apply-coupon', 'security'); ?>
            </form>
        </section>
    <?php endif; ?>

    <!-- CTA -->
    <section class="tmt-right-section tmt-cart__checkout">
        <h3 class="tmt-card__title">Thanh toán</h3>
        <div class="tmt-cart__cta">
            <?php do_action('woocommerce_proceed_to_checkout'); ?>
            <a class="button btn-ghost" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">Tiếp tục mua sắm</a>
        </div>
    </section>
</div>