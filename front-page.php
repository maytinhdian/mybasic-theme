<?php get_header(); ?>

<main class="site-main">
    <div class="container">
        <!-- ===================== SERVICES / CTA ===================== -->
        <?php get_template_part('template-parts/components/service', 'cta'); ?>
    </div>
    <div class="container">
        <?php
        get_template_part(
            'template-parts/sections/section-camera-cta',
            null,
            array(
                'title'         => 'Lắp đặt Camera Chuyên nghiệp',
                'subtitle'      => 'Tư vấn – Thiết kế – Thi công – Bảo hành.',
                'benefits'      => array('An ninh 24/7', 'Giám sát từ xa', 'Cảnh báo chuyển động', 'Bảo trì tận nơi'),
                'cta_text'      => 'Xem chi tiết dịch vụ',
                'cta_page_slug' => 'lap-dat-camera' // tạo trang này rồi điền nội dung dài như bạn yêu cầu
            )
        );
        ?>
    </div>
    <?php get_footer(); ?>