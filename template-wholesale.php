<?php 

/**
 * Template Name: Wholesale Template
 * Template Post Type: page
 */

get_header(); ?>

    <div class="section">
        <div class="container">
            <div class="wholesale">
                <?php $wholesale = get_field( 'wholesale_info' ); ?>
                <div class="wholesale__left">
                    <?php echo $wholesale['left_column']; ?>
                </div>
                <div class="wholesale__right">
                    <?php echo $wholesale['right_column']; ?>
                </div>
            </div>
            <!-- <form class="wholesale__form">
                <div class="wholesale__form-info">
                    <div class="wholesale__form-meta">
                        <span><input type="text" placeholder="Name" /></span>
                        <span><input type="text" placeholder="Email" /></span>
                        <span><input type="text" placeholder="Phone Number" /></span>
                        <span><input type="text" placeholder="Company" /></span>
                    </div>
                    <div class="wholesale__form-message">
                        <span><textarea placeholder="Message"></textarea></span>
                    </div>
                </div>
            </form> -->
            <?php echo do_shortcode( '[contact-form-7 id="189" title="Wholesale Form"]' ); ?>
        </div>
    </div>

    <div class="section section--inset">
        <div class="overlay overlay--marble"></div>
        <div class="container">
            <div class="sign-in-text">
                <?php the_field( 'sign_in_text' ); ?>    
            </div>
            <a href="login/" class="btn btn-center btn-sign-in">SIGN IN NOW</a>
        </div>
    </div>

<?php get_footer(); ?>