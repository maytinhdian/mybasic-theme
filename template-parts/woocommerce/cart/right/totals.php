<?php if (!defined('ABSPATH')) exit; ?>
<div class="tmt-card tmt-cart__totals">
    <h2 class="tmt-card__title">Tổng tiền</h2>
    <?php
    // Dùng API có sẵn để đảm bảo logic thuế/phiếu giảm/shipping đúng chuẩn
    woocommerce_cart_totals();
    ?>
</div>