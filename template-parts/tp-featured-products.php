<?php

$overlay = get_sub_field_object( 'overlay' );
$overlay = $overlay['value']
?>

<div class="section <?php if( get_sub_field( 'inset' ) ) echo 'section--inset'; ?>">
    <?php if( $overlay != 'none' ): ?><div class="overlay overlay--<?php echo $overlay; ?>"></div><?php endif; ?>
    <div class="container">
        <?php if( get_sub_field( 'section_heading' ) ): ?><h2 class="section__heading"><?php the_sub_field( 'section_heading' ); ?></h2><?php endif; ?>
        <div class="">
          <?php echo do_shortcode('[featured_products per_page="3" columns="3"]'); ?>
            <?php
/*
            $meta_query = WC()->query->get_meta_query();
            $tax_query = WC()->query->get_tax_query();

            $tax_query[] = array(
                'taxonomy'  => 'product_visibility',
                'field'     => 'name',
                'terms'     => 'featured',
                'operator'  => 'IN'
            );

            $args = array(
                'post_type'         => 'product',
                'post_status'       => 'publish',
                'posts_per_page'    => 3,
                'meta_query'        => $meta_query,
                'tax_query'         => $tax_query
            );

            $query = new WP_Query( $args );

            if( $query->have_posts() ):
                while( $query->have_posts() ):
                    $query->the_post();

                    $product = get_product( $query->post->ID );
                    // echo $product;
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $query->post->ID ), 'single-post-thumbnail' );
                    $tags = get_the_terms( $query->post->ID, 'product_tag' );
                    $rating = $product->get_average_rating();
                    $reviewCount = $product->review_count;
                    $slug = $product->slug;

                    $stars = '';
                    $remainingStars = $rating;

                    for( $remainingStars; floor( $remainingStars ) > 0; $remainingStars-- ){
                        $stars .= '<i class="fas fa-star"></i>';
                    }

                    // $rating -= $remainingStars;

                    if( $remainingStars >= .5 ){
                        $stars .= '<i class="fas fa-star-half-alt"></i>';
                        $rating = ceil( $rating );
                    }

                    if( $rating < 5 ){
                        for( $rating; $rating < 5; $rating++ ){
                            $stars .= '<i class="far fa-star"></i>';
                        }
                    }

                    ?>
                    
                    <div class="products__product">
                        <a href="product/<?php echo $slug; ?>"><img class="products__image" src="<?php echo $image[0]; ?>" /></a>
                        <div class="products__top">
                            <div class="products__title-review">
                                <p class="products__title"><a href="product/<?php echo $slug; ?>"><?php echo $product->name; ?><?php if( $tags ): ?><span class="products__tag"> - <?php echo $tags[0]->name; ?></span><?php endif; ?></a></p>
                                <p class="products__rating"><?php if( $reviewCount > 0 ) echo $stars; else echo '<a href="product/' . $slug . '">Leave a Review</a>'; ?></p>
                            </div>
                            <p class="products__price"><?php echo $product->price; ?></p>
                        </div>
                        <p class="products__description"><?php if( $product->short_description ) echo $product->short_description; else echo $product->description; ?></p>
                    </div>

                    <?php
                endwhile;
            endif;

            wp_reset_query();
*/
            ?>

        </div>
        <a href="shop" class="btn btn-primary btn-center">Shop All</a>
    </div>
</div>