<?php

// check if the flexible content field has rows of data
if( have_rows('flexible_content') ):

     // loop through the rows of data
    while ( have_rows('flexible_content') ) : the_row();

        if( get_row_layout() == 'basic' ):
            get_template_part( 'tp-basic' );

        elseif( get_row_layout() == 'image_boxes' ):
            get_template_part( 'tp-img-boxes' );

        endif;

    endwhile;

else :

    // no layouts found

endif;

?>