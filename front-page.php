<?php get_header(); ?>

    <?php if( have_rows( 'carousel' ) ): ?>
        <div id="home-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $i = 0; while( have_rows( 'carousel' ) ): the_row(); ?>
                    <div class="carousel-item <?php if( $i == 0 ) echo 'active'; ?>" style="background-image: url('<?php the_sub_field( 'image' ); ?>');">
                        <div class="overlay overlay--dark"></div>
                        <div class="carousel-caption">
                            <h2 class="carousel__heading"><?php the_sub_field( 'heading' ); ?></h2>
                            <p class="carousel__text"><?php the_sub_field( 'text' ); ?></p>
                            <?php if( get_sub_field( 'link' ) && get_sub_field( 'link_text' ) ): ?><a href="<?php the_sub_field( 'link' ); ?>" class="btn btn-primary"><?php the_sub_field( 'link_text' ); ?></a><?php endif; ?>
                            <ol class="carousel-indicators">
                                <?php for( $j = 0; $j < count( get_field( 'carousel' ) ); $j++ ): ?>
                                    <li data-target="#home-carousel" data-slide-to="<?php echo $j; ?>" <?php if( $j == $i ) echo 'class="active"'; ?>></li>
                                <?php endfor; ?>
                            </ol>
                        </div>
                    </div>
                <?php $i++; endwhile; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php get_template_part( 'template-parts/tp-flexible-content' ); ?>

<?php get_footer(); ?>