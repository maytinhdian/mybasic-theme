<?php if (!defined('ABSPATH')) exit; ?>
<div class="tmt-card tmt-cart__shipping">
    <h3 class="tmt-card__title">
        <i class="tmt-icon tmt-icon--truck" aria-hidden="true"></i>
        Tính phí vận chuyển
    </h3>
    <?php
    // Calculator chuẩn của Woo (bật trong Woo settings)
    if (wc_shipping_enabled()) {
        woocommerce_shipping_calculator();
    } else {
        echo '<p>Vận chuyển sẽ được tính ở bước tiếp theo.</p>';
    }
    ?>
</div>