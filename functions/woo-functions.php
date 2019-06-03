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