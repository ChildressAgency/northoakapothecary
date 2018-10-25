<?php

// check if the flexible content field has rows of data
if( have_rows('flexible_content') ):

     // loop through the rows of data
    while ( have_rows('flexible_content') ) : the_row();

        if( get_row_layout() == 'basic' ):
            get_template_part( 'template-parts/tp-basic' );

        elseif( get_row_layout() == 'image_boxes' ):
            get_template_part( 'template-parts/tp-img-boxes' );

        elseif( get_row_layout() == 'featured_products' ):
            get_template_part( 'template-parts/tp-featured-products' );

        elseif( get_row_layout() == 'instagram_feed' ):
            get_template_part( 'template-parts/tp-instagram-feed' );

        elseif( get_row_layout() == 'testimonials' ):
            get_template_part( 'template-parts/tp-testimonials' );

        endif;

    endwhile;

else:

    // no layouts found

endif;

?>