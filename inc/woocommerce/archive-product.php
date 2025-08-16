<?php
namespace TMT\Theme\Woo;

class WC_Archive_Product {
    public static function boot() { add_action('wp', [__CLASS__, 'setup'], 99); }

    public static function setup() {
        if (!function_exists('is_shop')) return;
        if (!(is_shop() || is_product_taxonomy())) return;

        // Ngắt wrapper/mặc định của Woo để mình tự bọc
        remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper',10);
        remove_action('woocommerce_after_main_content','woocommerce_output_content_wrapper_end',10);
        remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
        remove_action('woocommerce_archive_description','woocommerce_taxonomy_archive_description',10);
        remove_action('woocommerce_archive_description','woocommerce_product_archive_description',10);

        // Ngắt result-count & ordering mặc định để tự render trong titlebar
        remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
        remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);

        // Wrapper + header + filter + grid container
        add_action('woocommerce_before_main_content',[__CLASS__,'open_page_wrapper'],5);
        add_action('woocommerce_before_main_content',[__CLASS__,'render_header'],10);
        add_action('woocommerce_before_main_content',[__CLASS__,'render_filters'],12);
        add_action('woocommerce_before_shop_loop',[__CLASS__,'open_products_container'],1);
        add_action('woocommerce_after_shop_loop',[__CLASS__,'close_products_container'],999);
        add_action('woocommerce_after_main_content',[__CLASS__,'render_footer'],30);
        add_action('woocommerce_after_main_content',[__CLASS__,'close_page_wrapper'],50);

        add_filter('woocommerce_show_page_title', '__return_false', 99);

        // Sidebar
        remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);
        add_action('woocommerce_after_main_content',[__CLASS__,'render_sidebar'],20);

        // Lọc query + assets
        add_action('pre_get_posts',[__CLASS__,'apply_filters_to_query']);
        add_action('wp_enqueue_scripts',[__CLASS__,'enqueue_assets']);
    }

    public static function enqueue_assets() {
        // SCSS bạn đã build vào CSS chính.
        // JS auto-submit filter:
        wp_enqueue_script(
            'tmt-archive-filters',
            get_template_directory_uri() . '/assets/js/tmt-archive-filters.js',
            [],
            '1.0',
            true
        );
    }

    // === Views ===
    public static function open_page_wrapper() {
        locate_template('template-parts/woocommerce/archive/header.php', true, false);
    }
    public static function close_page_wrapper() {
        locate_template('template-parts/woocommerce/archive/footer.php', true, false);
    }
    public static function render_header() { /* nội dung nằm trong file header.php */ }

    public static function render_filters() {
        locate_template('template-parts/woocommerce/archive/filters.php', true, false);
    }

    public static function open_products_container() {
        locate_template('template-parts/woocommerce/archive/loop-start.php', true, false);
    }
    public static function close_products_container() {
        locate_template('template-parts/woocommerce/archive/loop-end.php', true, false);
    }
    public static function render_sidebar() {
        locate_template('template-parts/woocommerce/archive/sidebar.php', true, false);
    }
    public static function render_footer() {
        locate_template('template-parts/woocommerce/archive/pagination.php', true, false);
    }

    // === Apply filters to main query ===
    public static function apply_filters_to_query($q) {
        if (is_admin() || !$q->is_main_query()) return;
        if (!(is_shop() || is_product_taxonomy())) return;

        $tax_query  = (array) $q->get('tax_query');
        $meta_query = (array) $q->get('meta_query');

        // Danh mục
        if (!empty($_GET['product_cat'])) {
            $tax_query[] = [
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['product_cat']),
            ];
        }

        // Khoảng giá
        $min = isset($_GET['min_price']) ? floatval($_GET['min_price']) : 0;
        $max = isset($_GET['max_price']) ? floatval($_GET['max_price']) : 0;
        if ($min || $max) {
            $meta_query[] = [
                'key'     => '_price',
                'value'   => ($min && $max) ? [$min,$max] : ($min ?: $max),
                'type'    => 'NUMERIC',
                'compare' => ($min && $max) ? 'BETWEEN' : ($min ? '>=' : '<='),
            ];
        }

        // Tồn kho
        if (!empty($_GET['stock']) && in_array($_GET['stock'], ['instock','outofstock'], true)) {
            $meta_query[] = [
                'key'     => '_stock_status',
                'value'   => sanitize_text_field($_GET['stock']),
                'compare' => '=',
            ];
        }

        // Khuyến mãi
        if (!empty($_GET['onsale']) && function_exists('wc_get_product_ids_on_sale')) {
            $ids = wc_get_product_ids_on_sale();
            $ids = array_merge($ids, [0]);
            $q->set('post__in', $ids);
        }

        // Attributes pa_*
        if (function_exists('wc_get_attribute_taxonomies')) {
            foreach (wc_get_attribute_taxonomies() as $tax) {
                $taxonomy = wc_attribute_taxonomy_name($tax->attribute_name);
                if (!taxonomy_exists($taxonomy)) continue;
                $param = 'filter_' . $taxonomy;
                if (empty($_GET[$param])) continue;
                $term = sanitize_text_field($_GET[$param]);
                $type = !empty($_GET['query_type_' . $taxonomy]) ? sanitize_text_field($_GET['query_type_' . $taxonomy]) : 'and';
                $tax_query[] = [
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => [$term],
                    'operator' => ($type === 'or') ? 'IN' : 'AND',
                ];
            }
        }

        if (!empty($tax_query))  $q->set('tax_query',  $tax_query);
        if (!empty($meta_query)) $q->set('meta_query', $meta_query);
    }
}
