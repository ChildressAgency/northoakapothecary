<?php

$overlay = get_sub_field_object( 'overlay' );
$overlay = $overlay['value']
?>

<?php if( have_rows( 'image_boxes' ) ): ?>
    <div class="section <?php if( get_sub_field( 'inset' ) ) echo 'section--inset'; ?>">
        <?php if( $overlay != 'none' ): ?><div class="overlay overlay--<?php echo $overlay; ?>"></div><?php endif; ?>
        <div class="container">
            <div class="img-boxes">
                <?php while( have_rows( 'image_boxes' ) ): the_row(); ?>
                    <a class="img-box" href="<?php the_sub_field( 'link' ); ?>">
                        <img class="img-box__image" src="<?php the_sub_field( 'image' ); ?>" />
                        <h3 class="img-box__title"><?php the_sub_field( 'title' ); ?></h3>
                    </a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php endif; ?>