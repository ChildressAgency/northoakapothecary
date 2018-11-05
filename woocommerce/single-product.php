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
	$image_url = $image[0];
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
			<img class="product__featured-image" src="<?php echo $image_url; ?>" />
			<div class="product__gallery">
				<?php 
				$imageIDs = $product->get_gallery_attachment_ids();
	
				// display featured image
				echo wp_get_attachment_image( $product->image_id, 'full' );
	
				// display gallery images
				foreach( $imageIDs as $image ){
					echo wp_get_attachment_image( $image, 'full' );
				}
				?>
			</div>
		</div>
		<div class="product__info">
			<div class="product__meta">
				<h2 class="product__name"><?php echo $name; ?><?php if( $tag ): ?><span class="product__tag"> - <?php echo $tag; ?></span><?php endif; ?></h2>
				<p class="product__rating"><?php if( $reviewCount > 0 ) echo $stars . '<span class="product__review-count">' . $reviewCount . ' Reviews</span>'; else echo '<a href="' . $slug . '">Leave a Review</a>'; ?></p>
	
				<?php if( $is_wholesale ): ?>
					<p class="product__price"><span class="product__price--strikethrough">$<?php echo $price; ?></span> $<?php echo $wholesale_price; ?></p>
				<?php else: ?>
					<p class="product__price">$<?php echo $price; ?></p>
				<?php endif; ?>
				<div class="product__description"><?php echo wpautop( $description ); ?></div>
	
			</div>
			<div class="product__shop-functions">
				<?php $add_to_cart_url = esc_url( $product->add_to_cart_url() ); ?>
				<p><strong>Quantity</strong></p>
				<div class="product__add-to-cart">
					<input id="product-quantity" class="product__quantity" type="number" value="1" />
					<a id="add-to-cart-btn" class="btn btn-primary" data-cart-url="<?php echo $add_to_cart_url; ?>" href="#" >ADD TO CART</a>
				</div>
			</div>
			<div class="product__social">
				<?php $twitter = get_bloginfo( 'name' ) . ' - ' . rawurlencode( $name ) . ' ' . home_url( $product->slug ); ?>
				<a href="https://twitter.com/intent/tweet?text=<?php echo $twitter; ?>" class="product__social-link twitter-share-button"><i class="fab fa-twitter-square"></i></a>
				<a href="http://www.facebook.com/share.php?u=<?php echo home_url( $product->slug ); ?>" class="product__social-link"><i class="fab fa-facebook-square"></i></a>
				<a href="http://pinterest.com/pin/create/button/?url=<?php echo home_url( $product->slug ); ?>&media=<?php echo $image_url; ?><?php if( $product->short_description ): ?>&description=<?php echo $product->short_description; endif; ?>" class="product__social-link pin-it-button" count-layout="horizontal"><i class="fab fa-pinterest-square"></i></a>
			</div>
		</div>
	</div>

	<h2 class="comments-title">CUSTOMER REVIEWS</h2>
	
	<div id="reviews" class="woocommerce-Reviews">
		<div id="comments">
			<?php
				if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
					/* translators: 1: reviews count 2: product name */
					// printf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
					echo '<p>' . $stars . ' <span class="comments__based-on">based on ' . $count . ' reviews</span></p>';
				} else {
					_e( 'Reviews', 'woocommerce' );
				}
			?>
	
			<?php 
	
			global $query;
	
			$args = array(
				'post_type'	=> 'product',
				'post_id'	=> $product->id
			);
	
			$comments = get_comments( $args );
			$per_page = 5;
	
			if ( $comments ) : ?>
	
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments', 'per_page' => $per_page, 'walker' => new Comment_Walker() ) ), $comments ); ?>
	
				<?php if ( get_comment_pages_count( $comments, $per_page ) > 1 && get_option( 'page_comments' ) ) :
					echo '<nav class="woocommerce-pagination">';
					paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
						'prev_text' => '<',
						'next_text' => '>',
						'type'      => 'plain',
						'total'		=> get_comment_pages_count( $comments, $per_page ),
					) ) );
					echo '</nav>';
				endif; ?>
	
			<?php else : ?>
	
				<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
	
			<?php endif; ?>
		</div>
	
		<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
	
			<div class="comments__form">
					<?php
						$commenter = wp_get_current_commenter();
	
						$comment_form = array(
							'title_reply'          => $comments ? __( 'Add a review', 'woocommerce' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
							'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
							'title_reply_before'   => '<span id="reply-title" class="comment-reply-title">',
							'title_reply_after'    => '</span>',
							'comment_notes_after'  => '',
							'fields'               => array(
								'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label> ' .
											'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required /></p>',
								'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label> ' .
											'<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required /></p>',
							),
							'label_submit'  => __( 'Submit', 'woocommerce' ),
							'logged_in_as'  => '',
							'comment_field' => '',
						);
	
						if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
							$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'woocommerce' ), esc_url( $account_page_url ) ) . '</p>';
						}
	
						if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
							$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . '</label>
							<select name="rating" id="rating" required>
								<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
								<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
								<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
								<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
								<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
								<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
							</select></div>';
						}
	
						$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';
	
						comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
					?>
				</div>
			</div>
	
		<?php else : ?>
	
			<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
	
		<?php endif; ?>
	
		<div class="clear"></div>
	</div>

	<?php
	// maximum related products to display at once
	$max_related = 4;

	// get upsell products
	$upsells = $product->get_upsell_ids();;

	// get cross sell products
	$cross_sells = $product->get_cross_sell_ids();

	// get related products
	$related_products = wc_get_related_products( $product->id, $max_related );

	if( $upsells || $cross_sells || $related_products ): ?>

		<div class="container">
			<h2 class="related-title">YOU MAY ALSO LIKE</h2>
			
			<div class="related">
			
				<?php 
				// all related products
				$all_related = array();
				$meta_query = WC()->query->get_meta_query();
			
				if( $upsells ){
					// get upsells
					$args = array(
						'post_type'				=> 'product',
						'ignore_sticky_posts'	=> 1,
						'no_found_rows'			=> 1,
						'posts_per_page'		=> $max_related,
						'post__in'				=> $upsells,
						'meta_query'			=> $meta_query
					);
					$related_upsells = new WP_Query( $args );
			
					$max_related -= $related_upsells->post_count;
			
					// add upsells to list of related products
					if( $related_upsells->have_posts() ){
						while( $related_upsells->have_posts() ){
							$related_upsells->the_post();
							array_push( $all_related, get_the_ID() );
						}
					}
				}
			
				if( $cross_sells && $max_related > 0 ){
					// exclude duplicates
					foreach( $all_related as $id ){
						if( ( $key = array_search( $id, $cross_sells ) ) !== false ){
							unset( $cross_sells[$key] );
						}
					}
			
					// get cross sells
					$args = array(
						'post_type'				=> 'product',
						'ignore_sticky_posts'	=> 1,
						'no_found_rows'			=> 1,
						'posts_per_page'		=> $max_related,
						'post__in'				=> $cross_sells,
						'meta_query'			=> $meta_query
					);
					$related_cross_sells = new WP_Query( $args );
			
					$max_related -= $related_cross_sells->post_count;
			
					// add cross sells to list of related products
					if( $related_cross_sells->have_posts() ){
						while( $related_cross_sells->have_posts() ){
							$related_cross_sells->the_post();
							array_push( $all_related, get_the_ID() );
						}
					}
				}
			
				if( $related_products && $max_related > 0 ){
					// exclude duplicates
					foreach( $all_related as $id ){
						if( ( $key = array_search( $id, $related_products ) ) !== false ){
							unset( $related_products[$key] );
						}
					}
			
					// get related products
					$args = array(
						'post_type'				=> 'product',
						'ignore_sticky_posts'	=> 1,
						'no_found_rows'			=> 1,
						'posts_per_page'		=> $max_related,
						'post__in'				=> $related_products,
						'meta_query'			=> $meta_query
					);
					$related_products = new WP_Query( $args );
			
					$max_related -= $related_products->post_count;
			
					// add $related_products to list of related products
					if( $related_products->have_posts() ){
						while( $related_products->have_posts() ){
							$related_products->the_post();
							array_push( $all_related, get_the_ID() );
						}
					}
				}
			
				foreach( $all_related as $id ):
					$pageID = $id;
					$product = get_product( $pageID );
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $pageID ), 'single-post-thumbnail' );
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

	<?php endif; ?>
</div>

<?php get_footer(); ?>