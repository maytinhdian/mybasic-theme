<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TechFix & Tips – Blog Demo</title>
  <meta name="description" content="Blog chia sẻ mẹo, hướng dẫn sử dụng và sửa lỗi thiết bị máy tính, camera, mạng, máy chủ." />
  <style>
    /* === Design tokens (compiled from SCSS variables) === */
    :root {
      --color-primary: #ffbd39;  /* rgb(255,189,57) */
      --color-primary-600: #f5a900;
      --color-bg: #0d0d0d;
      --color-surface: #121212;
      --color-text: #e9e9e9;
      --color-text-muted: #bdbdbd;
      --color-border: #2a2a2a;
      --radius: 14px;
      --shadow: 0 8px 24px rgb(0 0 0 / 0.1), 0 1px 0 rgb(0 0 0 / 0.06);
      --container: 1200px;
    }

    * { box-sizing: border-box; }
    html, body { height: 100%; }
    body {
      margin: 0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, Noto Sans, "Helvetica Neue", "Apple Color Emoji", "Segoe UI Emoji";
      color: var(--color-text);
      background:
        radial-gradient(60% 60% at 20% 0%, rgba(255,189,57,0.12), transparent 60%),
        radial-gradient(60% 60% at 80% 0%, rgba(255,189,57,0.06), transparent 60%),
        linear-gradient(180deg, #0b0b0b, #111 120px);
      background-color: var(--color-bg);
      line-height: 1.6;
    }

    a { color: var(--color-primary); text-decoration: none; }
    a:hover { text-decoration: underline; }

    /* === Layout === */
    .container { max-width: var(--container); margin-inline: auto; padding: 0 16px; }
    .grid { display: grid; gap: 24px; }
    .grid--main { grid-template-columns: 1fr; }
    @media (min-width: 992px) { .grid--main { grid-template-columns: 1.6fr 0.8fr; } }

    /* === Header (BEM) === */
    .site-header { position: sticky; top: 0; z-index: 50; backdrop-filter: blur(6px); background: rgba(13,13,13,0.6); border-bottom: 1px solid var(--color-border); }
    .site-header__bar { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 12px 0; }
    .site-header__brand { display: flex; align-items: center; gap: 10px; font-weight: 800; letter-spacing: .3px; }
    .site-header__logo { width: 28px; height: 28px; border-radius: 50%; background: var(--color-primary); box-shadow: inset 0 0 0 2px #000; }
    .site-header__nav { display: flex; align-items: center; gap: 14px; }
    .site-header__nav a { padding: 8px 10px; border-radius: 10px; display: inline-flex; align-items: center; gap: 8px; }
    .site-header__nav a[aria-current="page"], .site-header__nav a:hover { background: #1a1a1a; text-decoration: none; }

    /* === Hero === */
    .blog-hero { padding: 40px 0 24px; }
    .blog-hero__wrap { display: grid; grid-template-columns: 1fr; gap: 16px; align-items: center; }
    .blog-hero__title { font-size: clamp(24px, 4vw, 42px); line-height: 1.15; margin: 0; }
    .blog-hero__desc { color: var(--color-text-muted); margin: 6px 0 0; }

    /* === Search bar === */
    .search { display: grid; grid-template-columns: 1fr auto auto; gap: 8px; padding: 12px; background: #131313; border: 1px solid var(--color-border); border-radius: var(--radius); box-shadow: var(--shadow); }
    .search__input { padding: 12px 14px; border-radius: 10px; border: 1px solid var(--color-border); background: #0f0f0f; color: var(--color-text); }
    .search__select { padding: 12px; border-radius: 10px; border: 1px solid var(--color-border); background: #0f0f0f; color: var(--color-text); }
    .search__btn { border: 0; padding: 12px 16px; border-radius: 10px; font-weight: 700; cursor: pointer; background: var(--color-primary); color: #111; }
    .search__btn:hover { background: var(--color-primary-600); }

    /* === Categories pills === */
    .cat-pills { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 14px; }
    .cat-pills__item { display: inline-flex; align-items: center; gap: 8px; padding: 8px 12px; border: 1px dashed var(--color-border); border-radius: 999px; background: rgba(255,189,57,0.06); }
    .cat-pills__icon { width: 8px; height: 8px; border-radius: 50%; background: var(--color-primary); box-shadow: 0 0 0 2px rgba(255,189,57,0.2); }

    /* === Content area === */
    .content { margin-top: 20px; }

    /* Post list */
    .post-list { display: grid; grid-template-columns: 1fr; gap: 18px; }
    @media (min-width: 700px) { .post-list { grid-template-columns: repeat(2, 1fr); } }

    .post-card { position: relative; display: grid; grid-template-rows: 150px auto; border: 1px solid var(--color-border); border-radius: var(--radius); overflow: hidden; background: var(--color-surface); box-shadow: var(--shadow); isolation: isolate; }
    .post-card__media { background: linear-gradient(135deg, rgba(255,189,57,0.18), rgba(255,189,57,0.04)), url('https://picsum.photos/800/400?random=1') center/cover no-repeat; }
    .post-card__body { padding: 14px; display: grid; gap: 10px; }
    .post-card__meta { display: flex; gap: 8px; font-size: 12px; color: var(--color-text-muted); }
    .post-card__title { font-size: 18px; margin: 0; }
    .post-card__title a { text-decoration: none; }
    .post-card__excerpt { color: var(--color-text-muted); margin: 0; }
    .post-card__footer { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--color-border); padding-top: 10px; }
    .post-card__tag { font-size: 12px; color: #111; background: var(--color-primary); border-radius: 6px; padding: 4px 8px; font-weight: 700; }
    .post-card__read { font-weight: 700; }

    /* Sidebar */
    .sidebar { display: grid; gap: 18px; }
    .widget { border: 1px solid var(--color-border); border-radius: var(--radius); background: #121212; box-shadow: var(--shadow); }
    .widget__head { padding: 12px 14px; border-bottom: 1px solid var(--color-border); display: flex; align-items: center; justify-content: space-between; }
    .widget__title { margin: 0; font-size: 14px; letter-spacing: .3px; text-transform: uppercase; color: var(--color-text-muted); }
    .widget__body { padding: 12px 14px; display: grid; gap: 10px; }

    .widget-tags { display: flex; flex-wrap: wrap; gap: 8px; }
    .tag { display: inline-block; padding: 6px 10px; border: 1px solid var(--color-border); border-radius: 999px; background: #0f0f0f; font-size: 13px; }

    .mini-post { display: grid; grid-template-columns: 64px 1fr; gap: 10px; align-items: center; }
    .mini-post__thumb { width: 64px; height: 48px; border-radius: 10px; background: linear-gradient(135deg, rgba(255,189,57,0.2), rgba(255,189,57,0.05)); }
    .mini-post__title { font-size: 14px; margin: 0; }

    /* Q&A quick ask */
    .qa { margin-top: 8px; border: 1px dashed var(--color-border); border-radius: var(--radius); padding: 14px; background: rgba(255,189,57,0.05); }
    .qa__title { margin: 0 0 6px; font-size: 16px; }
    .qa__form { display: grid; grid-template-columns: 1fr auto; gap: 10px; }
    .qa__input { padding: 10px 12px; border-radius: 8px; border: 1px solid var(--color-border); background: #0f0f0f; color: var(--color-text); }
    .qa__btn { border: 0; padding: 10px 14px; border-radius: 8px; background: var(--color-primary); color: #111; font-weight: 700; cursor: pointer; }

    /* Footer CTA */
    .cta { margin: 32px 0; border: 1px solid var(--color-border); border-radius: var(--radius); background: linear-gradient(180deg, rgba(255,189,57,0.1), rgba(255,189,57,0.02)); overflow: hidden; }
    .cta__inner { padding: 18px; display: grid; gap: 10px; align-items: center; text-align: center; }
    .cta__title { margin: 0; font-size: clamp(18px, 3vw, 28px); }
    .cta__desc { margin: 0; color: var(--color-text-muted); }
    .cta__actions { display: flex; justify-content: center; gap: 12px; margin-top: 8px; }
    .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 14px; border-radius: 10px; border: 1px solid var(--color-border); background: #0f0f0f; color: var(--color-text); font-weight: 700; text-decoration: none; }
    .btn--primary { background: var(--color-primary); color: #111; border-color: transparent; }

    /* Utilities */
    .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
  </style>
</head>
<body>
  <header class="site-header">
    <div class="container site-header__bar">
      <div class="site-header__brand">
        <span class="site-header__logo" aria-hidden="true"></span>
        <a href="#" aria-current="page">TechFix & Tips</a>
      </div>
      <nav class="site-header__nav" aria-label="Chính">
        <a href="#" aria-current="page">Trang chủ</a>
        <a href="#tips">Thủ thuật</a>
        <a href="#howto">Hướng dẫn</a>
        <a href="#fix">Sửa lỗi</a>
        <a href="#contact">Liên hệ</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <!-- Hero -->
    <section class="blog-hero">
      <div class="blog-hero__wrap">
        <div>
          <h1 class="blog-hero__title">Chia sẻ mẹo, hướng dẫn, và cách sửa lỗi – rõ ràng, từng bước.</h1>
          <p class="blog-hero__desc">Tối ưu cho người mới, đủ sâu cho kỹ thuật: máy tính, camera, mạng, và máy chủ.</p>
        </div>
      </div>

      <!-- Search & Category pills -->
      <form class="search" role="search" aria-label="Tìm bài viết">
        <label class="sr-only" for="q">Tìm kiếm</label>
        <input class="search__input" id="q" name="q" placeholder="Nhập từ khóa lỗi hoặc thiết bị (vd: \"máy tính không vào mạng\")" />
        <select class="search__select" aria-label="Danh mục">
          <option>Danh mục</option>
          <option>Thủ thuật</option>
          <option>Hướng dẫn</option>
          <option>Sửa lỗi</option>
          <option>Bảo trì & Tối ưu</option>
        </select>
        <button class="search__btn" type="submit">Tìm</button>
      </form>

      <div class="cat-pills" aria-label="Danh mục nổi bật">
        <a class="cat-pills__item" href="#fix"><span class="cat-pills__icon"></span> Sửa lỗi Windows</a>
        <a class="cat-pills__item" href="#howto"><span class="cat-pills__icon"></span> Cấu hình Router</a>
        <a class="cat-pills__item" href="#tips"><span class="cat-pills__icon"></span> Tăng tốc máy tính</a>
        <a class="cat-pills__item" href="#camera"><span class="cat-pills__icon"></span> Camera an ninh</a>
        <a class="cat-pills__item" href="#server"><span class="cat-pills__icon"></span> Máy chủ & ảo hóa</a>
      </div>
    </section>

    <!-- Content -->
    <section class="content grid grid--main">
      <!-- Main posts -->
      <div>
        <div class="post-list">
          <!-- Post card 1 -->
          <article class="post-card">
            <div class="post-card__media" role="img" aria-label="Minh họa bài viết"></div>
            <div class="post-card__body">
              <div class="post-card__meta"><span>Hướng dẫn</span> • <time datetime="2025-08-10">10/08/2025</time> • 5 phút đọc</div>
              <h2 class="post-card__title"><a href="#">Cách khắc phục máy tính không vào mạng trong 3 bước</a></h2>
              <p class="post-card__excerpt">Kiểm tra dây mạng/Wi‑Fi, đặt lại TCP/IP, và xóa cache DNS. Có video minh họa.</p>
              <div class="post-card__footer">
                <span class="post-card__tag">Sửa lỗi</span>
                <a class="post-card__read" href="#">Đọc tiếp →</a>
              </div>
            </div>
          </article>
          <!-- Post card 2 -->
          <article class="post-card">
            <div class="post-card__media" style="background-image:linear-gradient(135deg, rgba(255,189,57,0.18), rgba(255,189,57,0.04)), url('https://picsum.photos/800/401?random=2');"></div>
            <div class="post-card__body">
              <div class="post-card__meta"><span>Thủ thuật</span> • <time datetime="2025-08-05">05/08/2025</time> • 4 phút đọc</div>
              <h2 class="post-card__title"><a href="#">5 cách tăng tốc Windows 11 an toàn</a></h2>
              <p class="post-card__excerpt">Tắt bloatware, tối ưu startup, dọn rác, kiểm tra ổ đĩa, bật Storage Sense.</p>
              <div class="post-card__footer">
                <span class="post-card__tag">Tips</span>
                <a class="post-card__read" href="#">Đọc tiếp →</a>
              </div>
            </div>
          </article>
          <!-- Post card 3 -->
          <article class="post-card">
            <div class="post-card__media" style="background-image:linear-gradient(135deg, rgba(255,189,57,0.18), rgba(255,189,57,0.04)), url('https://picsum.photos/800/402?random=3');"></div>
            <div class="post-card__body">
              <div class="post-card__meta"><span>Camera</span> • <time datetime="2025-07-30">30/07/2025</time> • 6 phút đọc</div>
              <h2 class="post-card__title"><a href="#">Camera không xem từ xa: NAT/P2P và 4 lỗi thường gặp</a></h2>
              <p class="post-card__excerpt">Kiểm tra IP, cổng, DDNS/Cloud P2P, và cấu hình modem. Bảng checklist kèm hình.</p>
              <div class="post-card__footer">
                <span class="post-card__tag">Camera</span>
                <a class="post-card__read" href="#">Đọc tiếp →</a>
              </div>
            </div>
          </article>
          <!-- Post card 4 -->
          <article class="post-card">
            <div class="post-card__media" style="background-image:linear-gradient(135deg, rgba(255,189,57,0.18), rgba(255,189,57,0.04)), url('https://picsum.photos/800/403?random=4');"></div>
            <div class="post-card__body">
              <div class="post-card__meta"><span>Máy chủ</span> • <time datetime="2025-07-20">20/07/2025</time> • 7 phút đọc</div>
              <h2 class="post-card__title"><a href="#">RAID 1, 5, 10 khác nhau thế nào? Chọn cấu hình cho NAS</a></h2>
              <p class="post-card__excerpt">So sánh dung lượng hữu dụng, độ an toàn, hiệu năng và chi phí.</p>
              <div class="post-card__footer">
                <span class="post-card__tag">Server</span>
                <a class="post-card__read" href="#">Đọc tiếp →</a>
              </div>
            </div>
          </article>
        </div>

        <!-- Q&A quick ask -->
        <div class="qa" aria-labelledby="qa-title">
          <h3 id="qa-title" class="qa__title">Hỏi nhanh – tụi mình sẽ trả lời sớm</h3>
          <form class="qa__form">
            <input class="qa__input" placeholder="Mô tả lỗi của bạn (vd: \"Máy tính khởi động rất chậm\")" />
            <button class="qa__btn" type="submit">Gửi</button>
          </form>
        </div>
      </div>

      <!-- Sidebar -->
      <aside class="sidebar" aria-label="Thanh bên">
        <section class="widget">
          <div class="widget__head"><h3 class="widget__title">Bài viết mới</h3></div>
          <div class="widget__body">
            <article class="mini-post">
              <div class="mini-post__thumb" aria-hidden="true"></div>
              <a class="mini-post__title" href="#">Khắc phục lỗi Unidentified Network</a>
            </article>
            <article class="mini-post">
              <div class="mini-post__thumb" aria-hidden="true"></div>
              <a class="mini-post__title" href="#">Cài đặt VLAN cơ bản cho switch</a>
            </article>
            <article class="mini-post">
              <div class="mini-post__thumb" aria-hidden="true"></div>
              <a class="mini-post__title" href="#">Chọn ổ SSD phù hợp cho server</a>
            </article>
          </div>
        </section>

        <section class="widget">
          <div class="widget__head"><h3 class="widget__title">Thẻ phổ biến</h3></div>
          <div class="widget__body widget-tags">
            <a class="tag" href="#">Windows 11</a>
            <a class="tag" href="#">Router</a>
            <a class="tag" href="#">DNS</a>
            <a class="tag" href="#">NAS</a>
            <a class="tag" href="#">Firewall</a>
            <a class="tag" href="#">Camera IP</a>
          </div>
        </section>

        <section class="widget">
          <div class="widget__head"><h3 class="widget__title">Tư vấn dịch vụ</h3></div>
          <div class="widget__body">
            <p class="widget__text">Cần cài đặt mạng, camera, máy chủ? Nhấn để được tư vấn.</p>
            <a class="btn btn--primary" href="#contact">Liên hệ ngay</a>
          </div>
        </section>
      </aside>
    </section>

    <!-- Footer CTA -->
    <section class="cta" aria-labelledby="cta-title">
      <div class="cta__inner">
        <h2 id="cta-title" class="cta__title">Cần hỗ trợ trực tiếp?</h2>
        <p class="cta__desc">Đặt lịch kiểm tra hệ thống tại chỗ hoặc hỗ trợ từ xa.</p>
        <div class="cta__actions">
          <a class="btn btn--primary" href="#">Đặt lịch</a>
          <a class="btn" href="#">Gọi ngay</a>
        </div>
      </div>
    </section>
  </main>

  <footer class="container" style="padding: 24px 0; color: var(--color-text-muted); border-top: 1px solid var(--color-border);">
    © 2025 Công ty TNHH Giải Pháp Sáng Tạo TMT Việt Nam – Blog TechFix & Tips
  </footer>
</body>
</html>
