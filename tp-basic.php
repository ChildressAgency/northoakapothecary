<?php

$overlay = get_sub_field_object( 'overlay' );
$overlay = $overlay['value']
?>

<div class="section <?php if( get_sub_field( 'inset' ) ) echo 'section--inset'; ?>">
    <?php if( $overlay != 'none' ): ?><div class="overlay overlay--<?php echo $overlay; ?>"></div><?php endif; ?>
    <div class="container">
        <?php the_sub_field( 'content' ); ?>
    </div>
</div>