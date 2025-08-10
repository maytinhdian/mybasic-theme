<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ComputerX — Vàng/Đen</title>
  <style>
    :root{
      --yellow: rgb(255,189,57);
      --yellow-600: rgb(237,168,25);
      --yellow-700: rgb(212,147,19);
      --black: #0f1115;           /* đen pha xanh cho dịu mắt */
      --gray-900:#14171f;
      --gray-800:#1b2030;
      --gray-700:#242a3a;
      --gray-600:#2e364a;
      --text: #0d1117;            /* màu chữ mặc định (trên nền sáng) */
      --muted:#64748b;
      --bg:#f6f7fb;               /* nền tổng thể sáng (light theme) */
      --card:#ffffff;
      --ring: color-mix(in srgb, var(--yellow) 40%, transparent);
      --radius: 16px;
      --shadow-soft: 0 8px 24px rgb(0 0 0 / 0.10), 0 1px 0 rgb(0 0 0 / 0.06);
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji","Segoe UI Emoji";
      color:var(--text); background:var(--bg); line-height:1.5;
    }
    a{color:inherit; text-decoration:none}
    .container{width:min(1200px, 92vw); margin-inline:auto}

    /* Top bar */
    .topbar{background:var(--black); color:#fff; font-size:13px}
    .topbar .inner{display:flex; align-items:center; justify-content:space-between; gap:12px; padding:8px 0}
    .topbar .left, .topbar .right{display:flex; align-items:center; gap:20px}
    .topbar .pill{display:inline-flex; align-items:center; gap:8px; padding:4px 10px; border-radius:999px; background:var(--gray-800);}
    .topbar .cta{color:var(--black); background:var(--yellow); border-radius:999px; padding:4px 10px; font-weight:600}

    /* Header */
    header{background:#fff; position:sticky; top:0; z-index:50; box-shadow:var(--shadow-soft)}
    .header-row{display:grid; grid-template-columns: 180px 1fr 220px; align-items:center; gap:16px; padding:14px 0}
    .brand{display:flex; align-items:center; gap:10px}
    .brand-logo{width:36px; height:36px; border-radius:10px; background:var(--black); position:relative; box-shadow: inset 0 0 0 2px var(--yellow)}
    .brand b{font-size:20px; letter-spacing:0.5px}

    .search{position:relative}
    .search input{
      width:100%; padding:12px 44px 12px 14px; border-radius:999px; border:1px solid #e5e7eb; background:#fff; outline: none;
    }
    .search input:focus{box-shadow:0 0 0 4px var(--ring); border-color:var(--yellow-600)}
    .search button{position:absolute; right:2px; top:2px; bottom:2px; width:42px; border:none; border-radius:999px; background:var(--yellow); cursor:pointer}

    .actions{display:flex; justify-content:flex-end; align-items:center; gap:12px}
    .icon-btn{display:inline-flex; align-items:center; gap:8px; padding:10px 12px; border-radius:999px; border:1px solid #e5e7eb; background:#fff; font-weight:600}
    .icon{width:18px; height:18px; display:inline-block}
    .i-user{background: conic-gradient(from 0deg at 50% 40%, var(--black) 0 25%, transparent 0 100%), radial-gradient(circle at 50% 65%, var(--black) 38%, transparent 39%) ; border-radius:50%}
    .i-cart{background:
      radial-gradient(circle at 25% 30%, var(--black) 18%, transparent 19%),
      radial-gradient(circle at 75% 30%, var(--black) 18%, transparent 19%),
      linear-gradient(var(--black), var(--black));
      clip-path: path('M5 8 Q10 14 15 8 V16 H5 Z');
    }

    /* Nav */
    nav{background:var(--black); color:#fff}
    .nav-row{display:flex; align-items:center; gap:12px; padding:10px 0;}
    .menu{display:flex; align-items:center; gap:16px; list-style:none; margin:0; padding:0}
    .menu > li > a{display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:10px; font-weight:600}
    .menu > li > a:hover{background:var(--gray-800)}
    .badge{display:inline-block; font-size:12px; padding:2px 6px; border-radius:999px; background:var(--yellow); color:var(--black); font-weight:700}

    /* Hero */
    .hero{background: linear-gradient(180deg, var(--yellow) 0%, var(--yellow-600) 100%);
      color:#0a0a0a; position:relative; overflow:hidden}
    .hero .wrap{display:grid; grid-template-columns: 1.1fr 0.9fr; gap:24px; align-items:center; padding:34px 0}
    .hero h1{font-size: clamp(28px, 3.5vw, 44px); margin:0 0 10px; letter-spacing:0.2px}
    .hero p{margin:0 0 18px; color:#222}
    .hero .cta-row{display:flex; gap:12px; flex-wrap:wrap}
    .btn{display:inline-flex; align-items:center; gap:10px; padding:12px 18px; border-radius:12px; border:1.5px solid #111; background:#111; color:#fff; font-weight:700}
    .btn.alt{background:transparent; color:#111}

    .hero-art{aspect-ratio: 16/10; background: radial-gradient(circle at 30% 30%, rgba(255,255,255,.35), transparent 40%),
      linear-gradient(120deg, #111 0 20%, #333 20% 40%, #111 40% 60%, #333 60% 80%, #111 80% 100%);
      border-radius: 18px; box-shadow: var(--shadow-soft); position:relative}
    .hero-art::after{content:""; position:absolute; inset:12px; border-radius:16px; background:radial-gradient(circle at 30% 30%, rgba(255,189,57,.25), transparent 60%)}

    /* Category chips */
    .chips{display:flex; flex-wrap:wrap; gap:10px; padding:18px 0}
    .chip{display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px; background:#fff; border:1px solid #e5e7eb}
    .chip .dot{width:8px; height:8px; border-radius:50%; background:var(--yellow)}

    /* Products */
    .section{padding:28px 0}
    .section h2{font-size: clamp(22px, 2.4vw, 30px); margin:0 0 10px}
    .section .sub{color:var(--muted); margin-bottom:16px}

    .grid{display:grid; grid-template-columns: repeat(4, 1fr); gap:16px}
    .card{background:var(--card); border:1px solid #e5e7eb; border-radius:var(--radius); overflow:hidden; position:relative; transition: transform .2s ease, box-shadow .2s ease}
    .card:hover{transform: translateY(-2px); box-shadow:var(--shadow-soft)}
    .card .thumb{background:#0f0f12; aspect-ratio: 1.1/1; display:grid; place-items:center; position:relative}
    .thumb .sticker{position:absolute; left:10px; top:10px; background:var(--yellow); color:#111; padding:4px 8px; border-radius:999px; font-size:12px; font-weight:800}
    .gpu-shape{width:70%; height:56%; border-radius:10px; background:linear-gradient(180deg,#1b1f2a,#0d1117); outline:2px solid var(--yellow); outline-offset:-8px; position:relative}
    .gpu-shape::after{content:""; position:absolute; inset:8px; border-radius:6px; background:repeating-linear-gradient(90deg, #0d1117 0 10px, #161b22 10px 20px)}

    .card .content{padding:12px}
    .brand-row{display:flex; align-items:center; gap:8px; font-size:12px; color:var(--muted)}
    .title{font-weight:700; margin:6px 0}
    .price{display:flex; align-items:baseline; gap:8px}
    .price b{font-size:18px}
    .price s{color:#94a3b8; font-size:12px}
    .rating{font-size:12px; color:#f59e0b}
    .actions-row{display:flex; gap:8px; margin-top:10px}
    .btn-sm{padding:8px 10px; border-radius:10px; border:1px solid #e5e7eb; background:#fff; font-weight:700}
    .btn-buy{background:var(--yellow); border-color:#111; color:#111}

    /* Banners */
    .banner{display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-top:10px}
    .banner .box{background:var(--black); color:#fff; border-radius:var(--radius); padding:18px; display:grid; gap:10px; position:relative; overflow:hidden}
    .box .shine{position:absolute; inset:-20%; background: radial-gradient(circle at 30% 20%, rgba(255,189,57,.18), transparent 40%)}
    .box h3{margin:0}
    .box .kpi{display:flex; gap:16px}
    .kpi .item{background:var(--gray-700); padding:10px 12px; border-radius:12px}

    /* Footer */
    footer{margin-top:32px; background:#0c0f15; color:#cbd5e1}
    footer .cols{display:grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap:20px; padding:28px 0}
    footer h4{margin:0 0 10px; color:#fff}
    footer ul{list-style:none; padding:0; margin:0; display:grid; gap:8px}
    .copy{border-top:1px solid #1f2937; padding:14px 0; font-size:13px; color:#94a3b8}

    /* Utilities */
    .sr-only{position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0}

    /* Responsive */
    .hamburger{display:none; width:40px; height:40px; border:1px solid #e5e7eb; border-radius:10px; background:#fff}
    .bar{display:block; width:18px; height:2px; background:#111; margin:5px auto}

    @media (max-width: 1024px){
      .header-row{grid-template-columns: 1fr auto auto}
      .brand{gap:8px}
      nav .menu{display:none}
      .hamburger{display:inline-grid; place-items:center}
      .hero .wrap{grid-template-columns: 1fr}
      .grid{grid-template-columns: repeat(2, 1fr)}
      footer .cols{grid-template-columns: 1fr 1fr}
    }
    @media (max-width: 560px){
      .topbar .inner{flex-direction:column; align-items:flex-start}
      .header-row{grid-template-columns: 1fr auto}
      .actions{display:none}
      .grid{grid-template-columns: 1fr}
      .banner{grid-template-columns: 1fr}
    }
  </style>
</head>
<body>
  <!-- TOP BAR -->
  <div class="topbar">
    <div class="container inner">
      <div class="left">
        <span class="pill">🚚 Miễn phí giao hàng nội thành</span>
        <span class="pill">🕒 Mở cửa 8:00–21:00</span>
      </div>
      <div class="right">
        <a class="cta" href="#">📞 0901 234 567</a>
        <a href="#">Hỗ trợ</a>
        <a href="#">Theo dõi đơn</a>
      </div>
    </div>
  </div>

  <!-- HEADER -->
  <header>
    <div class="container header-row">
      <a class="brand" href="#">
        <span class="brand-logo" aria-hidden="true"></span>
        <b>ComputerX</b>
      </a>
      <div class="search">
        <label class="sr-only" for="q">Tìm kiếm</label>
        <input id="q" placeholder="Tìm laptop, PC, linh kiện..." />
        <button aria-label="Tìm kiếm">🔍</button>
      </div>
      <div class="actions">
        <a class="icon-btn" href="#"><span class="icon i-user" aria-hidden="true"></span>Tài khoản</a>
        <a class="icon-btn" href="#"><span class="icon i-cart" aria-hidden="true"></span>Giỏ hàng (0)</a>
      </div>
    </div>
    <nav>
      <div class="container nav-row">
        <button class="hamburger" aria-label="Mở menu" id="btnMenu">
          <span class="bar"></span><span class="bar"></span><span class="bar"></span>
        </button>
        <ul class="menu" id="mainMenu">
          <li><a href="#">💻 Laptop</a></li>
          <li><a href="#">🖥️ PC Gaming <span class="badge">Hot</span></a></li>
          <li><a href="#">🧠 CPU</a></li>
          <li><a href="#">🎮 GPU</a></li>
          <li><a href="#">🧊 Tản nhiệt</a></li>
          <li><a href="#">🔌 Phụ kiện</a></li>
          <li><a href="#">⚡ Khuyến mãi</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="container wrap">
      <div>
        <h1>Hiệu năng bùng nổ — Giá tốt mỗi ngày</h1>
        <p>Nâng cấp PC/laptop với linh kiện chính hãng. Bảo hành 1 đổi 1 trong 30 ngày, trả góp 0%.</p>
        <div class="cta-row">
          <a class="btn" href="#">Mua ngay ⟶</a>
          <a class="btn alt" href="#">Xem combo build</a>
        </div>
        <div class="chips">
          <span class="chip"><span class="dot"></span> Giao nhanh 2h</span>
          <span class="chip"><span class="dot"></span> Lắp đặt tận nơi</span>
          <span class="chip"><span class="dot"></span> Hỗ trợ 24/7</span>
        </div>
      </div>
      <div class="hero-art" role="img" aria-label="Mảng phần cứng với ánh vàng"></div>
    </div>
  </section>

  <!-- BANNERS KPI -->
  <div class="container banner section">
    <div class="box">
      <div class="shine"></div>
      <h3>Ưu đãi tháng 8</h3>
      <div class="kpi">
        <div class="item">🎁 Tặng chuột gaming</div>
        <div class="item">💳 Trả góp 0%</div>
        <div class="item">🛠️ Lắp đặt miễn phí</div>
      </div>
    </div>
    <div class="box">
      <div class="shine"></div>
      <h3>Build PC theo nhu cầu</h3>
      <p>Chọn game, chọn ngân sách — gợi ý cấu hình tối ưu.</p>
      <a class="btn" href="#">Bắt đầu ⟶</a>
    </div>
  </div>

  <!-- PRODUCTS -->
  <section class="container section">
    <h2>Sản phẩm nổi bật</h2>
    <div class="sub">Giá niêm yết đã bao gồm VAT. Hàng chính hãng.</div>
    <div class="grid">
      <!-- card 1 -->
      <article class="card">
        <div class="thumb">
          <span class="sticker">-12%</span>
          <div class="gpu-shape" aria-hidden="true"></div>
        </div>
        <div class="content">
          <div class="brand-row">ASUS • RTX 4060</div>
          <div class="title">Card màn hình Dual GeForce RTX™ 4060 8GB</div>
          <div class="price"><b>7.990.000₫</b> <s>9.090.000₫</s></div>
          <div class="rating">★★★★★ (128)</div>
          <div class="actions-row">
            <button class="btn-sm btn-buy">Thêm vào giỏ</button>
            <button class="btn-sm">So sánh</button>
          </div>
        </div>
      </article>

      <!-- card 2 -->
      <article class="card">
        <div class="thumb">
          <div class="gpu-shape" aria-hidden="true"></div>
        </div>
        <div class="content">
          <div class="brand-row">Intel • Core i5-14400F</div>
          <div class="title">CPU Intel Core i5-14400F (10C/16T, up to 4.7GHz)</div>
          <div class="price"><b>4.990.000₫</b></div>
          <div class="rating">★★★★☆ (87)</div>
          <div class="actions-row">
            <button class="btn-sm btn-buy">Thêm vào giỏ</button>
            <button class="btn-sm">So sánh</button>
          </div>
        </div>
      </article>

      <!-- card 3 -->
      <article class="card">
        <div class="thumb">
          <div class="gpu-shape" aria-hidden="true"></div>
        </div>
        <div class="content">
          <div class="brand-row">Lenovo • IdeaPad 5</div>
          <div class="title">Laptop IdeaPad 5 14" Ryzen 7 • 16GB • 512GB</div>
          <div class="price"><b>15.490.000₫</b> <s>16.990.000₫</s></div>
          <div class="rating">★★★★☆ (45)</div>
          <div class="actions-row">
            <button class="btn-sm btn-buy">Thêm vào giỏ</button>
            <button class="btn-sm">So sánh</button>
          </div>
        </div>
      </article>

      <!-- card 4 -->
      <article class="card">
        <div class="thumb">
          <div class="gpu-shape" aria-hidden="true"></div>
        </div>
        <div class="content">
          <div class="brand-row">Kingston • NV2</div>
          <div class="title">SSD NVMe Kingston NV2 1TB Gen4</div>
          <div class="price"><b>1.450.000₫</b></div>
          <div class="rating">★★★★★ (320)</div>
          <div class="actions-row">
            <button class="btn-sm btn-buy">Thêm vào giỏ</button>
            <button class="btn-sm">So sánh</button>
          </div>
        </div>
      </article>

      <!-- card 5 -->
      <article class="card">
        <div class="thumb">
          <div class="gpu-shape" aria-hidden="true"></div>
        </div>
        <div class="content">
          <div class="brand-row">ASUS • TUF Gaming</div>
          <div class="title">Mainboard TUF GAMING B760M-PLUS WIFI</div>
          <div class="price"><b>4.190.000₫</b></div>
          <div class="rating">★★★★☆ (76)</div>
          <div class="actions-row">
            <button class="btn-sm btn-buy">Thêm vào giỏ</button>
            <button class="btn-sm">So sánh</button>
          </div>
        </div>
      </article>

      <!-- card 6 -->
      <article class="card">
        <div class="thumb">
          <div class="gpu-shape" aria-hidden="true"></div>
        </div>
        <div class="content">
          <div class="brand-row">Logitech • MX</div>
          <div class="title">Chuột không dây Logitech MX Master 3S</div>
          <div class="price"><b>2.290.000₫</b></div>
          <div class="rating">★★★★★ (1.2k)</div>
          <div class="actions-row">
            <button class="btn-sm btn-buy">Thêm vào giỏ</button>
            <button class="btn-sm">So sánh</button>
          </div>
        </div>
      </article>

      <!-- card 7 -->
      <article class="card">
        <div class="thumb">
          <div class="gpu-shape" aria-hidden="true"></div>
        </div>
        <div class="content">
          <div class="brand-row">Corsair • Vengeance</div>
          <div class="title">RAM DDR5 32GB (2x16) 6000MHz</div>
          <div class="price"><b>2.790.000₫</b></div>
          <div class="rating">★★★★☆ (210)</div>
          <div class="actions-row">
            <button class="btn-sm btn-buy">Thêm vào giỏ</button>
            <button class="btn-sm">So sánh</button>
          </div>
        </div>
      </article>

      <!-- card 8 -->
      <article class="card">
        <div class="thumb">
          <div class="gpu-shape" aria-hidden="true"></div>
        </div>
        <div class="content">
          <div class="brand-row">Cooler Master • Hyper 212</div>
          <div class="title">Tản nhiệt khí Hyper 212 Black Edition</div>
          <div class="price"><b>790.000₫</b></div>
          <div class="rating">★★★★★ (512)</div>
          <div class="actions-row">
            <button class="btn-sm btn-buy">Thêm vào giỏ</button>
            <button class="btn-sm">So sánh</button>
          </div>
        </div>
      </article>

    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="container cols">
      <div>
        <h4>ComputerX</h4>
        <p>Thi công – lắp đặt – nâng cấp PC, laptop, camera & máy chủ. Hỗ trợ doanh nghiệp và gia đình.</p>
      </div>
      <div>
        <h4>Dịch vụ</h4>
        <ul>
          <li><a href="#">Lắp đặt tận nơi</a></li>
          <li><a href="#">Bảo hành & đổi trả</a></li>
          <li><a href="#">Tư vấn build PC</a></li>
          <li><a href="#">Thanh toán & trả góp</a></li>
        </ul>
      </div>
      <div>
        <h4>Chính sách</h4>
        <ul>
          <li><a href="#">Bảo mật</a></li>
          <li><a href="#">Điều khoản</a></li>
          <li><a href="#">Vận chuyển</a></li>
        </ul>
      </div>
      <div>
        <h4>Liên hệ</h4>
        <ul>
          <li>Hotline: 0901 234 567</li>
          <li>Email: hello@computerx.vn</li>
          <li>Địa chỉ: Quận 1, TP.HCM</li>
        </ul>
      </div>
    </div>
    <div class="copy">
      <div class="container">© 2025 ComputerX. All rights reserved.</div>
    </div>
  </footer>

  <script>
    const btn = document.getElementById('btnMenu');
    const menu = document.getElementById('mainMenu');
    btn?.addEventListener('click', ()=>{
      const shown = getComputedStyle(menu).display !== 'none';
      menu.style.display = shown ? 'none' : 'flex';
      menu.style.flexDirection = 'column';
      menu.style.gap = '8px';
    });
  </script>
</body>
</html>
