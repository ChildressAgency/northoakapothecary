<?php get_header(); ?>

    <?php if( have_rows( 'carousel' ) ): ?>
        <div id="home-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $i = 0; while( have_rows( 'carousel' ) ): the_row(); ?>
                    <div class="carousel-item <?php if( $i == 0 ) echo 'active'; ?>" style="background-image: url('<?php the_sub_field( 'image' ); ?>');">
                        <div class="dark-overlay"></div>
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
                <!-- <div class="carousel-item" style="background-image: url('http://dev.childressagency.com/northoak/wp-content/uploads/2018/10/carousel-1.png');">
                    <div class="dark-overlay"></div>
                    <div class="carousel-caption">
                        <h2 class="carousel__heading">LEMON HONEY 2</h2>
                        <p class="carousel__text">Shop our new line of products utilizing our new combination of sustainably sources organic honey from Virginia combined with local organic lemons from South Side Farms. Products ranges from handsoap bars to facemasks. Get stocked up for summer!</p>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                        <ol class="carousel-indicators">
                            <li data-target="#home-carousel" data-slide-to="0"></li>
                            <li data-target="#home-carousel" data-slide-to="1" class="active"></li>
                            <li data-target="#home-carousel" data-slide-to="2"></li>
                        </ol>
                    </div>
                </div>
                <div class="carousel-item" style="background-image: url('http://dev.childressagency.com/northoak/wp-content/uploads/2018/10/carousel-1.png');">
                    <div class="dark-overlay"></div>
                    <div class="carousel-caption">
                        <h2 class="carousel__heading">LEMON HONEY 3</h2>
                        <p class="carousel__text">Shop our new line of products utilizing our new combination of sustainably sources organic honey from Virginia combined with local organic lemons from South Side Farms. Products ranges from handsoap bars to facemasks. Get stocked up for summer!</p>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                        <ol class="carousel-indicators">
                            <li data-target="#home-carousel" data-slide-to="0"></li>
                            <li data-target="#home-carousel" data-slide-to="1"></li>
                            <li data-target="#home-carousel" data-slide-to="2" class="active"></li>
                        </ol>
                    </div>
                </div> -->
            </div>
        </div>
    <?php endif; ?>

<?php get_footer(); ?>