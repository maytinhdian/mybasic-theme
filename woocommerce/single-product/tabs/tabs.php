<?php

/**
 * Template: Single Product Tabs (TMT)
 * Place in: your-theme/woocommerce/single-product/tabs/tabs.php
 */
if (!defined('ABSPATH')) exit;

$tabs = apply_filters('woocommerce_product_tabs', []);
if (empty($tabs)) return;

// Chọn layout: 'horizontal' | 'accordion' | 'vertical'
$layout = apply_filters('tmt_tabs_layout', 'horizontal');
$root_classes = 'tmt-tabs tmt-tabs--' . esc_attr($layout);
?>
<div class="<?php echo $root_classes; ?>" data-tmt-tabs>
    <?php if ($layout !== 'accordion') : ?>
        <nav class="tmt-tabs__sidebar" aria-label="Product sections">
            <ul class="tmt-tabs__nav" role="tablist">
                <?php $i = 0;
                foreach ($tabs as $key => $tab) : $i++; ?>
                    <li class="<?php echo $i === 1 ? 'active' : ''; ?>" role="presentation">
                        <a href="#tmt-tab-<?php echo esc_attr($key); ?>"
                            role="tab"
                            aria-controls="tmt-tab-<?php echo esc_attr($key); ?>"
                            aria-selected="<?php echo $i === 1 ? 'true' : 'false'; ?>">
                            <?php echo wp_kses_post(apply_filters("woocommerce_product_{$key}_tab_title", $tab['title'], $key)); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    <?php endif; ?>

    <div class="tmt-tabs__content<?php echo $layout === 'vertical' ? ' tmt-tabs__main' : ''; ?>">
        <?php $i = 0;
        foreach ($tabs as $key => $tab) : $i++; ?>
            <?php if ($layout === 'accordion') : ?>
                <div class="tmt-accordion__item <?php echo $i === 1 ? 'active' : ''; ?>">
                    <button class="tmt-accordion__header" type="button">
                        <span><?php echo wp_kses_post(apply_filters("woocommerce_product_{$key}_tab_title", $tab['title'], $key)); ?></span>
                        <span class="caret" aria-hidden="true">▾</span>
                    </button>
                    <div class="tmt-accordion__body">
                        <div id="tmt-tab-<?php echo esc_attr($key); ?>"
                            class="tab-pane <?php echo $i === 1 ? 'active' : ''; ?>"
                            role="tabpanel">
                            <?php call_user_func($tab['callback'], $key, $tab); ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div id="tmt-tab-<?php echo esc_attr($key); ?>"
                    class="tab-pane <?php echo $i === 1 ? 'active' : ''; ?>"
                    role="tabpanel"
                    aria-hidden="<?php echo $i === 1 ? 'false' : 'true'; ?>">
                    <?php call_user_func($tab['callback'], $key, $tab); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>