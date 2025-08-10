<?php

/**
 * Template Name: Dịch vụ lắp đặt Camera
 * Description: Trang giới thiệu dịch vụ lắp đặt camera (hero, lợi ích, quy trình, gói dịch vụ, gallery, khách hàng, CTA).
 */
get_header();

// Tuỳ biến nhanh (có thể lấy từ ACF/Customizer sau này)
$brand_primary   = '#ffc300';
$brand_bg        = '#0d0d0d';
$brand_text      = '#f5f5f5';
$contact_phone   = get_theme_mod('company_hotline', '0900 000 000');
$cta_contact_url = get_permalink(get_page_by_path('lien-he')) ?: 'tel:' . preg_replace('/\s+/', '', $contact_phone);
?>
<main id="primary" class="camera-page" style="--brand:#ffc300; --bg:#0d0d0d; --text:#f5f5f5">
    <!-- HERO -->
    <section class="camera-hero" aria-labelledby="camera-hero-title">
        <div class="camera-hero__bg" aria-hidden="true"></div>
        <div class="container camera-hero__inner">
            <h1 id="camera-hero-title" class="camera-hero__title">
                Giải pháp Lắp đặt Camera Chuyên nghiệp – An toàn cho mọi không gian
            </h1>
            <p class="camera-hero__subtitle">
                Tư vấn – Thiết kế – Thi công – Bảo hành. Giám sát 24/7, xem từ xa trên điện thoại.
            </p>
            <div class="camera-hero__actions">
                <a class="btn btn--primary" href="<?php echo esc_url($cta_contact_url); ?>">Nhận tư vấn miễn phí</a>
                <a class="btn btn--ghost" href="#packages">Xem gói dịch vụ</a>
            </div>
        </div>
    </section>

    <!-- INTRO -->
    <section class="camera-intro section" aria-labelledby="camera-intro-title">
        <div class="container">
            <header class="section__head section__head--split">
                <h2 id="camera-intro-title" class="section__title">Về chúng tôi</h2>
                <p class="section__tagline">Uy tín – Tận tâm – Bảo hành dài hạn</p>
            </header>

            <div class="camera-intro__grid">
                <div class="camera-intro__text">
                    <p>Với hơn <strong>X năm kinh nghiệm</strong>, <strong>Công ty TNHH Giải Pháp Sáng Tạo TMT Việt Nam</strong> chuyên <em>tư vấn, thiết kế và lắp đặt</em> hệ thống camera giám sát chất lượng cao cho hộ gia đình, cửa hàng, doanh nghiệp và dự án.</p>
                    <ul class="bullets">
                        <li>Tối ưu lộ trình dây, thẩm mỹ – gọn – bền.</li>
                        <li>Thiết bị chính hãng, bảo hành nhanh.</li>
                        <li>Hỗ trợ từ xa & bảo trì định kỳ.</li>
                    </ul>
                </div>
                <div class="camera-intro__highlights">
                    <div class="kpi">
                        <span class="kpi__num">500+ </span>
                        <span class="kpi__label">Công trình</span>
                    </div>
                    <div class="kpi">
                        <span class="kpi__num">4.8/5</span>
                        <span class="kpi__label">Đánh giá</span>
                    </div>
                    <div class="kpi">
                        <span class="kpi__num">24/7</span>
                        <span class="kpi__label">Hỗ trợ</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BENEFITS -->
    <section class="camera-benefits section" aria-labelledby="camera-benefits-title">
        <div class="container">
            <header class="section__head section__head--split">
                <h2 id="camera-benefits-title" class="section__title">Lợi ích khi lắp đặt</h2>
                <p class="section__tagline">An ninh 24/7 – Giám sát từ xa – Bảo vệ tài sản</p>
            </header>
            <ul class="benefit-list" role="list">
                <?php
                $benefits = [
                    ['An ninh 24/7', 'Giám sát liên tục, giảm thiểu rủi ro.'],
                    ['Ngăn chặn trộm cắp', 'Tăng khả năng răn đe và truy xuất bằng chứng.'],
                    ['Giám sát từ xa', 'Xem trên điện thoại, máy tính mọi lúc mọi nơi.'],
                    ['Lưu trữ an toàn', 'NVR/HDD/Cloud, thời gian lưu tuỳ chọn.'],
                ];
                foreach ($benefits as $b): ?>
                    <li class="benefit">
                        <span class="benefit__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="22" height="22">
                                <path d="M9 16.2l-3.5-3.5L4 14.2l5 5 11-11-1.5-1.5z" />
                            </svg>
                        </span>
                        <div class="benefit__body">
                            <h3 class="benefit__title"><?php echo esc_html($b[0]); ?></h3>
                            <p class="benefit__desc"><?php echo esc_html($b[1]); ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- PROCESS -->
    <section class="camera-process section" aria-labelledby="camera-process-title">
        <div class="container">
            <header class="section__head section__head--split">
                <h2 id="camera-process-title" class="section__title">Quy trình lắp đặt</h2>
                <p class="section__tagline">Nhanh – Chuẩn – Gọn – Đẹp</p>
            </header>

            <ol class="process" role="list">
                <li class="process__step">
                    <h3 class="process__title">Khảo sát & tư vấn</h3>
                    <p class="process__desc">Khảo sát thực tế, đề xuất vị trí, thiết bị phù hợp.</p>
                </li>
                <li class="process__step">
                    <h3 class="process__title">Phương án & báo giá</h3>
                    <p class="process__desc">Gửi sơ đồ điểm đặt, chủng loại, chi phí minh bạch.</p>
                </li>
                <li class="process__step">
                    <h3 class="process__title">Thi công lắp đặt</h3>
                    <p class="process__desc">Đội ngũ chuyên nghiệp, đảm bảo mỹ quan công trình.</p>
                </li>
                <li class="process__step">
                    <h3 class="process__title">Bàn giao & bảo trì</h3>
                    <p class="process__desc">Hướng dẫn sử dụng, cấu hình xem từ xa, bảo hành.</p>
                </li>
            </ol>
        </div>
    </section>

    <!-- PACKAGES -->
    <section id="packages" class="camera-packages section" aria-labelledby="camera-packages-title">
        <div class="container">
            <header class="section__head section__head--split">
                <h2 id="camera-packages-title" class="section__title">Gói dịch vụ & Bảng giá</h2>
                <p class="section__tagline">Tuỳ nhu cầu hộ gia đình, cửa hàng, doanh nghiệp</p>
            </header>

            <div class="cards">
                <article class="card">
                    <h3 class="card__title">Gói Gia đình</h3>
                    <p class="card__subtitle">2–4 mắt • Lưu 7–15 ngày</p>
                    <ul class="card__list">
                        <li>Độ phân giải 2MP/4MP</li>
                        <li>NVR + HDD phù hợp</li>
                        <li>Xem từ xa qua app</li>
                    </ul>
                    <div class="card__price"><span>Từ</span> 4.990.000đ</div>
                    <a class="btn btn--primary card__btn" href="<?php echo esc_url($cta_contact_url); ?>">Nhận báo giá</a>
                </article>

                <article class="card card--featured">
                    <div class="card__badge">Phổ biến</div>
                    <h3 class="card__title">Gói Doanh nghiệp</h3>
                    <p class="card__subtitle">6–16 mắt • Lưu dài ngày</p>
                    <ul class="card__list">
                        <li>Độ phân giải 4MP/8MP</li>
                        <li>NVR nhiều kênh + RAID</li>
                        <li>Tích hợp màn hình/TV</li>
                    </ul>
                    <div class="card__price"><span>Từ</span> 12.900.000đ</div>
                    <a class="btn btn--primary card__btn" href="<?php echo esc_url($cta_contact_url); ?>">Nhận báo giá</a>
                </article>

                <article class="card">
                    <h3 class="card__title">Gói Dự án</h3>
                    <p class="card__subtitle">Từ 32 mắt • Tích hợp nâng cao</p>
                    <ul class="card__list">
                        <li>Server lưu trữ/NAS</li>
                        <li>Phân quyền nhiều người dùng</li>
                        <li>Triển khai chuẩn an toàn</li>
                    </ul>
                    <div class="card__price">Liên hệ</div>
                    <a class="btn btn--ghost card__btn" href="<?php echo esc_url($cta_contact_url); ?>">Tư vấn chi tiết</a>
                </article>
            </div>
            <p class="packages__note">Giá mang tính tham khảo; thực tế phụ thuộc số mắt, địa hình thi công và thiết bị.</p>
        </div>
    </section>

    <!-- GALLERY -->
    <section class="camera-gallery section" aria-labelledby="camera-gallery-title">
        <div class="container">
            <header class="section__head section__head--split">
                <h2 id="camera-gallery-title" class="section__title">Hình ảnh thực tế</h2>
                <p class="section__tagline">Một số công trình đã triển khai</p>
            </header>
            <div class="masonry">
                <?php for ($i = 1; $i <= 8; $i++): ?>
                    <figure class="masonry__item">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/demo/cam-' . (($i % 4) + 1) . '.jpg'); ?>"
                            alt="Hình công trình camera <?php echo $i; ?>" loading="lazy" />
                    </figure>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- CLIENTS & TESTIMONIALS -->
    <section class="camera-trust section" aria-labelledby="camera-trust-title">
        <div class="container">
            <header class="section__head section__head--split">
                <h2 id="camera-trust-title" class="section__title">Khách hàng tiêu biểu</h2>
                <p class="section__tagline">Doanh nghiệp tin chọn giải pháp của chúng tôi</p>
            </header>

            <div class="trust__logos">
                <?php for ($i = 1; $i <= 6; $i++): ?>
                    <img class="trust__logo" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/demo/logo-' . $i . '.svg'); ?>" alt="Logo khách hàng <?php echo $i; ?>" loading="lazy">
                <?php endfor; ?>
            </div>

            <div class="testis">
                <article class="testi">
                    <p class="testi__text">“Thi công nhanh, gọn sạch, xem từ xa mượt. Hậu mãi tốt!”</p>
                    <p class="testi__author">— Anh Minh, Chủ cửa hàng</p>
                </article>
                <article class="testi">
                    <p class="testi__text">“Hệ thống ổn định, hỗ trợ 24/7 khi cần.”</p>
                    <p class="testi__author">— Chị Hoa, Quản lý văn phòng</p>
                </article>
            </div>
        </div>
    </section>

    <!-- CTA cuối trang -->
    <section class="camera-cta section" aria-labelledby="camera-cta-title">
        <div class="container camera-cta__inner">
            <h2 id="camera-cta-title" class="camera-cta__title">Cần tư vấn nhanh?</h2>
            <p class="camera-cta__subtitle">Gọi ngay <strong><?php echo esc_html($contact_phone); ?></strong> hoặc để lại thông tin – chúng tôi sẽ liên hệ trong 15 phút.</p>
            <div class="camera-cta__actions">
                <a class="btn btn--primary" href="<?php echo esc_url($cta_contact_url); ?>">Nhận tư vấn ngay</a>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>