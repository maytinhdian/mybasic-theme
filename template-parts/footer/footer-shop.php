<div class="footer-categories">
    <div class="footer-categories__list">
        <h4>Hỗ trợ khách hàng</h4>
        <a href="<?php echo esc_url(__('https://wordpress.org/', 'phukiendep')); ?>">
            0393080822
        </a>
        <h6>Phương thức thanh toán</h6>
    </div>
    <div class="footer-categories__list">
        <h4>Linh kiện máy tính</h4>
        <?php
        $slug = 'Linh kiện máy tính'; // thay slug theo tên của bạn

        $term = get_term_by('slug', $slug, 'product_cat');

        if ($term) {
            $term_id = $term->term_id;
            error_log('ID của danh mục "' . esc_html($term->name) . '" là: ' . $term_id);
        } else {
            error_log('Không tìm thấy danh mục với slug này.');
        }



        $parent_id =  $term_id; // ID của danh mục gốc "Linh kiện máy tính"
        $subcategories = get_terms(array(
            'taxonomy'   => 'product_cat',
            'parent'     => $parent_id,
            'hide_empty' => false,
        ));

        if (!empty($subcategories)) {
            foreach ($subcategories as $subcategory) {

                echo '<p class="product-brand__item"><a href="' . get_term_link($subcategory->name, 'product_cat') . '">' . $subcategory->name . '</a></p>';
            }
        }

        ?>
    </div>
    <div class="footer-categories__list footer-brands__list">
        <h4>Thương hiệu</h4>
        <?php
        $brands = get_terms([
            'taxonomy' => 'product_brand', // Đổi thành taxonomy bạn dùng nếu khác
            'hide_empty' => false,         // true: chỉ lấy brand có sản phẩm
            'number'     => 6,               // chỉ lấy 5 brand
        ]);
        if (!is_wp_error($brands)) {
            foreach ($brands as $brand) {
                echo '<p class="product-brand__item"><a href="' . get_term_link($brand->name, 'product_brand') . '">' . $brand->name . '</a></p>'; // Output: https://yourdomain.com/brand/brand-name/
            }
        }
        ?>
    </div>
    <div class="footer-categories__list">
        <h4>Phụ kiện | Đồ trang trí</h4>
        <?php
        $slug = 'Phụ kiện máy tính'; // thay slug theo tên của bạn

        $term = get_term_by('slug', $slug, 'product_cat');

        if ($term) {
            $term_id = $term->term_id;
            error_log('ID của danh mục "' . esc_html($term->name) . '" là: ' . $term_id);
        } else {
            error_log('Không tìm thấy danh mục với slug này.');
        }



        $parent_id =  $term_id; // ID của danh mục gốc "Linh kiện máy tính"
        $subcategories = get_terms(array(
            'taxonomy'   => 'product_cat',
            'parent'     => $parent_id,
            'hide_empty' => false,
        ));

        if (!empty($subcategories)) {
            foreach ($subcategories as $subcategory) {

                echo '<p class="product-brand__item"><a href="' . get_term_link($subcategory->name, 'product_cat') . '">' . $subcategory->name . '</a></p>';
            }
        }

        ?>
    </div>
    <div class="footer-copyright">
        <h6 class="footer-copyright-title">
            <p><?php echo wp_kses_post(get_theme_mod('footer-copyright', 'Copyrights TMT Innovative Solutions Co., ltd')) ?></p>
        </h6>
    </div>
</div><!-- .site-info -->