<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $cross_sells ) : ?>

	<div class="cross-sells">

		<h2><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></h2>

		<div class="products products--cart">

			<?php 

			$cross_sells = array_slice( $cross_sells, 0, 3 );
			foreach ( $cross_sells as $product ) : ?>

				<?php

	 			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->id ), 'single-post-thumbnail' );
	 			$name = $product->name;
	 			$tag = get_the_terms( $query->post->ID, 'product_tag' );
	 			$tag = $tag[0]->name;
	 			$rating = $product->get_average_rating();
	 			$reviewCount = $product->review_count;
	 			$price = $product->price;
				$slug = $product->slug;
	 	
	 			$stars = '';
	 			$remainingStars = $rating;
	 	
	 			for( $remainingStars; floor( $remainingStars ) > 0; $remainingStars-- ){
	 			    $stars .= '<i class="fas fa-star"></i>';
	 			}
	 	
	 			if( $remainingStars >= .5 ){
	 			    $stars .= '<i class="fas fa-star-half-alt"></i>';
	 			    $rating = ceil( $rating );
	 			}
	 	
	 			if( $rating < 5 ){
	 			    for( $rating; $rating < 5; $rating++ ){
	 			        $stars .= '<i class="far fa-star"></i>';
	 			    }
	 			}
	 	
	 			$wholesale_price = get_post_meta( $product->id, 'wholesale_customer_wholesale_price' )[0];
	 			$is_wholesale = false;
	 			if( is_user_logged_in() ){
	 				$user_meta = get_userdata( get_current_user_id() );
	 				$user_roles = $user_meta->roles;
	 	
	 				if( in_array( 'wholesale_customer', $user_roles ) ){
	 					$is_wholesale = true;
	 					$price = $wholesale_price;
	 				}
	 			}

				?>
					<div class="products__product">
					    <a href="<?php echo $slug; ?>"><img class="products__image" src="<?php echo $image[0]; ?>" /></a>
					    <div class="products__top">
					        <div class="products__title-review">
					            <p class="products__title"><a href="<?php echo $slug; ?>"><?php echo $product->name; ?><?php if( $tags ): ?><span class="products__tag"> - <?php echo $tags[0]->name; ?></span><?php endif; ?></a></p>
					            <p class="products__rating"><?php if( $reviewCount > 0 ) echo $stars; else echo '<a href="' . $slug . '">Leave a Review</a>'; ?></p>
					        </div>
					        <p class="products__price"><?php echo $price; ?></p>
					    </div>
					</div>
			<?php endforeach; ?>

		</div>

	</div>

<?php endif;

wp_reset_postdata();
