<?php

namespace TMT\Theme\Woo;

if (!defined('ABSPATH')) exit;

class WC_Cart
{
  public static function boot()
  {
    add_action('wp', [__CLASS__, 'setup']);
    add_filter('body_class', function ($classes) {
      if (is_cart()) $classes[] = 'tmt-cart';
      return $classes;
    });
  }

  public static function setup()
  {
    if (!is_cart()) return;

    self::remove_defaults();
    self::add_layout_hooks();

    // Optional: Thêm +/- cho quantity (nếu chưa có)
    // add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_assets']);
  }

  protected static function remove_defaults()
  {
    // Đưa notices lên đầu
    remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);

    // Dời collaterals để tự gộp ở cột phải
    remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
    remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10);
  }

  protected static function add_layout_hooks()
  {

    add_action('woocommerce_before_cart', [__CLASS__, 'open_container'], 1);
    add_action('woocommerce_after_cart',  [__CLASS__, 'close_container'], 99);

    // Header + notices
    add_action('woocommerce_before_cart', [__CLASS__, 'header'], 5);
    add_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 6);

    // Grid 2 cột
    add_action('woocommerce_before_cart', [__CLASS__, 'open_grid'], 20);
    add_action('woocommerce_after_cart_table', [__CLASS__, 'close_left_open_right'], 5);
    add_action('woocommerce_after_cart', [__CLASS__, 'close_grid'], 90);

    // Right column (gộp 1 card, phân tách bằng gạch)
    add_action('tmt/cart/right', [__CLASS__, 'right_box'], 10);

    // Cross-sells (bên dưới grid)
    add_action('woocommerce_after_cart', [__CLASS__, 'cross_sells'], 95);
  }

  // ===== Layout wrappers =====
  public static function open_container()
  {
    echo '<section class="tmt-cart__section"><div class="tmt-container container">';
  }
  public static function close_container()
  {
    echo '</div></section>';
  }
  public static function header()
  {
    get_template_part('template-parts/woocommerce/cart/header');
  }
  public static function open_grid()
  {
    echo '<div class="tmt-cart__grid"><div class="tmt-cart__left">';
  }
  public static function close_left_open_right()
  {
    echo '</div><aside class="tmt-cart__right">';
    do_action('tmt/cart/right');
    echo '</aside>';
  }
  public static function close_grid()
  {
    echo '</div>';
  }

  // ===== Right column (single card) =====
  public static function right_box()
  {
    get_template_part('template-parts/woocommerce/cart/right/side-box');
  }

  public static function cross_sells()
  {
    get_template_part('template-parts/woocommerce/cart/cross-sells');
  }

  // ===== Assets (JS/CSS bổ sung) =====
  public static function enqueue_assets()
  {
    // JS nhỏ thêm +/- cho quantity (nếu theme bạn chưa có)
    wp_add_inline_script('jquery-core', "
      jQuery(function($){
        if (!$('body').hasClass('woocommerce-cart')) return;
        $('.woocommerce-cart-form .quantity').each(function(){
          var $q=$(this);
          if($q.find('.tmt-qty-btn').length) return;
          var $input=$q.find('input.qty');
          if(!$input.length) return;
          $('<button type=\"button\" class=\"tmt-qty-btn tmt-qty-minus\">−</button>').insertBefore($input);
          $('<button type=\"button\" class=\"tmt-qty-btn tmt-qty-plus\">+</button>').insertAfter($input);
        });
        $(document).on('click','.tmt-qty-minus',function(){
          var $in=$(this).siblings('input.qty'); var s=parseFloat($in.attr('step'))||1;
          var min=parseFloat($in.attr('min'))||1; var v=parseFloat($in.val())||1;
          v=Math.max(min, v - s); $in.val(v).trigger('change');
        });
        $(document).on('click','.tmt-qty-plus',function(){
          var $in=$(this).siblings('input.qty'); var s=parseFloat($in.attr('step'))||1;
          var max=parseFloat($in.attr('max')); var v=parseFloat($in.val())||1;
          v = (isNaN(max)? v + s : Math.min(max, v + s)); $in.val(v).trigger('change');
        });
      });
    ");
  }
}
