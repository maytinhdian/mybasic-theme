<?php defined('ABSPATH') || exit; ?>
<div class="tmt-cko__grid">
  <div class="tmt-cko__col tmt-cko__col--left">
    <div class="tmt-card tmt-card--left">
      <h2 class="tmt-card__title">Thông tin nhận hàng</h2>

      <div class="tmt-cko__quick">
        <?php // khu vực sẽ in form login + coupon qua action tự tạo ?>
        <?php do_action('tmt/checkout/left/top'); ?>
      </div>

      <div class="tmt-cko__customer">
        <?php // Woo sẽ render billing + shipping giữa 2 hook before/after_customer_details ?>
