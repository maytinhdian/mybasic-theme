<?php
$action  = remove_query_arg('paged');
$orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : '';
$selected_cat = isset($_GET['product_cat']) ? sanitize_text_field($_GET['product_cat']) : '';
$min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : '';
$max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : '';
$stock     = isset($_GET['stock']) ? sanitize_text_field($_GET['stock']) : '';
$onsale    = !empty($_GET['onsale']);
$attrs = [];
if (function_exists('wc_get_attribute_taxonomies')) {
    foreach (wc_get_attribute_taxonomies() as $tax) {
        $taxonomy = wc_attribute_taxonomy_name($tax->attribute_name);
        if (taxonomy_exists($taxonomy)) {
            $attrs[] = ['label' => $tax->attribute_label ?: $tax->attribute_name, 'taxonomy' => $taxonomy];
        }
    }
}
?>
<div class="tmt-archive__filters">
    <form class="tmt-filterbar container" method="get" action="<?php echo esc_url($action); ?>">
        <?php if ($orderby): ?><input type="hidden" name="orderby" value="<?php echo esc_attr($orderby); ?>"><?php endif; ?>
        <input type="hidden" name="paged" value="1">

        <div class="tmt-filter">
            <label for="tmt-cat"><?php _e('Danh mục', 'tmt'); ?></label>
            <?php
            wp_dropdown_categories([
                'show_option_all' => __('Tất cả', 'tmt'),
                'taxonomy'        => 'product_cat',
                'name'            => 'product_cat',
                'orderby'         => 'name',
                'hierarchical'    => true,
                'hide_empty'      => true,
                'selected'        => $selected_cat,
                'id'              => 'tmt-cat',
                'value_field'     => 'slug',
            ]);
            ?>
        </div>

        <div class="tmt-filter tmt-filter--price">
            <label><?php _e('Giá', 'tmt'); ?></label>
            <div class="tmt-price-range">
                <input type="number" step="1000" min="0" name="min_price" placeholder="<?php esc_attr_e('Tối thiểu', 'tmt'); ?>" value="<?php echo esc_attr($min_price); ?>">
                <span>—</span>
                <input type="number" step="1000" min="0" name="max_price" placeholder="<?php esc_attr_e('Tối đa', 'tmt'); ?>" value="<?php echo esc_attr($max_price); ?>">
            </div>
        </div>

        <div class="tmt-filter">
            <label for="tmt-stock"><?php _e('Tồn kho', 'tmt'); ?></label>
            <select id="tmt-stock" name="stock">
                <option value=""><?php _e('Tất cả', 'tmt'); ?></option>
                <option value="instock" <?php selected($stock, 'instock'); ?>><?php _e('Còn hàng', 'tmt'); ?></option>
                <option value="outofstock" <?php selected($stock, 'outofstock'); ?>><?php _e('Hết hàng', 'tmt'); ?></option>
            </select>
        </div>

        <div class="tmt-filter tmt-filter--check">
            <label class="tmt-check">
                <input type="checkbox" name="onsale" value="1" <?php checked($onsale, true); ?>>
                <span><?php _e('Đang khuyến mãi', 'tmt'); ?></span>
            </label>
        </div>

        <?php foreach ($attrs as $a):
            $taxonomy   = $a['taxonomy'];
            $param_name = 'filter_' . $taxonomy;
            $current    = isset($_GET[$param_name]) ? sanitize_text_field($_GET[$param_name]) : '';
            $terms      = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => true]);
            if (is_wp_error($terms) || empty($terms)) continue;
        ?>
            <div class="tmt-filter">
                <label for="<?php echo esc_attr($param_name); ?>"><?php echo esc_html($a['label']); ?></label>
                <select name="<?php echo esc_attr($param_name); ?>" id="<?php echo esc_attr($param_name); ?>">
                    <option value=""><?php _e('Tất cả', 'tmt'); ?></option>
                    <?php foreach ($terms as $t): ?>
                        <option value="<?php echo esc_attr($t->slug); ?>" <?php selected($current, $t->slug); ?>>
                            <?php echo esc_html($t->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="<?= 'query_type_' . $taxonomy ?>" value="and">
            </div>
        <?php endforeach; ?>

        <div class="tmt-filter tmt-filter--actions">
            <button type="submit" class="tmt-btn tmt-btn--gold"><?php _e('Lọc', 'tmt'); ?></button>
            <a class="tmt-btn tmt-btn--ghost" href="<?php echo esc_url(get_pagenum_link(1)); ?>"><?php _e('Xoá lọc', 'tmt'); ?></a>
        </div>
    </form>
</div>