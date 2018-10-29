<?php 

/**
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

get_header(); ?>

<div class="section">
    <div class="container">
        <?php $cat = htmlspecialchars( $_GET['cat'] ); ?>
        <?php $pageID = woocommerce_get_page_id( 'shop' ); ?>
        <?php if( get_field( 'section_heading', $pageID ) ): ?>
            <?php if( $cat ): ?>
                <h2 class="section__heading"><?php echo strtoupper( $cat ); ?></h2>
            <?php else: ?>
                <h2 class="section__heading"><?php the_field( 'section_heading', $pageID ); ?></h2>
            <?php endif; ?>
        <?php endif; ?>
        <div class="products">

            <?php

            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $postsPerPage = get_field( 'products_per_page' );
            if( !$postsPerPage )
                $postsPerPage = 9;

            if( $cat ) {

                $tax_query[] = array(
                    'taxonomy'  => 'product_cat',
                    'field'     => 'slug',
                    'terms'     => $cat,
                    'operator'  => 'IN'
                );

                $args = array(
                    'post_type'         => 'product',
                    'post_status'       => 'publish',
                    'orderby'			=> 'name',
                    'order'				=> 'ASC',
                    'posts_per_page'    => $postsPerPage,
                    'paged'             => $paged,
                    'tax_query'         => $tax_query
                );
            } else {
                $args = array(
                    'post_type'         => 'product',
                    'post_status'       => 'publish',
                    'orderby'			=> 'name',
                    'order'				=> 'ASC',
                    'posts_per_page'    => $postsPerPage,
                    'paged'             => $paged,
                );
            }

            $query = new WP_Query( $args );

            if( $query->have_posts() ):
                while( $query->have_posts() ):
                    $query->the_post();

                    $product = get_product( $query->post->ID );
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $query->post->ID ), 'single-post-thumbnail' );
                    $tags = get_the_terms( $query->post->ID, 'product_tag' );
                    $rating = $product->get_average_rating();
                    $reviewCount = $product->review_count;
                    $slug = $product->slug;

                    $metadata = $product->get_meta_data();

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

                    $price = $product->price;

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
                        <p class="products__description"><?php echo $product->description; ?></p>
                    </div>

                <?php endwhile; ?>
            <?php endif; ?>

        </div>

        <?php if( $cat ): ?>
            <button class="btn btn-primary btn-center" onclick="window.location = window.location.href.split('?')[0];" >Shop All</button>
        <?php endif; ?>

        <div class="pagination">
            <?php 
                echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $query->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'plain',
                    'end_size'     => 1,
                    'mid_size'     => 2,
                    'prev_next'    => true,
                    'prev_text' => __( '<', 'textdomain' ),
                    'next_text' => __( '>', 'textdomain' ),
                    'add_args'     => false,
                    'add_fragment' => '',
                ) );
            ?>
        </div>

        <?php wp_reset_query(); ?>
    </div>
</div>

<?php get_footer(); ?>