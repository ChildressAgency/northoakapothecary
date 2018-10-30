<?php

$overlay = get_sub_field_object( 'overlay' );
$overlay = $overlay['value']
?>

    <div class="section <?php if( get_sub_field( 'inset' ) ) echo 'section--inset'; ?>">
        <?php if( $overlay != 'none' ): ?><div class="overlay overlay--<?php echo $overlay; ?>"></div><?php endif; ?>
        <div class="container">
            <?php if( get_sub_field( 'section_heading' ) ): ?><h2 class="section__heading"><?php the_sub_field( 'section_heading' ); ?></h2><?php endif; ?>

            <div class="testimonials">
                <?php if( have_rows( 'testimonials' ) ): while( have_rows( 'testimonials' ) ): the_row(); ?>
                    <div class="testimonials__box">
                        <div class="testimonial">
                            <img class="testimonial__img" src="wp-content/uploads/2018/10/quote-icon.png">
                            <div class="testimonial__quote"><?php the_sub_field( 'quote' ); ?></div>
                        </div>
                        <div class="testimonials__name"><?php the_sub_field( 'name' ); ?></div>
                    </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>