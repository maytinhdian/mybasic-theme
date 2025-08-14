<?php if (! defined('ABSPATH')) exit; global $product; ?>
<div class="tmt-sp__badges">
  <?php if ($product->is_on_sale()) : ?>
    <span class="tmt-badge tmt-badge--sale"><?php esc_html_e('Sale', 'tmt'); ?></span>
  <?php endif; ?>
  <?php if (!$product->is_in_stock()) : ?>
    <span class="tmt-badge tmt-badge--out"><?php esc_html_e('Out of stock', 'tmt'); ?></span>
  <?php endif; ?>
</div>