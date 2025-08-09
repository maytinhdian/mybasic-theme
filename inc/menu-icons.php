<?php

/**
 * Menu Icon (no plugin) – add a custom "Icon class" field to menu items
 * and render the icon INSIDE the <a>, BEFORE the label.
 *
 * Works great with Font Awesome (vd: fa-solid fa-house).
 */

// ===== Admin: Hiển thị field trong màn hình Menus =====
add_action('wp_nav_menu_item_custom_fields', function ($item_id, $item) {
    $value = get_post_meta($item_id, '_menu_icon_class', true);
?>
    <p class="field-menu-icon-class description description-wide">
        <label for="edit-menu-item-menu-icon-class-<?php echo esc_attr($item_id); ?>">
            <strong>Icon class</strong><br>
            <input type="text"
                id="edit-menu-item-menu-icon-class-<?php echo esc_attr($item_id); ?>"
                class="widefat code edit-menu-item-custom"
                name="menu_icon_class[<?php echo esc_attr($item_id); ?>]"
                value="<?php echo esc_attr($value); ?>"
                placeholder="VD: fa-solid fa-house" />
            <span class="description">Nhập class icon (Font Awesome, v.v.)</span>
        </label>
    </p>
<?php
}, 10, 2);

// ===== Admin: Lưu meta khi cập nhật menu =====
add_action('wp_update_nav_menu_item', function ($menu_id, $menu_item_db_id) {
    if (isset($_POST['menu_icon_class'][$menu_item_db_id])) {
        $val = sanitize_text_field(wp_unslash($_POST['menu_icon_class'][$menu_item_db_id]));
        if ($val !== '') {
            update_post_meta($menu_item_db_id, '_menu_icon_class', $val);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_icon_class');
        }
    } else {
        delete_post_meta($menu_item_db_id, '_menu_icon_class');
    }
}, 10, 2);

// ===== Frontend: Chèn icon TRONG <a>, TRƯỚC label =====
// Dùng 'nav_menu_item_title' vì filter này chỉ đụng vào phần text bên trong <a>
add_filter('nav_menu_item_title', function ($title, $item, $args, $depth) {
    $icon_class = get_post_meta($item->ID, '_menu_icon_class', true);
    if (!empty($icon_class)) {
        // Có thể đổi <i> thành <span> hoặc <svg> tuỳ thư viện icon bạn dùng
        $icon_html = '<i class="' . esc_attr($icon_class) . '" aria-hidden="true"></i>';
        // Bọc label để dễ style
        $title = $icon_html . '<span class="menu-label">' . $title . '</span>';
    }
    return $title;
}, 10, 4);

// (không bắt buộc) Thêm class cho thẻ <a> khi có icon – dễ căn lề
add_filter('nav_menu_link_attributes', function ($atts, $item, $args, $depth) {
    $icon_class = get_post_meta($item->ID, '_menu_icon_class', true);
    if (!empty($icon_class)) {
        $atts['class'] = isset($atts['class']) ? $atts['class'] . ' has-icon' : 'has-icon';
    }
    return $atts;
}, 10, 4);
