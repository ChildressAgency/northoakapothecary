<?php

$overlay = get_sub_field_object( 'overlay' );
$overlay = $overlay['value']
?>

<div class="section <?php if( get_sub_field( 'inset' ) ) echo 'section--inset'; ?>">
    <?php if( $overlay != 'none' ): ?><div class="overlay overlay--<?php echo $overlay; ?>"></div><?php endif; ?>
    <div class="container">
        <?php if( get_sub_field( 'section_heading' ) ): ?><h2 class="section__heading"><?php the_sub_field( 'section_heading' ); ?></h2><?php endif; ?>
        <div class="two-col">
            <div class="two-col__left">
                <?php the_sub_field( 'left_column' ); ?>
            </div>
            <div class="two-col__right">
                <?php the_sub_field( 'right_column' ); ?>
            </div>
        </div>
    </div>
</div>