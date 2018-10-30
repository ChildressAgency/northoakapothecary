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
				<?php if( get_field( 'twitter', 'option' ) ): ?><a class="product__social-link" href="<?php the_field( 'twitter', 'option' ); ?>"><i class="fab fa-twitter-square"></i></a><?php endif; ?>
				<?php if( get_field( 'facebook', 'option' ) ): ?><a class="product__social-link" href="<?php the_field( 'facebook', 'option' ); ?>"><i class="fab fa-facebook-square"></i></a><?php endif; ?>
				<?php if( get_field( 'pinterest', 'option' ) ): ?><a class="product__social-link" href="<?php the_field( 'pinterest', 'option' ); ?>"><i class="fab fa-pinterest-square"></i></a><?php endif; ?>
				<?php if( get_field( 'instagram', 'option' ) ): ?><a class="product__social-link" href="<?php the_field( 'instagram', 'option' ); ?>"><i class="fab fa-instagram"></i></a><?php endif; ?>
				<?php if( get_field( 'linkedin', 'option' ) ): ?><a class="product__social-link" href="<?php the_field( 'linkedin', 'option' ); ?>"><i class="fab fa-linkedin"></i></a><?php endif; ?>
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

			<div id="review_form_wrapper">
				<div id="review_form">
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
</div>

<?php get_footer(); ?>