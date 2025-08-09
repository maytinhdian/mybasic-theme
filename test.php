<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vàng–Đen | Demo giao diện máy tính</title>
  <style>
    /* =====================
       PALETTE & TOKENS
       ===================== */
    :root{
      --yellow: #FFC300;         /* vàng chủ đạo */
      --yellow-2:#FFD966;        /* vàng nhạt dùng hover/border */
      --black:  #0D0D0D;         /* nền chính */
      --gray-900:#1A1A1A;        /* nền khối/section */
      --text:   #F2F2F2;         /* chữ chính */
      --muted:  #BDBDBD;         /* chữ phụ */
      --radius: 14px;            /* bo góc */
      --shadow-soft: 0 8px 24px rgba(0,0,0,.18);
      --shadow-edge: 0 1px 0 rgba(255,195,0,.18); /* mép vàng rất nhẹ */
      --container: 1200px;
    }

    /* Reset nhẹ */
    *,*::before,*::after{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0; background:var(--black); color:var(--text); font:16px/1.6 system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif}
    img{max-width:100%; display:block}
    a{color:inherit; text-decoration:none}
    button{font:inherit}

    .container{width:min(var(--container), 100% - 2rem); margin-inline:auto}

    /* =====================
       HEADER
       ===================== */
    .site-header{position:sticky; top:0; z-index:50; background:rgba(13,13,13,.9); backdrop-filter:saturate(180%) blur(8px); border-bottom:1px solid rgba(255,195,0,.12)}
    .site-header__bar{display:flex; align-items:center; justify-content:space-between; gap:1rem; padding:.8rem 0}
    .brand{display:flex; align-items:center; gap:.75rem}
    .brand__logo{inline-size:40px; block-size:40px; border-radius:10px; background:radial-gradient(60% 60% at 50% 40%, var(--yellow), #a37b00); box-shadow:0 0 20px rgba(255,195,0,.35)}
    .brand__name{font-weight:700; letter-spacing:.3px}
    .site-nav{display:flex; align-items:center; gap:1.2rem}
    .site-nav__link{position:relative; font-weight:500; color:#ddd}
    .site-nav__link::after{content:""; position:absolute; inset:auto 0 -6px 0; height:2px; transform:scaleX(0); transform-origin:left; background:var(--yellow); transition:transform .25s ease}
    .site-nav__link:hover{color:var(--text)}
    .site-nav__link:hover::after{transform:scaleX(1)}

    .site-header__cta{display:flex; gap:.75rem}

       /* Topbar */
    .topbar{background:var(--gray-900); font-size:.9rem; border-bottom:1px solid rgba(255,195,0,.1)}
    .topbar__inner{display:flex; justify-content:space-between; align-items:center; padding:.4rem 0}
    .topbar__info{display:flex; gap:1rem; align-items:center; color:var(--muted)}
    .topbar__info i{color:var(--yellow)}
    .topbar__links{display:flex; gap:.8rem}
    .topbar__links a:hover{color:var(--yellow)}

    /* Header */
    .site-header{position:sticky; top:0; z-index:50; background:rgba(13,13,13,.9); backdrop-filter:blur(8px); border-bottom:1px solid rgba(255,195,0,.12)}
    .site-header__bar{display:flex; align-items:center; justify-content:space-between; gap:1rem; padding:.8rem 0}
    .brand{display:flex; align-items:center; gap:.75rem}
    .brand__logo{inline-size:40px; block-size:40px; border-radius:10px; background:radial-gradient(60% 60% at 50% 40%, var(--yellow), #a37b00); box-shadow:0 0 20px rgba(255,195,0,.35)}
    .brand__name{font-weight:700}
    .site-nav{display:flex; align-items:center; gap:1.2rem}
    .site-nav__link{position:relative; font-weight:500; color:#ddd}
    .site-nav__link::after{content:""; position:absolute; inset:auto 0 -6px 0; height:2px; transform:scaleX(0); transform-origin:left; background:var(--yellow); transition:transform .25s ease}
    .site-nav__link:hover{color:var(--text)}
    .site-nav__link:hover::after{transform:scaleX(1)}
    .site-header__cta{display:flex; gap:.75rem}

    /* =====================
       HEADER TOPBAR (new)
       ===================== */
    .site-header__top{background:linear-gradient(180deg,#0e0e0e,#0c0c0c); border-bottom:1px solid rgba(255,195,0,.12)}
    .topbar{display:flex; align-items:center; justify-content:space-between; gap:1rem; padding:.35rem 0; color:#cfcfcf}
    .topbar__left{display:flex; align-items:center; gap:1rem; flex-wrap:wrap}
    .topbar__right{display:flex; align-items:center; gap:.4rem}
    .topbar__link{display:inline-flex; align-items:center; gap:.4rem; font-size:.92rem; opacity:.92; transition:opacity .2s ease, color .2s ease}
    .topbar__link:hover{opacity:1; color:var(--yellow)}
    .topbar__icon{display:inline-flex; align-items:center; justify-content:center; inline-size:28px; block-size:28px; border-radius:999px; background:#151515; border:1px solid rgba(255,195,0,.18); transition:all .2s ease}
    .topbar__icon:hover{background:#000; color:var(--yellow); box-shadow:0 0 0 2px rgba(255,195,0,.18) inset}

    .btn{--bg:var(--yellow); --fg:#000; display:inline-flex; align-items:center; justify-content:center; gap:.5rem; border-radius:999px; padding:.7rem 1.1rem; border:2px solid transparent; background:var(--bg); color:var(--fg); transition:all .25s ease; box-shadow: var(--shadow-soft)}
    .btn--ghost{--bg:transparent; --fg:var(--text); border-color:var(--yellow)}
    .btn--ghost:hover{background:#000; color:var(--yellow)}
    .btn--primary:hover{background:#000; color:var(--yellow); border-color:var(--yellow)}
    /* =====================
       BUTTONS (BEM modifiers)
       ===================== */
    .btn{--bg:var(--yellow); --fg:#000; display:inline-flex; align-items:center; justify-content:center; gap:.5rem; border-radius:999px; padding:.7rem 1.1rem; border:2px solid transparent; background:var(--bg); color:var(--fg); transition:all .25s ease; box-shadow: var(--shadow-soft)}
    .btn:focus-visible{outline:2px solid var(--yellow-2); outline-offset:2px}
    .btn--ghost{--bg:transparent; --fg:var(--text); border-color:var(--yellow)}
    .btn--ghost:hover{background:#000; color:var(--yellow)}
    .btn--primary:hover{background:#000; color:var(--yellow); border-color:var(--yellow)}

    /* =====================
       HERO
       ===================== */
    .hero{position:relative; isolation:isolate; background:
      radial-gradient(60% 60% at 20% 0%,rgba(255,195,0,.15),transparent 60%),
      radial-gradient(60% 60% at 80% 0%,rgba(255,195,0,.08),transparent 60%),
      linear-gradient(180deg, rgba(255,255,255,.04), transparent 30%),
      var(--black);
      border-bottom:1px solid rgba(255,195,0,.08);
    }
    .hero__inner{display:grid; grid-template-columns:1.1fr .9fr; gap:2rem; align-items:center; padding:clamp(2rem, 3vw + 1rem, 5rem) 0}
    .hero__title{font-size:clamp(28px, 4.5vw, 56px); line-height:1.1; margin:0 0 .6rem; letter-spacing:.2px}
    .hero__title .glow{color:var(--yellow); text-shadow:0 0 10px rgba(255,195,0,.7), 0 0 30px rgba(255,195,0,.35)}
    .hero__desc{color:#DCDCDC; margin:0 0 1.2rem}
    .hero__actions{display:flex; gap:.8rem; flex-wrap:wrap}
    .hero__media{position:relative}
    .mock{border-radius:var(--radius); overflow:hidden; border:1px solid rgba(255,195,0,.15); box-shadow:var(--shadow-soft), var(--shadow-edge)}
    .mock__bar{display:flex; gap:.35rem; padding:.5rem .7rem; background:#0f0f0f; border-bottom:1px solid rgba(255,195,0,.12)}
    .mock__dot{inline-size:.7rem; block-size:.7rem; border-radius:999px; background:#2a2a2a}
    .mock__screen{aspect-ratio:16/10; background:linear-gradient(135deg,#151515,#0e0e0e); display:grid; place-items:center}
    .mock__screen-cta{display:inline-block; padding:.5rem .8rem; border-radius:8px; border:1px dashed rgba(255,195,0,.4); color:var(--yellow)}

    /* =====================
       PRODUCT LIST
       ===================== */
    .section{padding:3rem 0}
    .section__head{display:flex; align-items:baseline; justify-content:space-between; margin-bottom:1.2rem}
    .section__title{font-size:clamp(22px, 2.8vw, 32px); margin:0}
    .section__subtitle{color:var(--muted)}

    .product-grid{display:grid; grid-template-columns:repeat(4,1fr); gap:1rem}
    @media (max-width: 1024px){.product-grid{grid-template-columns:repeat(3,1fr)}}
    @media (max-width: 768px){ .hero__inner{grid-template-columns:1fr} .product-grid{grid-template-columns:repeat(2,1fr)} }
    @media (max-width: 520px){ .product-grid{grid-template-columns:1fr} }

    .product-card{background:var(--gray-900); border:1px solid rgba(255,195,0,.12); border-radius:var(--radius); overflow:hidden; transition:transform .2s ease, box-shadow .2s ease}
    .product-card:hover{transform:translateY(-2px); box-shadow:0 8px 30px rgba(255,195,0,.12)}
    .product-card__media{position:relative; background:linear-gradient(180deg,#1a1a1a,#111)}
    .product-card__img{aspect-ratio:4/3; object-fit:cover}
    .product-card__badge{position:absolute; top:.6rem; left:.6rem; background:rgba(255,195,0,.1); color:var(--yellow); border:1px solid rgba(255,195,0,.45); padding:.25rem .5rem; border-radius:999px; font-size:.8rem}
    .product-card__body{padding:1rem}
    .product-card__title{margin:.2rem 0 .4rem; font-weight:600}
    .product-card__spec{color:var(--muted); font-size:.95rem}
    .product-card__foot{display:flex; align-items:center; justify-content:space-between; margin-top:.9rem}
    .price{font-weight:700}

    /* =====================
       FOOTER
       ===================== */
    .site-footer{margin-top:3rem; padding:2rem 0; color:#cfcfcf; background:linear-gradient(180deg, #0d0d0d, #0b0b0b); border-top:1px solid rgba(255,195,0,.12)}
    .site-footer a{color:var(--yellow)}

    /* Small utility */
    .sr-only{position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0}
  </style>
</head>
<body>
  <!-- ===================== HEADER ===================== -->
  <!-- TOPBAR -->
  <div class="topbar">
    <div class="container topbar__inner">
      <div class="topbar__info">
        <span><i class="fa-solid fa-phone"></i> 0900 000 000</span>
        <span><i class="fa-solid fa-envelope"></i> info@tmt.vn</span>
      </div>
      <div class="topbar__links">
        <a href="#">Đăng nhập</a>
        <a href="#">Đăng ký</a>
      </div>
    </div>
  </div>

  <!-- HEADER -->
  <header class="site-header" role="banner">
    <!-- NEW: TOPBAR -->
    <div class="site-header__top" aria-label="Thanh thông tin đầu trang">
      <div class="container topbar">
        <div class="topbar__left">
          <a class="topbar__link" href="tel:0900000000">
            <!-- phone icon -->
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 006.6 6.6l2.2-2.2a1 1 0 011-.24 11.7 11.7 0 003.7.6 1 1 0 011 1v3.5a1 1 0 01-1 1A18.9 18.9 0 013 5a1 1 0 011-1h3.5a1 1 0 011 1 11.7 11.7 0 00.6 3.7 1 1 0 01-.24 1l-2.26 2.1z"/></svg>
            <span>0900 000 000</span>
          </a>
          <a class="topbar__link" href="mailto:info@tmt.vn">
            <!-- mail icon -->
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
            <span>info@tmt.vn</span>
          </a>
          <span class="topbar__link" aria-label="Giờ làm việc">
            <!-- clock icon -->
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 10.41l3.3 1.9-.76 1.32L11 13V6h2v6.41z"/></svg>
            <span>08:00–20:00</span>
          </span>
        </div>
        <div class="topbar__right">
          <a class="topbar__icon" href="#" aria-label="Facebook" title="Facebook">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 10-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.4h-1.3c-1.3 0-1.7.8-1.7 1.6V12h2.9l-.5 2.9h-2.4v7A10 10 0 0022 12z"/></svg>
          </a>
          <a class="topbar__icon" href="#" aria-label="Zalo" title="Zalo">
            <!-- chat bubble icon as placeholder -->
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 2H4a2 2 0 00-2 2v14l4-4h14a2 2 0 002-2V4a2 2 0 00-2-2z"/></svg>
          </a>
        </div>
      </div>
    </div>
    <div class="container site-header__bar">
      <div class="brand">
        <div class="brand__logo" aria-hidden="true"></div>
        <div class="brand__name">TMT Computer</div>
      </div>
      <nav class="site-nav" aria-label="Điều hướng chính">
        <a class="site-nav__link" href="#sp">Sản phẩm</a>
        <a class="site-nav__link" href="#dv">Dịch vụ</a>
        <a class="site-nav__link" href="#km">Khuyến mãi</a>
        <a class="site-nav__link" href="#lh">Liên hệ</a>
      </nav>
      <div class="site-header__cta">
        <a class="btn btn--ghost" href="#"><i class="fa-solid fa-user"></i> Tài khoản</a>
        <a class="btn btn--primary" href="#"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng</a>
      </div>
    </div>
  </header>

  <!-- ===================== HERO ===================== -->
  <section class="hero">
    <div class="container hero__inner">
      <div class="hero__copy">
        <h1 class="hero__title">Hiệu năng bứt phá — Thiết kế <span class="glow">Vàng–Đen</span> sang trọng</h1>
        <p class="hero__desc">Máy tính văn phòng & gaming, lắp đặt camera, cài đặt phần mềm trọn gói. Bảo hành nhanh. Hỗ trợ kỹ thuật tận nơi.</p>
        <div class="hero__actions">
          <a class="btn btn--primary" href="#sp">Mua ngay</a>
          <a class="btn btn--ghost" href="#dv">Xem dịch vụ</a>
        </div>
      </div>
      <div class="hero__media">
        <div class="mock">
          <div class="mock__bar">
            <span class="mock__dot"></span>
            <span class="mock__dot"></span>
            <span class="mock__dot"></span>
          </div>
          <div class="mock__screen">
            <span class="mock__screen-cta">Demo UI vàng–đen</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== PRODUCTS ===================== -->
  <section id="sp" class="section container">
    <div class="section__head">
      <h2 class="section__title">Sản phẩm nổi bật</h2>
      <div class="section__subtitle">Cấu hình tối ưu cho nhu cầu thực tế</div>
    </div>

    <div class="product-grid">
      <!-- Card 1 -->
      <article class="product-card">
        <div class="product-card__media">
          <img class="product-card__img" src="https://picsum.photos/seed/pc1/600/450" alt="PC văn phòng hiệu năng ổn định">
          <span class="product-card__badge">-10%</span>
        </div>
        <div class="product-card__body">
          <h3 class="product-card__title">PC Văn Phòng Compact</h3>
          <div class="product-card__spec">i5 | 16GB RAM | 512GB SSD</div>
          <div class="product-card__foot">
            <div class="price">10.990.000₫</div>
            <a class="btn btn--primary" href="#">Thêm vào giỏ</a>
          </div>
        </div>
      </article>

      <!-- Card 2 -->
      <article class="product-card">
        <div class="product-card__media">
          <img class="product-card__img" src="https://picsum.photos/seed/pc2/600/450" alt="PC gaming màu đen vàng">
          <span class="product-card__badge">HOT</span>
        </div>
        <div class="product-card__body">
          <h3 class="product-card__title">PC Gaming Vàng–Đen</h3>
          <div class="product-card__spec">Ryzen 7 | 32GB | RTX 4070</div>
          <div class="product-card__foot">
            <div class="price">34.990.000₫</div>
            <a class="btn btn--primary" href="#">Thêm vào giỏ</a>
          </div>
        </div>
      </article>

      <!-- Card 3 -->
      <article class="product-card">
        <div class="product-card__media">
          <img class="product-card__img" src="https://picsum.photos/seed/pc3/600/450" alt="Laptop mỏng nhẹ màu đen">
          <span class="product-card__badge">New</span>
        </div>
        <div class="product-card__body">
          <h3 class="product-card__title">Laptop Ultrabook</h3>
          <div class="product-card__spec">i7 | 16GB | 1TB SSD</div>
          <div class="product-card__foot">
            <div class="price">27.490.000₫</div>
            <a class="btn btn--primary" href="#">Thêm vào giỏ</a>
          </div>
        </div>
      </article>

      <!-- Card 4 -->
      <article class="product-card">
        <div class="product-card__media">
          <img class="product-card__img" src="https://picsum.photos/seed/pc4/600/450" alt="Màn hình 27 inch">
          <span class="product-card__badge">Sale</span>
        </div>
        <div class="product-card__body">
          <h3 class="product-card__title">Màn Hình 27" 144Hz</h3>
          <div class="product-card__spec">IPS | 2K | Bezel mỏng</div>
          <div class="product-card__foot">
            <div class="price">5.990.000₫</div>
            <a class="btn btn--primary" href="#">Thêm vào giỏ</a>
          </div>
        </div>
      </article>
    </div>
  </section>

  <!-- ===================== SERVICES / CTA ===================== -->
  <section id="dv" class="section" style="background:linear-gradient(180deg,#0d0d0d,#0b0b0b)">
    <div class="container">
      <div class="section__head">
        <h2 class="section__title">Dịch vụ kỹ thuật</h2>
        <div class="section__subtitle">Sửa chữa máy tính, lắp đặt camera, cài đặt phần mềm</div>
      </div>
      <div class="hero__actions">
        <a class="btn btn--primary" href="#lh">Yêu cầu báo giá</a>
        <a class="btn btn--ghost" href="#">Tư vấn miễn phí</a>
      </div>
    </div>
  </section>

  <!-- ===================== FOOTER ===================== -->
  <footer class="site-footer" role="contentinfo" id="lh">
    <div class="container">
      <p><strong>TMT Computer</strong> — Thi công lắp đặt mạng, camera & máy chủ. Hotline: <a href="tel:0900000000">0900 000 000</a></p>
      <small>© 2025 TMT Việt Nam. Thiết kế bởi giao diện Vàng–Đen.</small>
    </div>
  </footer>

  <!-- (Optional) JS: mobile nav toggle (gợi ý) -->
  <script>
    // Gợi ý thêm: bạn có thể gắn script toggle menu mobile ở đây
  </script>
</body>
</html>
