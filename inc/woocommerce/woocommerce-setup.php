<?php

// Woocommerce
defined('ABSPATH') || exit;

require_once 'product-card.php';
TMT\Theme\WC_Product_Card::boot();

// Boot class bố trí hook cho single product
require_once 'single-product.php';
\TMT\Theme\Woo\Single_Product::boot();


// Single Product Images 
// require_once __DIR__ . '/inc/woocommerce/single-product-images.php';
// add_action('after_setup_theme', function () {
//     \TMT\Theme\Woo\Single_Product_Images::boot();
// });

add_action('after_setup_theme', function () {
    // Bật zoom ảnh
    add_theme_support('wc-product-gallery-zoom');

    // Bật lightbox (PhotoSwipe)
    add_theme_support('wc-product-gallery-lightbox');

    // Bật slider thumbnail (FlexSlider)
    add_theme_support('wc-product-gallery-slider');
});


//Tabs single product

add_filter('woocommerce_product_tabs', function($tabs){
    // unset($tabs['additional_information']);
    // $tabs['video'] = ['title'=>'Video', 'priority'=>50, 'callback'=>function(){ echo '...'; }];
    return $tabs;
});

add_filter('tmt_tabs_layout', function(){ 
    return 'horizontal';   // 'horizontal' | 'accordion' | 'vertical'
});
