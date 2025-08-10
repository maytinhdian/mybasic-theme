<?php

/**
 * Section: Camera Intro CTA
 * Usage:
 * get_template_part(
 *   'template-parts/sections/section-camera-cta',
 *   null,
 *   array(
 *     'title'          => 'Lắp đặt Camera Chuyên nghiệp',
 *     'subtitle'       => 'Giải pháp an ninh 24/7 cho gia đình và doanh nghiệp.',
 *     'benefits'       => array('Giám sát từ xa', 'Cảnh báo chuyển động', 'Lưu trữ an toàn', 'Thi công nhanh'),
 *     'cta_text'       => 'Tìm hiểu dịch vụ',
 *     'cta_page_slug'  => 'lap-dat-camera' // slug trang giới thiệu chi tiết
 *   )
 * );
 */


$args = wp_parse_args($args ?? [], [
    'title'         => 'Dịch vụ kỹ thuật',
    'tagline'       => 'Sửa chữa máy tính, lắp đặt camera, cài đặt phần mềm',
    'benefits'      => ['An ninh 24/7', 'Giám sát từ xa', 'Cảnh báo chuyển động', 'Bảo trì tận nơi'],
    'cta_text'      => 'Xem chi tiết dịch vụ',
    'cta_page_slug' => 'lap-dat-camera',
]);


// Lấy link đến trang giới thiệu chi tiết theo slug
$target_link = home_url('/');
if (! empty($args['cta_page_slug'])) {
    $page = get_page_by_path(sanitize_title($args['cta_page_slug']));
    if ($page) {
        $target_link = get_permalink($page->ID);
    } else {
        // fallback nếu chưa tạo trang: trỏ theo path
        $target_link = home_url('/' . $args['cta_page_slug'] . '/');
    }
}
?>

<section class="camera-cta" aria-labelledby="camera-cta-title">
    <div class="camera-cta__bg" aria-hidden="true"></div>

    <div class="container camera-cta__inner">
        <header class="camera-cta__head camera-cta__head--split">
            <h2 id="camera-cta-title" class="camera-cta__title">
                <?php echo esc_html($args['title']); ?>
            </h2>
            <p class="camera-cta__tagline">
                <?php echo esc_html($args['tagline']); ?>
            </p>
        </header>


        <?php if (! empty($args['benefits'])) : ?>
            <ul class="camera-cta__list" role="list">
                <?php foreach ($args['benefits'] as $benefit) : ?>
                    <li class="camera-cta__item">
                        <span class="camera-cta__icon" aria-hidden="true">
                            <!-- SVG check -->
                            <svg viewBox="0 0 24 24" width="20" height="20" focusable="false" aria-hidden="true">
                                <path d="M9 16.2l-3.5-3.5L4 14.2l5 5 11-11-1.5-1.5z" />
                            </svg>
                        </span>
                        <span class="camera-cta__text"><?php echo esc_html($benefit); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="camera-cta__actions">
            <a class="btn btn--primary camera-cta__btn"
                href="<?php echo esc_url($target_link); ?>"
                aria-label="<?php echo esc_attr($args['cta_text']); ?>">
                <?php echo esc_html($args['cta_text']); ?>
            </a>
        </div>
    </div>
</section>