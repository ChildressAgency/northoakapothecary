<?php

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_after_shop_loop_item_title', 'northoak_template_loop_product_title', 4);
function northoak_template_loop_product_title(){
  global $product;

  echo '<div class="products__top"><div class="products__title-review">';
  echo '<p class="products__title">' . get_the_title() . '</p>';
  echo '<p class="products__rating">';
  wc_get_template('loop/rating.php');
  echo '</p></div>';
  echo '<p class="products__price">' . $product->price . '</p></div>';
  echo '<p class="products__description">' . esc_html(get_the_excerpt()) . '</p>';
}

add_filter('woocommerce_get_price_html', 'northoak_format_price', 100, 2);
function northoak_format_price($price, $product){
  $price = str_replace('.00', '', $price);
  return $price;
}

remove_action('woocommerce_review_before', 'woocommerce_review_display_gravatar', 10);

add_action('woocommerce_before_checkout_form', 'northoak_before_checkout_form');
function northoak_before_checkout_form(){
  echo '<div class="container">';
}

add_action('woocommerce_after_checkout_form', 'northoak_after_checkout_form');
function northoak_after_checkout_form(){
  echo '</div>';
}

add_action('northoak_show_cart_link', 'northoak_cart_link');
function northoak_cart_link(){
  if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))){
    $count = WC()->cart->cart_contents_count;
    echo '<a href="' . WC()->cart->get_cart_url() . '" class="header-cart">Cart <i class="fas fa-shopping-cart"></i>(' . $count . ')</a>';
  }
}

add_filter('woocommerce_add_to_cart_fragments', 'northoak_update_header_cart_count');
function northoak_update_header_cart_count($fragments){
  ob_start();
  $count = WC()->cart->cart_contents_count;
  echo '<a href="' . WC()->cart->get_cart_url() . '" class="header-cart">Cart <i class="fas fa-shopping-cart"></i>(' . $count . ')</a>';

  $fragments['a.header-cart'] = ob_get_clean();

  return $fragments;
}

add_action('woocommerce_before_cart', 'northoak_before_cart');
function northoak_before_cart(){
  echo '<div class="container">';
}
add_action('woocommerce_after_cart', 'northoak_after_cart');
function northoak_after_cart(){
  echo '</div>';
}

add_action('after_setup_theme', 'northoak_product_gallery');
function northoak_product_gallery(){
  add_theme_support('wc-product-gallery-zoom');
  add_theme_support('wc-product-gallery-lightbox');
  add_theme_support('wc-product-gallery-slider');
}