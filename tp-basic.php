<?php

$overlay = get_field_object( 'overlay' ); 
$overlay = $overlay['value']
?>

<div class="section <?php if( $overlay != 'none' ) echo 'section--' . $overlay; ?>">
    <div class="container">
        <?php the_sub_field( 'content' ); ?>
    </div>
</div>