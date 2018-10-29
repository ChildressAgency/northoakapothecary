<?php 

/**
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

get_header(); ?>

<div class="container">
	<hr />

	<?php 
	
	$pageID = get_the_ID();
	$product = get_product( $pageID );
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $pageID ), 'single-post-thumbnail' );
	$name = $product->name;
	$tag = get_the_terms( $query->post->ID, 'product_tag' );
	$tag = $tag[0]->name;
	$rating = $product->get_average_rating();
	$reviewCount = $product->review_count;
	$description = $product->description;
	$price = $product->price;

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
		}
	}
	
	?>
	
	<div class="product">
		<div class="product__images">
			<img class="product__featured-image" src="<?php echo $image[0]; ?>" />
			<div class="product__gallery">
				<?php 
				$imageIDs = $product->get_gallery_attachment_ids();

				echo wp_get_attachment_image( $product->image_id, 'thumbnail' );

				foreach( $imageIDs as $image ){
					echo wp_get_attachment_image( $image, 'thumbnail' );
				}
				?>
			</div>
		</div>
		<div class="product__info">
			<div class="product__meta">
				<h2 class="product__name"><?php echo $name; ?><?php if( $tag ): ?><span class="product__tag"> - <?php echo $tag; ?></span><?php endif; ?></h2>
				<p class="product__rating"><?php if( $reviewCount > 0 ) echo $stars . '<span class="product__review-count">' . $reviewCount . ' Reviews</span>'; else echo '<a href="' . $slug . '">Leave a Review</a>'; ?></p>
				<!-- <p class="product__price">$<?php echo $price; ?></p> -->
				<?php if( $is_wholesale ): ?>
					<p class="product__price"><span class="product__price--strikethrough">$<?php echo $price; ?></span> $<?php echo $wholesale_price; ?></p>
				<?php else: ?>
					<p class="product__price">$<?php echo $price; ?></p>
				<?php endif; ?>
				<p class="product__description"><?php echo wpautop( $description ); ?></p>
			</div>
			<div class="product__shop-functions">
				<?php $add_to_cart_url = esc_url( $product->add_to_cart_url() ); ?>
				<p><strong>Quantity</strong></p>
				<div class="product__add-to-cart">
					<input id="product-quantity" class="product__quantity" type="number" value="1" />
					<a id="add-to-cart-btn" class="btn btn-primary" href="<?php echo $add_to_cart_url; ?>" >ADD TO CART</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>