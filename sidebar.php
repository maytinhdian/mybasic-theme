<?php
// Ngăn truy cập trực tiếp
if (! defined('ABSPATH')) exit;

// Nếu bạn không dùng sidebar, có thể để trống hoặc chỉ render khi có widget
if (! is_active_sidebar('primary')) return;
?>
<aside id="secondary" class="widget-area" role="complementary">
    <?php dynamic_sidebar('primary'); ?>
</aside>