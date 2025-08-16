<?php if (!defined('ABSPATH')) exit; ?>
<div class="tmt-card tmt-cart__checkout">
    <h3 class="tmt-card__title">Thanh toán</h3>
    <div class="tmt-cart__cta">
        <?php do_action('woocommerce_proceed_to_checkout'); // in ra nút Proceed to checkout 
        ?>
        <a class="button tmt-btn--ghost" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
            Tiếp tục mua sắm
        </a>
    </div>
</div>