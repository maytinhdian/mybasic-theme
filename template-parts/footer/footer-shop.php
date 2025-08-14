<?php

/**
 * Footer Shop (4 columns: Company info + 3 top-level product categories)
 * Place this file at: your-theme/template-parts/woocommerce/footer-shop.php
 */

if (!defined('ABSPATH')) exit;

// Bổ sung ở trên, trước khi gọi get_terms():
$exclude_ids = [];
$default_cat = (int) get_option('default_product_cat'); // WooCommerce default product category (nếu có cấu hình)
if ($default_cat) $exclude_ids[] = $default_cat;

$uncat = get_term_by('slug', 'uncategorized', 'product_cat'); // Phòng khi site chưa set default cat
if ($uncat && !is_wp_error($uncat)) $exclude_ids[] = (int) $uncat->term_id;

$exclude_ids = array_values(array_unique(array_filter($exclude_ids)));


// Lấy 3 danh mục cấp 1 (parent = 0)
$top_level_cats = get_terms([
    'taxonomy'   => 'product_cat',
    'parent'     => 0,
    'hide_empty' => false,
    'number'     => 3,
    'orderby'    => 'menu_order',
    'order'      => 'ASC',
    'exclude'    =>  $exclude_ids, // <-- loại Uncategorized / Default Cat
]);

// Thông tin công ty từ Customizer (có giá trị mặc định)
$company_name    = get_theme_mod('tmt_company_name', 'Công ty TNHH Giải Pháp Sáng Tạo TMT Việt Nam');
$company_tagline = get_theme_mod('tmt_company_tagline', 'Giải pháp mạng – camera – máy chủ');
$company_addr    = get_theme_mod('tmt_company_address', 'Địa chỉ: (cập nhật trong Customizer)');
$company_phone   = get_theme_mod('tmt_company_phone', 'Điện thoại: 0000 000 000');
$company_email   = get_theme_mod('tmt_company_email', 'Email: info@example.com');
$company_logo_id = get_theme_mod('tmt_company_logo_id'); // media id
$company_logo    = $company_logo_id ? wp_get_attachment_image($company_logo_id, 'medium', false, ['class' => 'footer-shop__logo']) : '';

?>
<footer class="footer-shop" role="contentinfo">
    <div class="footer-shop__container">
        <!-- Col 1: Company info -->
        <div class="footer-shop__col footer-shop__col--company">
            <?php if ($company_logo) : ?>
                <div class="footer-shop__brand">
                    <?php echo $company_logo; ?>
                </div>
            <?php else: ?>
                <h3 class="footer-shop__heading"><?php echo esc_html($company_name); ?></h3>
            <?php endif; ?>

            <?php if ($company_tagline): ?>
                <p class="footer-shop__tagline"><?php echo esc_html($company_tagline); ?></p>
            <?php endif; ?>

            <ul class="footer-shop__meta" aria-label="<?php esc_attr_e('Company information', 'your-textdomain'); ?>">
                <?php if ($company_addr): ?>
                    <li class="footer-shop__meta-item"><?php echo esc_html($company_addr); ?></li>
                <?php endif; ?>
                <?php if ($company_phone): ?>
                    <li class="footer-shop__meta-item">
                        <a class="footer-shop__link" href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $company_phone)); ?>">
                            <?php echo esc_html($company_phone); ?>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($company_email): ?>
                    <li class="footer-shop__meta-item">
                        <a class="footer-shop__link" href="mailto:<?php echo antispambot(esc_attr($company_email)); ?>">
                            <?php echo esc_html($company_email); ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Col 2-4: Top-level product categories (and their children) -->
        <?php
        // Trường hợp thiếu 3 danh mục, vẫn render đủ 3 cột (cột trống nếu không có)
        for ($i = 0; $i < 3; $i++):
            $term = isset($top_level_cats[$i]) ? $top_level_cats[$i] : null;
        ?>
            <div class="footer-shop__col footer-shop__col--cats">
                <h3 class="footer-shop__heading">
                    <?php
                    if ($term) {
                        // Tiêu đề là "Categories: {Tên danh mục cấp 1}"
                        printf(
                            /* translators: %s: category name */
                            esc_html__('%s', 'your-textdomain'),
                            esc_html($term->name)
                        );
                    } else {
                        echo esc_html__('', 'your-textdomain');
                    }
                    ?>
                </h3>

                <ul class="footer-shop__list" aria-label="<?php esc_attr_e('Product subcategories', 'your-textdomain'); ?>">
                    <?php
                    if ($term) {
                        $children = get_terms([
                            'taxonomy'   => 'product_cat',
                            'parent'     => $term->term_id,
                            'hide_empty' => false,
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                        ]);
                        if (!is_wp_error($children) && !empty($children)) {
                            foreach ($children as $child) {
                                $link = get_term_link($child);
                                if (is_wp_error($link)) continue;
                    ?>
                                <li class="footer-shop__item">
                                    <a class="footer-shop__link" href="<?php echo esc_url($link); ?>">
                                        <?php echo esc_html($child->name); ?>
                                    </a>
                                </li>
                            <?php
                            }
                        } else {
                            // Nếu danh mục cấp 1 không có con, hiển thị chính nó
                            $link = get_term_link($term);
                            if (!is_wp_error($link)) {
                            ?>
                                <li class="footer-shop__item">
                                    <a class="footer-shop__link" href="<?php echo esc_url($link); ?>">
                                        <?php echo esc_html($term->name); ?>
                                    </a>
                                </li>
                        <?php
                            }
                        }
                    } else {
                        // Không có term -> nhắc quản trị viên
                        ?>
                        <li class="footer-shop__item footer-shop__item--empty">
                            <?php esc_html_e('Add product categories (parent = 0) to populate this column.', 'your-textdomain'); ?>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        <?php endfor; ?>
    </div>

    <div class="footer-shop__bottom">
        <p class="footer-shop__copyright">
            &copy; <?php echo esc_html(date_i18n('Y')); ?> <?php echo esc_html($company_name); ?>. <?php esc_html_e('All rights reserved.', 'your-textdomain'); ?>
        </p>
    </div>
</footer>