<?php 

/*
 * Template Name: Contact Template
 * Template Post Type: page
 */

get_header(); ?>

<div class="container">
    <hr />
</div>
    
<div class="section">
    <div class="container">
        <div class="contact">
            <div class="contact__info">
                <div class="contact__column">
                    <h2 class="contact__heading">Call Us:</h2>
                    <p class="contact__text"><strong><a href="tel:<?php echo get_field( 'phone', 'option' ); ?>"><?php echo get_field( 'phone', 'option' ); ?></a></strong></p>
                </div>
                <div class="contact__column">
                    <h2 class="contact__heading">Email Us:</h2>
                    <p class="contact__text"><strong><a href="mailto:<?php echo get_field( 'email', 'option' ); ?>"><?php echo get_field( 'email', 'option' ); ?></a></strong></p>
                </div>
                <div class="contact__column">
                    <h2 class="contact__heading">Follow Us:</h2>
                    <p class="contact__text contact__text--social"><strong>
                        <?php if( get_field( 'twitter', 'option' ) ): ?><a href="<?php the_field( 'twitter', 'option' ); ?>"><i class="fab fa-twitter-square"></i></a><?php endif; ?>
                        <?php if( get_field( 'facebook', 'option' ) ): ?><a href="<?php the_field( 'facebook', 'option' ); ?>"><i class="fab fa-facebook-square"></i></a><?php endif; ?>
                        <?php if( get_field( 'pinterest', 'option' ) ): ?><a href="<?php the_field( 'pinterest', 'option' ); ?>"><i class="fab fa-pinterest-square"></i></a><?php endif; ?>
                        <?php if( get_field( 'instagram', 'option' ) ): ?><a href="<?php the_field( 'instagram', 'option' ); ?>"><i class="fab fa-instagram"></i></a><?php endif; ?>
                        <?php if( get_field( 'linkedin', 'option' ) ): ?><a href="<?php the_field( 'linkedin', 'option' ); ?>"><i class="fab fa-linkedin"></i></a><?php endif; ?>
                    </strong></p>
                </div>
            </div>

            <div class="contact__form">
                <h2 class="contact__heading">Write Us:</h2>
                <!-- <form>
                    <input type="text" placeholder="Name" />
                    <input type="email" placeholder="Email" />
                    <input type="tel" placeholder="Phone Number" />
                    <textarea name="" id="" placeholder="Message"></textarea>
                    <input type="submit" class="btn btn-center btn-sign-in" value="SEND" />
                </form> -->
                <?php echo do_shortcode( get_field( 'form' ) ); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>