<?php if (!defined('ABSPATH')) exit; ?>
<?php if (wc_coupons_enabled()) : ?>
    <div class="tmt-card tmt-cart__coupon">
        <h3 class="tmt-card__title">Mã giảm giá</h3>
        <form class="tmt-coupon-form" method="post">
            <div class="tmt-field">
                <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e('Nhập mã...', 'woocommerce'); ?>" id="coupon_code" value="" />
                <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
                    Áp dụng
                </button>
            </div>
            <?php wp_nonce_field('apply-coupon', 'security'); ?>
        </form>
    </div>
<?php endif; ?>