<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Blog Fix Lỗi • Chia sẻ kinh nghiệm</title>
  <meta name="color-scheme" content="light dark" />
  <style>
    :root{
      --yellow:#FFBD39; /* vàng chủ đạo */
      --yellow-600:#f5b12e;
      --yellow-700:#e09b12;
      --black:#0f1115;
      --ink:#1a1d24;
      --muted:#6b7280;
      --border:#e5e7eb;
      --bg:#ffffff;
      --card:#ffffff;
      --radius:16px;
      --shadow: 0 10px 30px rgba(0,0,0,.08), 0 1px 0 rgba(0,0,0,.06);
    }
    @media (prefers-color-scheme: dark){
      :root{
        --bg:#0b0d12;
        --card:#0f131a;
        --ink:#e5e7eb;
        --border:#1f2937;
        --muted:#9aa3af;
        --shadow: 0 10px 30px rgba(0,0,0,.35), 0 1px 0 rgba(255,255,255,.02);
      }
    }
    *{box-sizing:border-box}
    html,body{margin:0;padding:0;background:var(--bg);color:var(--ink);font:16px/1.6 system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji"}
    a{color:inherit;text-decoration:none}
    img{max-width:100%;display:block}
    .container{width:min(1200px, 100% - 32px);margin-inline:auto}

    /* Topbar */
    .topbar{background:var(--black);color:#fff;font-size:14px}
    .topbar__inner{display:flex;justify-content:space-between;align-items:center;gap:12px;padding:8px 0}
    .topbar__links{display:flex;gap:16px;opacity:.9}
    .topbar a{opacity:.9}
    .topbar a:hover{opacity:1}

    /* Header */
    .header{position:sticky;top:0;z-index:50;background:linear-gradient(180deg,var(--card),rgba(255,255,255,.7));backdrop-filter:saturate(140%) blur(8px);border-bottom:1px solid var(--border)}
    .header__inner{display:grid;grid-template-columns:220px 1fr 180px;align-items:center;gap:16px;padding:14px 0}
    .brand{display:flex;align-items:center;gap:10px;font-weight:800}
    .brand__logo{width:36px;height:36px;border-radius:12px;background:radial-gradient(120% 120% at 30% 20%, var(--yellow), var(--yellow-700));box-shadow:0 6px 16px rgba(255,189,57,.4)}
    .brand__title{font-size:18px}
    .search{position:relative}
    .search input{width:100%;padding:12px 44px 12px 14px;border:1px solid var(--border);border-radius:999px;background:var(--card);color:var(--ink);outline:none}
    .search button{position:absolute;right:4px;top:4px;height:36px;padding:0 14px;border:none;border-radius:999px;background:var(--yellow);font-weight:700}
    .cta{justify-self:end}
    .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid var(--border);background:var(--card);box-shadow:var(--shadow);font-weight:600}
    .btn--primary{background:var(--yellow);border-color:transparent}

    /* Nav */
    .nav{border-top:1px solid var(--border);border-bottom:1px solid var(--border);background:linear-gradient(0deg, rgba(255,189,57,.08), transparent)}
    .nav__menu{display:flex;flex-wrap:wrap;gap:6px;padding:10px 0}
    .nav__link{padding:8px 12px;border-radius:10px;opacity:.9}
    .nav__link:hover{background:var(--yellow);opacity:1}

    /* Hero */
    .hero{position:relative;isolation:isolate}
    .hero::before{content:"";position:absolute;inset:-20% -10% auto;z-index:-1;background:radial-gradient(60% 40% at 10% 0%, rgba(255,189,57,.25), transparent 60%), radial-gradient(60% 40% at 80% 0%, rgba(255,189,57,.13), transparent 60%)}
    .hero__inner{display:grid;grid-template-columns:1.2fr .8fr;gap:20px;padding:28px 0}
    .hero .feature{border-radius:var(--radius);overflow:hidden;background:var(--black);color:#fff;display:grid;grid-template-columns:1fr 1fr}
    .feature__content{padding:22px}
    .feature__kicker{display:inline-block;margin-bottom:6px;padding:4px 10px;border-radius:999px;background:rgba(255,189,57,.16);border:1px solid rgba(255,189,57,.35);font-size:12px;letter-spacing:.3px}
    .feature__title{margin:6px 0 10px;font-size:28px;line-height:1.25}
    .feature__meta{display:flex;gap:12px;opacity:.85;font-size:14px}
    .feature__thumb{object-fit:cover;height:100%}
    .hero .tips{display:grid;gap:12px}
    .tip{display:flex;gap:12px;align-items:center;background:var(--card);border:1px solid var(--border);border-radius:14px;padding:12px}
    .tip__badge{width:40px;height:40px;border-radius:12px;background:var(--yellow)}

    /* Main layout */
    .layout{display:grid;grid-template-columns:1.7fr .9fr;gap:28px;margin:28px 0}

    /* Cards */
    .grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
    .card{background:var(--card);border:1px solid var(--border);border-radius:16px;overflow:hidden;box-shadow:var(--shadow);display:flex;flex-direction:column}
    .card__thumb{aspect-ratio:16/9;object-fit:cover}
    .card__body{padding:16px}
    .card__kicker{font-size:12px;color:var(--muted)}
    .card__title{margin:6px 0 8px;font-size:18px;line-height:1.35}
    .card__meta{display:flex;gap:10px;color:var(--muted);font-size:14px}
    .card__tags{display:flex;flex-wrap:wrap;gap:6px;margin-top:8px}
    .tag{display:inline-flex;gap:6px;align-items:center;padding:4px 10px;border-radius:999px;border:1px dashed var(--border);font-size:12px}

    /* Sidebar */
    .sidebar{display:grid;gap:18px}
    .widget{background:var(--card);border:1px solid var(--border);border-radius:16px;box-shadow:var(--shadow)}
    .widget__head{display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border-bottom:1px solid var(--border)}
    .widget__title{font-size:16px;font-weight:700}
    .widget__body{padding:14px 16px}
    .list{display:grid;gap:12px}
    .list__item{display:grid;grid-template-columns:64px 1fr;gap:10px;align-items:center}
    .list__thumb{width:64px;height:48px;border-radius:10px;object-fit:cover}

    /* Callouts */
    .callout{border:1px solid var(--border);border-left:6px solid var(--yellow);background:linear-gradient(0deg, rgba(255,189,57,.07), transparent);padding:12px 14px;border-radius:12px}
    .callout strong{font-weight:800}

    /* Footer */
    .footer{margin-top:40px;border-top:1px solid var(--border);padding:18px 0;color:var(--muted)}

    /* Pagination */
    .pagination{display:flex;gap:8px;justify-content:center;margin:24px 0}
    .pagination a{padding:8px 12px;border-radius:10px;border:1px solid var(--border);background:var(--card)}
    .pagination a[aria-current="page"]{background:var(--yellow);border-color:transparent}

    /* Utilities */
    .sr{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}

    /* Responsive */
    @media (max-width: 1024px){
      .header__inner{grid-template-columns:1fr}
      .cta{justify-self:stretch}
      .hero__inner{grid-template-columns:1fr}
      .layout{grid-template-columns:1fr}
      .grid{grid-template-columns:repeat(2,1fr)}
    }
    @media (max-width: 640px){
      .grid{grid-template-columns:1fr}
      .nav__menu{overflow:auto}
    }
  </style>
</head>
<body>
  <!-- TOPBAR -->
  <div class="topbar">
    <div class="container topbar__inner">
      <div class="topbar__links">
        <a href="#">Giới thiệu</a>
        <a href="#">Liên hệ</a>
        <a href="#">Gửi câu hỏi</a>
      </div>
      <div>🎯 Mẹo nhanh mỗi ngày – tiết kiệm 5 phút sửa lỗi!</div>
    </div>
  </div>

  <!-- HEADER -->
  <header class="header">
    <div class="container header__inner">
      <a class="brand" href="#" aria-label="Trang chủ">
        <span class="brand__logo" aria-hidden="true"></span>
        <span class="brand__title">Blog Fix Lỗi</span>
      </a>
      <form class="search" role="search">
        <label class="sr" for="q">Tìm bài viết</label>
        <input id="q" name="q" placeholder="Tìm lỗi: Wi-Fi, màn hình xanh, Office…" />
        <button type="submit">Tìm</button>
      </form>
      <div class="cta">
        <a class="btn btn--primary" href="#">Đề xuất bài viết</a>
      </div>
    </div>
    <nav class="nav">
      <div class="container nav__menu" aria-label="Danh mục chính">
        <a class="nav__link" href="#">Windows</a>
        <a class="nav__link" href="#">Office</a>
        <a class="nav__link" href="#">Driver</a>
        <a class="nav__link" href="#">Mạng</a>
        <a class="nav__link" href="#">Phần cứng</a>
        <a class="nav__link" href="#">Phần mềm</a>
        <a class="nav__link" href="#">Backup</a>
        <a class="nav__link" href="#">Mẹo nhanh</a>
      </div>
    </nav>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="container hero__inner">
      <article class="feature">
        <img class="feature__thumb" src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=1200&auto=format&fit=crop" alt="Laptop và công cụ sửa lỗi"/>
        <div class="feature__content">
          <span class="feature__kicker">Hướng dẫn nổi bật</span>
          <h2 class="feature__title">Sửa lỗi Wi‑Fi chập chờn trên Windows 11 chỉ trong 3 phút</h2>
          <p class="feature__meta"><span>🕒 5 phút đọc</span> <span>•</span> <span>🔧 Windows</span></p>
          <div class="callout" style="margin-top:12px">
            <strong>Mẹo nhanh:</strong> Gõ <code>netsh winsock reset</code> rồi khởi động lại – giải quyết 80% lỗi kết nối.
          </div>
        </div>
      </article>
      <div class="tips">
        <div class="tip">
          <div class="tip__badge" aria-hidden="true"></div>
          <div>
            <div><strong>Fix nhanh:</strong> Mở được Task Manager khi máy treo – <kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>Esc</kbd>.</div>
          </div>
        </div>
        <div class="tip">
          <div class="tip__badge" aria-hidden="true"></div>
          <div>
            <div><strong>Sao lưu:</strong> Dùng <em>File History</em> để lưu thư mục quan trọng 1 lần/tuần.</div>
          </div>
        </div>
        <div class="tip">
          <div class="tip__badge" aria-hidden="true"></div>
          <div>
            <div><strong>Phím tắt:</strong> <kbd>Win</kbd> + <kbd>Shift</kbd> + <kbd>S</kbd> chụp nhanh màn hình.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <main class="container layout">
    <!-- POST GRID -->
    <section aria-labelledby="latest">
      <h2 id="latest">Bài mới nhất</h2>
      <div class="grid" style="margin-top:12px">
        <!-- Card 1 -->
        <article class="card">
          <img class="card__thumb" src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1200&auto=format&fit=crop" alt="Màn hình đen"/>
          <div class="card__body">
            <div class="card__kicker">Windows</div>
            <h3 class="card__title"><a href="#">Khắc phục màn hình đen sau khi cập nhật</a></h3>
            <div class="card__meta">🕒 4 phút • 👀 1.2k</div>
            <div class="card__tags">
              <span class="tag">#update</span><span class="tag">#display</span>
            </div>
          </div>
        </article>
        <!-- Card 2 -->
        <article class="card">
          <img class="card__thumb" src="https://images.unsplash.com/photo-1517519014922-8fc06f3cb3a3?q=80&w=1200&auto=format&fit=crop" alt="Bàn phím"/>
          <div class="card__body">
            <div class="card__kicker">Office</div>
            <h3 class="card__title"><a href="#">Excel không gõ được chữ có dấu – cách xử lý</a></h3>
            <div class="card__meta">🕒 3 phút • 👀 860</div>
            <div class="card__tags">
              <span class="tag">#unicodetcvn</span><span class="tag">#vietkey</span>
            </div>
          </div>
        </article>
        <!-- Card 3 -->
        <article class="card">
          <img class="card__thumb" src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=1200&auto=format&fit=crop" alt="Mainboard"/>
          <div class="card__body">
            <div class="card__kicker">Driver</div>
            <h3 class="card__title"><a href="#">Thiếu driver sau khi cài Windows – cài sao cho đúng</a></h3>
            <div class="card__meta">🕒 6 phút • 👀 2.1k</div>
            <div class="card__tags">
              <span class="tag">#chiphset</span><span class="tag">#lan</span>
            </div>
          </div>
        </article>
        <!-- Card 4 -->
        <article class="card">
          <img class="card__thumb" src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1200&auto=format&fit=crop" alt="Router Wi-Fi"/>
          <div class="card__body">
            <div class="card__kicker">Mạng</div>
            <h3 class="card__title"><a href="#">Ping cao khi chơi game – tối ưu router trong 5 bước</a></h3>
            <div class="card__meta">🕒 5 phút • 👀 640</div>
            <div class="card__tags">
              <span class="tag">#latency</span><span class="tag">#qos</span>
            </div>
          </div>
        </article>
        <!-- Card 5 -->
        <article class="card">
          <img class="card__thumb" src="https://images.unsplash.com/photo-1556157382-97eda2d62296?q=80&w=1200&auto=format&fit=crop" alt="Ổ cứng"/>
          <div class="card__body">
            <div class="card__kicker">Backup</div>
            <h3 class="card__title"><a href="#">Cứu dữ liệu nhanh khi ổ cứng kêu lạch cạch</a></h3>
            <div class="card__meta">🕒 7 phút • 👀 530</div>
            <div class="card__tags">
              <span class="tag">#smart</span><span class="tag">#clone</span>
            </div>
          </div>
        </article>
        <!-- Card 6 -->
        <article class="card">
          <img class="card__thumb" src="https://images.unsplash.com/photo-1516387938699-a93567ec168e?q=80&w=1200&auto=format&fit=crop" alt="USB boot"/>
          <div class="card__body">
            <div class="card__kicker">Công cụ</div>
            <h3 class="card__title"><a href="#">Tạo USB boot cứu hộ: Ventoy hay Rufus?</a></h3>
            <div class="card__meta">🕒 5 phút • 👀 1.1k</div>
            <div class="card__tags">
              <span class="tag">#boot</span><span class="tag">#iso</span>
            </div>
          </div>
        </article>
      </div>
      <nav class="pagination" aria-label="Phân trang">
        <a href="#">« Mới hơn</a>
        <a href="#" aria-current="page">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">Cũ hơn »</a>
      </nav>
    </section>

    <!-- SIDEBAR -->
    <aside class="sidebar" aria-label="Thanh bên">
      <section class="widget">
        <div class="widget__head">
          <h3 class="widget__title">Danh mục</h3>
        </div>
        <div class="widget__body">
          <ul class="list" style="list-style:none;padding:0;margin:0">
            <li>Windows (38)</li>
            <li>Office (24)</li>
            <li>Driver (12)</li>
            <li>Mạng (17)</li>
            <li>Phần cứng (29)</li>
          </ul>
        </div>
      </section>

      <section class="widget">
        <div class="widget__head">
          <h3 class="widget__title">Bài phổ biến</h3>
        </div>
        <div class="widget__body list">
          <a class="list__item" href="#">
            <img class="list__thumb" src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=400&auto=format&fit=crop" alt="Cáp mạng"/>
            <div>
              <div><strong>Không vào được mạng LAN – kiểm tra trong 60s</strong></div>
              <div class="card__meta">👀 8.2k</div>
            </div>
          </a>
          <a class="list__item" href="#">
            <img class="list__thumb" src="https://images.unsplash.com/photo-1542751110-97427bbecf20?q=80&w=400&auto=format&fit=crop" alt="Laptop"/>
            <div>
              <div><strong>Máy chậm – tối ưu khởi động</strong></div>
              <div class="card__meta">👀 6.7k</div>
            </div>
          </a>
          <a class="list__item" href="#">
            <img class="list__thumb" src="https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?q=80&w=400&auto=format&fit=crop" alt="USB"/>
            <div>
              <div><strong>Tạo USB cài Win chuẩn UEFI</strong></div>
              <div class="card__meta">👀 5.4k</div>
            </div>
          </a>
        </div>
      </section>

      <section class="widget">
        <div class="widget__head">
          <h3 class="widget__title">Thẻ</h3>
        </div>
        <div class="widget__body" style="display:flex;flex-wrap:wrap;gap:8px">
          <a class="tag" href="#">#wifi</a>
          <a class="tag" href="#">#bsod</a>
          <a class="tag" href="#">#disk</a>
          <a class="tag" href="#">#office</a>
          <a class="tag" href="#">#driver</a>
          <a class="tag" href="#">#backup</a>
          <a class="tag" href="#">#ventoy</a>
        </div>
      </section>

      <section class="widget">
        <div class="widget__head">
          <h3 class="widget__title">Bản tin</h3>
        </div>
        <div class="widget__body">
          <p>Nhận mẹo fix lỗi hay mỗi tuần.</p>
          <form>
            <label class="sr" for="email">Email</label>
            <input id="email" type="email" placeholder="you@example.com" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:12px;background:var(--card);color:var(--ink)" />
            <button class="btn btn--primary" style="width:100%;margin-top:10px" type="submit">Đăng ký</button>
          </form>
        </div>
      </section>
    </aside>
  </main>

  <footer class="footer">
    <div class="container">© 2025 Blog Fix Lỗi • Chia sẻ kinh nghiệm – thiết kế vàng/đen tối giản</div>
  </footer>
</body>
</html>
