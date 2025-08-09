<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TechStore — Demo Theme Vàng (Light)</title>
  <style>
    :root{
      --yellow-50:#FFF9DB; /* nền vàng rất nhạt */
      --yellow-100:#FFEF99;
      --yellow-300:#FFD43B; /* màu chủ đạo */
      --yellow-400:#FFC300; /* nhấn mạnh/CTA */
      --yellow-700:#9C7A00;
      --gray-25:#FAFAFA;
      --gray-50:#F5F5F5;
      --gray-100:#EFEFEF;
      --gray-300:#DADADA;
      --gray-700:#3B3B3B;
      --gray-900:#1C1C1C;
      --radius:16px;
      --shadow:0 8px 24px rgb(0 0 0 / .08), 0 1px 0 rgb(0 0 0 / .06);
    }
    *{box-sizing:border-box}
    html,body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,"Apple Color Emoji","Segoe UI Emoji";background:#fff;color:var(--gray-900)}
    a{color:inherit;text-decoration:none}
    img{max-width:100%;display:block}
    .container{width:min(1200px, 100% - 32px);margin-inline:auto}
    .btn{display:inline-flex;align-items:center;gap:.5rem;padding:.75rem 1rem;border-radius:999px;background:var(--yellow-400);color:#111;font-weight:700;border:1px solid #0000;box-shadow:var(--shadow);transition:.2s}
    .btn:hover{background:#111;color:#fff;transform:translateY(-1px)}
    .btn.outline{background:#fff;border-color:var(--gray-300)}

    /* HEADER */
    .header-top{background:var(--yellow-50);border-bottom:1px solid var(--gray-100);font-size:.9rem}
    .header-top__wrap{display:flex;justify-content:space-between;align-items:center;padding:.5rem 0}
    .header-top__info{display:flex;gap:1rem;align-items:center}
    .header{position:sticky;top:0;background:#fff;z-index:50;border-bottom:1px solid var(--gray-100)}
    .header__wrap{display:grid;grid-template-columns:220px 1fr 220px;gap:1rem;align-items:center;padding:1rem 0}
    .logo{display:flex;align-items:center;gap:.5rem;font-size:1.25rem;font-weight:800}
    .logo__mark{width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,var(--yellow-300),#fff)}

    .search{display:flex;align-items:center;background:var(--gray-50);border:1px solid var(--gray-100);border-radius:999px;overflow:hidden}
    .search input{flex:1;padding:.75rem 1rem;border:0;background:transparent;outline:none}
    .search button{border:0;background:var(--yellow-400);padding:.75rem 1rem;font-weight:700}
    .header__actions{display:flex;justify-content:flex-end;gap:.5rem}
    .icon-btn{display:inline-grid;place-items:center;width:42px;height:42px;border-radius:999px;border:1px solid var(--gray-300);background:#fff}

    .nav{border-top:1px solid var(--gray-100);background:#fff}
    .nav__wrap{display:flex;gap:1rem;align-items:center;padding:.5rem 0}
    .nav__link{padding:.5rem .75rem;border-radius:10px}
    .nav__link:hover{background:var(--yellow-50)}
    .menu-toggle{display:none}

    /* HERO */
    .hero{background:linear-gradient(180deg,#fff, var(--yellow-50));padding:2rem 0}
    .hero__grid{display:grid;grid-template-columns:1.3fr .7fr;gap:1rem}
    .hero__card{border:1px solid var(--gray-100);border-radius:var(--radius);padding:2rem;background:#fff;box-shadow:var(--shadow)}
    .hero__title{font-size:clamp(1.5rem,1rem+1.8vw,2.4rem);line-height:1.2;margin:0 0 .5rem}
    .hero__subtitle{color:var(--gray-700);margin:.25rem 0 1rem}

    /* CATEGORIES */
    .cats{padding:1.5rem 0}
    .cats__grid{display:grid;grid-template-columns:repeat(6,1fr);gap:1rem}
    .cat{background:#fff;border:1px solid var(--gray-100);border-radius:14px;padding:1rem;display:flex;flex-direction:column;align-items:center;gap:.5rem;transition:.2s}
    .cat:hover{transform:translateY(-2px);box-shadow:var(--shadow)}
    .cat__icon{width:44px;height:44px;border-radius:12px;background:var(--yellow-50);display:grid;place-items:center;font-weight:800}
    .section-title{display:flex;align-items:center;justify-content:space-between;margin:1rem 0 .75rem}

    /* PRODUCTS */
    .products{padding:1rem 0 2rem}
    .grid{display:grid;grid-template-columns:repeat(5,1fr);gap:1rem}
    .card{background:#fff;border:1px solid var(--gray-100);border-radius:var(--radius);overflow:hidden;display:flex;flex-direction:column}
    .card__media{aspect-ratio:4/3;background:linear-gradient(135deg,var(--gray-50),#fff);display:grid;place-items:center}
    .pill{position:absolute;inset:auto auto .5rem .5rem;background:var(--yellow-300);padding:.25rem .5rem;border-radius:999px;font-size:.75rem;font-weight:700}
    .card__body{padding:1rem;display:flex;flex-direction:column;gap:.5rem}
    .card__title{font-weight:700}
    .price{display:flex;align-items:center;gap:.5rem}
    .price__new{font-size:1.1rem;font-weight:800;color:#111}
    .price__old{color:var(--gray-700);text-decoration:line-through}
    .card__actions{display:flex;gap:.5rem;margin-top:auto}

    /* BLOG */
    .blog{padding:2rem 0;border-top:1px solid var(--gray-100)}
    .blog__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}
    .post{background:#fff;border:1px solid var(--gray-100);border-radius:var(--radius);overflow:hidden}
    .post__thumb{aspect-ratio:16/9;background:linear-gradient(135deg,var(--yellow-50),#fff)}
    .post__body{padding:1rem}

    /* FOOTER */
    .footer{margin-top:2rem;background:var(--gray-50);border-top:1px solid var(--gray-100)}
    .footer__wrap{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:1rem;padding:2rem 0}
    .footer h4{margin:0 0 .5rem}
    .copyright{border-top:1px solid var(--gray-100);padding:1rem 0;font-size:.9rem;color:var(--gray-700)}

    /* RESPONSIVE */
    @media (max-width: 1100px){
      .grid{grid-template-columns:repeat(4,1fr)}
      .cats__grid{grid-template-columns:repeat(4,1fr)}
    }
    @media (max-width: 860px){
      .header__wrap{grid-template-columns:1fr;gap:.75rem}
      .hero__grid{grid-template-columns:1fr}
      .grid{grid-template-columns:repeat(2,1fr)}
      .cats__grid{grid-template-columns:repeat(3,1fr)}
      .footer__wrap{grid-template-columns:1fr 1fr}
      .menu-toggle{display:inline-flex}
      .nav__wrap{display:none}
      .nav__wrap.is-open{display:flex;flex-wrap:wrap}
    }
    @media (max-width:520px){
      .cats__grid{grid-template-columns:repeat(2,1fr)}
      .blog__grid{grid-template-columns:1fr}
    }
  </style>
</head>
<body>
  <!-- HEADER TOP -->
  <div class="header-top">
    <div class="container header-top__wrap">
      <div class="header-top__info">
        <span>📞 Hotline: <strong>1900 6868</strong></span>
        <span>🚚 Miễn phí vận chuyển đơn &gt; 2.000.000đ</span>
      </div>
      <div class="header-top__info">
        <a href="#">Đăng nhập</a>
        <span>•</span>
        <a href="#">Đăng ký</a>
      </div>
    </div>
  </div>

  <header class="header">
    <div class="container header__wrap">
      <a class="logo" href="#">
        <span class="logo__mark"></span>
        <span>TechStore</span>
      </a>
      <form class="search" role="search">
        <input type="search" placeholder="Tìm laptop, PC, linh kiện…" aria-label="Tìm kiếm" />
        <button type="submit">Tìm</button>
      </form>
      <div class="header__actions">
        <button class="icon-btn" title="Wishlist" aria-label="Wishlist">❤</button>
        <button class="icon-btn" title="Giỏ hàng" aria-label="Giỏ hàng">🛒</button>
      </div>
    </div>
    <div class="container">
      <button class="btn menu-toggle" id="menuToggle" aria-expanded="false" aria-controls="mainNav">☰ Menu</button>
      <nav class="nav" id="mainNav">
        <div class="container nav__wrap" id="navWrap">
          <a class="nav__link" href="#">Laptop</a>
          <a class="nav__link" href="#">PC Lắp Ráp</a>
          <a class="nav__link" href="#">Linh Kiện</a>
          <a class="nav__link" href="#">Màn Hình</a>
          <a class="nav__link" href="#">Gaming Gear</a>
          <a class="nav__link" href="#">Phần Mềm</a>
          <a class="nav__link" href="#">Khuyến Mãi</a>
        </div>
      </nav>
    </div>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="container hero__grid">
      <div class="hero__card">
        <h1 class="hero__title">Sale Vàng Tháng 8 — Laptop & PC giảm đến 30%</h1>
        <p class="hero__subtitle">Chọn cấu hình phù hợp công việc, chiến game mượt — Bảo hành chính hãng.</p>
        <div style="display:flex;gap:.75rem;flex-wrap:wrap">
          <a class="btn" href="#">Mua ngay</a>
          <a class="btn outline" href="#">Xem khuyến mãi</a>
        </div>
        <div style="margin-top:1rem;display:grid;grid-template-columns:repeat(3,1fr);gap:1rem">
          <div class="cat">
            <div class="cat__icon">💻</div>
            <div>Laptop văn phòng</div>
          </div>
          <div class="cat">
            <div class="cat__icon">🎮</div>
            <div>Laptop gaming</div>
          </div>
          <div class="cat">
            <div class="cat__icon">🖥</div>
            <div>PC dựng sẵn</div>
          </div>
        </div>
      </div>
      <div class="hero__card" aria-hidden="true">
        <div style="aspect-ratio:4/3;border-radius:12px;background:linear-gradient(135deg,var(--yellow-100),#fff);display:grid;place-items:center;position:relative">
          <span class="pill">Hot Deal</span>
          <svg width="60%" viewBox="0 0 600 400" role="img" aria-label="Minh họa laptop">
            <rect x="60" y="80" width="480" height="260" rx="14" fill="#111"/>
            <rect x="80" y="100" width="440" height="220" rx="8" fill="#fff"/>
            <rect x="20" y="340" width="560" height="18" rx="9" fill="#111"/>
          </svg>
        </div>
        <div style="margin-top:1rem;display:flex;align-items:center;justify-content:space-between">
          <div>
            <div style="font-weight:800">Laptop Ultrabook 14”</div>
            <div class="price"><span class="price__new">18.990.000₫</span><span class="price__old">21.990.000₫</span></div>
          </div>
          <a class="btn" href="#">Thêm vào giỏ</a>
        </div>
      </div>
    </div>
  </section>

  <!-- CATEGORIES -->
  <section class="cats container">
    <div class="section-title"><h2>Danh mục nổi bật</h2><a href="#">Xem tất cả →</a></div>
    <div class="cats__grid">
      <a class="cat" href="#"><div class="cat__icon">💻</div><div>Laptop</div></a>
      <a class="cat" href="#"><div class="cat__icon">🖥</div><div>PC</div></a>
      <a class="cat" href="#"><div class="cat__icon">🧩</div><div>Mainboard</div></a>
      <a class="cat" href="#"><div class="cat__icon">🧠</div><div>CPU</div></a>
      <a class="cat" href="#"><div class="cat__icon">🎮</div><div>VGA</div></a>
      <a class="cat" href="#"><div class="cat__icon">🖱</div><div>Chuột</div></a>
    </div>
  </section>

  <!-- PRODUCTS HIGHLIGHT -->
  <section class="products container">
    <div class="section-title"><h2>Sản phẩm nổi bật</h2><a href="#">Xem tất cả →</a></div>
    <div class="grid">
      <!-- Product Card x5 -->
      <article class="card">
        <div class="card__media" style="position:relative">
          <span class="pill">-15%</span>
          <svg width="60%" viewBox="0 0 600 400" style="margin:auto">
            <rect x="100" y="120" width="400" height="160" rx="18" fill="#111"/>
            <rect x="120" y="140" width="360" height="120" rx="8" fill="#fff"/>
          </svg>
        </div>
        <div class="card__body">
          <div class="card__title">Laptop 15.6" i5-12450H, 16GB, SSD 512GB</div>
          <div class="price"><span class="price__new">16.490.000₫</span><span class="price__old">18.990.000₫</span></div>
          <div class="card__actions">
            <a class="btn" href="#">Thêm vào giỏ</a>
            <a class="btn outline" href="#">So sánh</a>
          </div>
        </div>
      </article>

      <article class="card">
        <div class="card__media">
          <svg width="60%" viewBox="0 0 600 400" style="margin:auto">
            <circle cx="300" cy="200" r="120" fill="#111"/>
            <circle cx="300" cy="200" r="96" fill="#fff"/>
          </svg>
        </div>
        <div class="card__body">
          <div class="card__title">Màn hình 27" IPS 2K 165Hz</div>
          <div class="price"><span class="price__new">5.990.000₫</span></div>
          <div class="card__actions">
            <a class="btn" href="#">Thêm vào giỏ</a>
            <a class="btn outline" href="#">So sánh</a>
          </div>
        </div>
      </article>

      <article class="card">
        <div class="card__media">
          <svg width="65%" viewBox="0 0 600 400" style="margin:auto">
            <rect x="160" y="90" width="280" height="220" rx="20" fill="#111"/>
            <rect x="180" y="110" width="240" height="180" rx="10" fill="#fff"/>
          </svg>
        </div>
        <div class="card__body">
          <div class="card__title">Card đồ họa RTX 4060 8GB</div>
          <div class="price"><span class="price__new">9.490.000₫</span></div>
          <div class="card__actions">
            <a class="btn" href="#">Thêm vào giỏ</a>
            <a class="btn outline" href="#">So sánh</a>
          </div>
        </div>
      </article>

      <article class="card">
        <div class="card__media">
          <svg width="60%" viewBox="0 0 600 400" style="margin:auto">
            <rect x="200" y="100" width="200" height="200" rx="16" fill="#111"/>
            <rect x="220" y="120" width="160" height="160" rx="10" fill="#fff"/>
          </svg>
        </div>
        <div class="card__body">
          <div class="card__title">CPU Ryzen 7 7800X3D</div>
          <div class="price"><span class="price__new">10.990.000₫</span></div>
          <div class="card__actions">
            <a class="btn" href="#">Thêm vào giỏ</a>
            <a class="btn outline" href="#">So sánh</a>
          </div>
        </div>
      </article>

      <article class="card">
        <div class="card__media">
          <svg width="60%" viewBox="0 0 600 400" style="margin:auto">
            <rect x="140" y="120" width="320" height="160" rx="12" fill="#111"/>
            <rect x="160" y="140" width="280" height="120" rx="8" fill="#fff"/>
          </svg>
        </div>
        <div class="card__body">
          <div class="card__title">Laptop 14" i7, OLED</div>
          <div class="price"><span class="price__new">28.990.000₫</span></div>
          <div class="card__actions">
            <a class="btn" href="#">Thêm vào giỏ</a>
            <a class="btn outline" href="#">So sánh</a>
          </div>
        </div>
      </article>
    </div>
  </section>

  <!-- BLOG -->
  <section class="blog">
    <div class="container">
      <div class="section-title"><h2>Tin tức & Mẹo hay</h2><a href="#">Xem tất cả →</a></div>
      <div class="blog__grid">
        <article class="post">
          <div class="post__thumb"></div>
          <div class="post__body">
            <h3>Hướng dẫn chọn laptop theo nhu cầu 2025</h3>
            <p class="post__meta" style="color:var(--gray-700);font-size:.95rem">10/08/2025 • 6 phút đọc</p>
          </div>
        </article>
        <article class="post">
          <div class="post__thumb"></div>
          <div class="post__body">
            <h3>Build PC 20 triệu: Tối ưu hiệu năng/giá</h3>
            <p class="post__meta" style="color:var(--gray-700);font-size:.95rem">08/08/2025 • 7 phút đọc</p>
          </div>
        </article>
        <article class="post">
          <div class="post__thumb"></div>
          <div class="post__body">
            <h3>Top 5 màn hình 27" 2K cho designer</h3>
            <p class="post__meta" style="color:var(--gray-700);font-size:.95rem">05/08/2025 • 5 phút đọc</p>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container footer__wrap">
      <div>
        <h4>TechStore</h4>
        <p>Giải pháp máy tính toàn diện: laptop, PC, linh kiện, phần mềm chính hãng.</p>
      </div>
      <div>
        <h4>Hỗ trợ</h4>
        <ul style="list-style:none;padding:0;margin:0;display:grid;gap:.25rem">
          <li><a href="#">Liên hệ</a></li>
          <li><a href="#">Bảo hành</a></li>
          <li><a href="#">Vận chuyển</a></li>
        </ul>
      </div>
      <div>
        <h4>Chính sách</h4>
        <ul style="list-style:none;padding:0;margin:0;display:grid;gap:.25rem">
          <li><a href="#">Mua hàng</a></li>
          <li><a href="#">Đổi trả</a></li>
          <li><a href="#">Bảo mật</a></li>
        </ul>
      </div>
      <div>
        <h4>Kết nối</h4>
        <div style="display:flex;gap:.5rem">
          <a class="icon-btn" href="#" aria-label="Facebook">f</a>
          <a class="icon-btn" href="#" aria-label="YouTube">▶</a>
          <a class="icon-btn" href="#" aria-label="Zalo">Z</a>
        </div>
      </div>
    </div>
    <div class="container copyright">© 2025 TechStore. All rights reserved.</div>
  </footer>

  <script>
    // Toggle menu on mobile
    const toggleBtn = document.getElementById('menuToggle');
    const navWrap = document.getElementById('navWrap');
    toggleBtn?.addEventListener('click', ()=>{
      const open = navWrap.classList.toggle('is-open');
      toggleBtn.setAttribute('aria-expanded', open ? 'true':'false');
    });
  </script>
</body>
</html>
