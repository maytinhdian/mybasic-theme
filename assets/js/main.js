console.log("Hello JS");

// jQuery(document).ready(function($){
//   $(".owl-carousel").owlCarousel({
//     loop: true,
//     margin: 10,
//     nav: true,
//     dots: true,
//     autoplay: true,
//     autoplayTimeout: 3000,
//     items: 1
//   });
// });

document.addEventListener("DOMContentLoaded", function () {
  const swiper = new Swiper(".mySwiper", {
    speed: 1000, // Thời gian chuyển slide (ms) -> càng cao càng mượt
    effect: "fade", // Có thể đổi sang 'slide', 'cube', 'coverflow', 'flip'
    grabCursor: true, // Con trỏ dạng bàn tay khi rê
    loop: true, // vòng lặp vô hạn
    spaceBetween: 20, // khoảng cách giữa các slide
    slidesPerView: 1, // số slide hiển thị
    autoplay: {
      delay: 3000, // delay 3s
      disableOnInteraction: false, // tiếp tục chạy sau khi người dùng tương tác
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    // breakpoints: {
    //   0:     { slidesPerView: 1 },
    //   640:   { slidesPerView: 2 },
    //   768:   { slidesPerView: 3 },
    //   1024:  { slidesPerView: 4 }
    // }
  });
});

(function () {
  function closeAll(except) {
    document
      .querySelectorAll("[data-user-menu].is-active")
      .forEach(function (el) {
        if (el !== except) {
          el.classList.remove("is-active");
          const btn = el.querySelector(".user-menu__toggle");
          if (btn) btn.setAttribute("aria-expanded", "false");
        }
      });
  }

  document.addEventListener("click", function (e) {
    const root = e.target.closest("[data-user-menu]");
    const toggle = e.target.closest(".user-menu__toggle");

    if (toggle && root) {
      const willOpen = !root.classList.contains("is-active");
      closeAll(root);
      root.classList.toggle("is-active");
      toggle.setAttribute("aria-expanded", willOpen ? "true" : "false");
      return;
    }

    // Click ra ngoài -> đóng
    if (!root) closeAll();
  });

  // ESC để đóng
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") closeAll();
  });
})();

// Đổi tên của nút add to cart thành view cart sau khi bấm thêm sản phẩm vào giỏ hàng
jQuery(function ($) {
  $(document.body).on(
    "added_to_cart",
    function (_, fragments, cart_hash, $button) {
      let btn = $button.closest(".product-card__actions").find(".button");

      btn
        .removeClass("added") // bỏ class để Woo không gắn icon tick
        .html(
          '<i class="fas fa-shopping-cart" style="margin-right:6px;"></i>VIEW CART'
        )
        .attr("href", wc_add_to_cart_params.cart_url);
    }
  );
});

//Tabs js
// Horizontal & Vertical
document.addEventListener("click", function (e) {
  const link = e.target.closest(".tmt-tabs__nav a");
  if (!link) return;

  const root = link.closest("[data-tmt-tabs]");
  if (!root) return;
  e.preventDefault();

  const id = link.getAttribute("href");

  // nav active
  root
    .querySelectorAll(".tmt-tabs__nav li")
    .forEach((li) => li.classList.remove("active"));
  link.parentElement.classList.add("active");

  // panes active
  root
    .querySelectorAll(".tab-pane")
    .forEach((p) => p.classList.remove("active"));
  const target = root.querySelector(id);
  if (target) target.classList.add("active");

  // ARIA
  root
    .querySelectorAll(".tmt-tabs__nav a[aria-selected]")
    .forEach((a) => a.setAttribute("aria-selected", "false"));
  link.setAttribute("aria-selected", "true");
});

// Accordion (một item mở tại 1 thời điểm)
document.addEventListener("click", function (e) {
  const btn = e.target.closest(".tmt-accordion__header");
  if (!btn) return;

  const item = btn.closest(".tmt-accordion__item");
  const wrap = btn.closest(".tmt-tabs--accordion");
  if (!item || !wrap) return;

  wrap
    .querySelectorAll(".tmt-accordion__item")
    .forEach((i) => i.classList.remove("active"));
  item.classList.add("active");
});

//Cart js
(function ($) {
  $(document).on("click", ".qty-btn", function () {
    const $cell = $(this).closest("td");
    const $input = $cell.find(".qty-input");
    let v = parseInt($input.val() || 0, 10);
    if ($(this).hasClass("qty-btn--plus")) v++;
    if ($(this).hasClass("qty-btn--minus")) v = Math.max(0, v - 1);
    $input.val(v).trigger("change");
  });

  // Auto update khi đổi số lượng
  $(document).on("change", ".qty-input", function () {
    $('button[name="update_cart"]').prop("disabled", false).trigger("click");
  });
})(jQuery);

//Cart js new

(function ($) {
  "use strict";

  function attachQty($root) {
    // Tìm tất cả quantity input trong cart form
    $root.find(".woocommerce-cart-form .quantity").each(function () {
      var $q = $(this);
      if ($q.find(".tmt-qty-btn").length) return; // đã gắn nút rồi

      var $input = $q.find("input.qty");
      if (!$input.length) return;

      // Thêm nút -
      $(
        '<button type="button" class="tmt-qty-btn tmt-qty-minus" aria-label="Giảm">−</button>'
      ).insertBefore($input);

      // Thêm nút +
      $(
        '<button type="button" class="tmt-qty-btn tmt-qty-plus" aria-label="Tăng">+</button>'
      ).insertAfter($input);
    });
  }

  function changeQty($input, delta) {
    var step = parseFloat($input.attr("step")) || 1;
    var min = parseFloat($input.attr("min"));
    if (isNaN(min)) min = 1;
    var max = parseFloat($input.attr("max"));
    var val = parseFloat($input.val()) || min;

    val = val + delta * step;
    if (!isNaN(max)) val = Math.min(val, max);
    val = Math.max(val, min);

    $input.val(val).trigger("change");
  }

  function bindEvents($root) {
    // Click +/-
    $root.on("click", ".tmt-qty-minus", function () {
      changeQty($(this).siblings("input.qty"), -1);
    });
    $root.on("click", ".tmt-qty-plus", function () {
      changeQty($(this).siblings("input.qty"), +1);
    });
  }

  function boot() {
    var $doc = $(document);
    attachQty($doc);
    bindEvents($doc);

    // WooCommerce có các sự kiện khi cart được cập nhật bằng AJAX
    $doc.on(
      "updated_wc_div updated_cart_totals wc_fragments_refreshed",
      function () {
        attachQty($doc);
      }
    );
  }

  $(boot);
})(jQuery);

//Archive product
(function () {
  document.addEventListener("change", function (e) {
    const field = e.target;
    const form = field.closest("form.tmt-filterbar");
    if (!form) return;

    if (
      field.tagName === "SELECT" ||
      (field.tagName === "INPUT" && field.type === "checkbox")
    ) {
      form.requestSubmit(); // auto submit
    }
  });
})();
