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

        endif;

    endwhile;

else:

    // no layouts found

endif;

?>