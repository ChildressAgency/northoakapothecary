    <footer>
        <div class="footer-boxes">
            <div class="footer-box">
                <div class="footer-box__heading">
                    <h2>Are you interested in collaborating with us for wholesale?</h2>
                </div>
                <div class="footer-box__text">
                    <p>We love connecting with new businesses that share our passion for quality, sustainable products using organic ingredients.</p>
                    <p>Contact us to learn more about how you can provide your clientele with our products.</p>
                    <a href="#" class="btn btn-primary">Contact Us</a>
                </div>
            </div>
            <div class="footer-box">
                <div class="footer-box__heading">
                    <h2>Join Our Newsletter</h2>
                </div>
                <div class="footer-box__text">
                    <p>Don’t miss out on our latest news, products & specials.</p>
                    <p class="footer-box__subtext"><em>New signups will receive 10% off their next order...</em></p>
                    <?php echo do_shortcode( '[contact-form-7 id="63" title="Newsletter Signup"]' ); ?>
                    <!-- <form action="">
                        <input type="email" placeholder="Email Address" />
                        <input type="submit" value="Submit" />
                    </form> -->
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer__logo"><img src="wp-content/uploads/2018/10/logo-alt.png" /></div>
            <div class="footer__info">
                <!-- <nav class="navbar navbar-expand-md"> -->
                    <?php 
                    wp_nav_menu( array(
                        'theme_location'    =>  'footer_menu',
                        'menu_class'        =>  'navbar-nav footer__nav',
                        'walker'            =>  new Custom_Nav_Walker()
                    ) ); ?>
                <!-- </nav> -->
                <div class="footer__contact">
                    <div class="footer__social">
                        <?php if( get_field( 'twitter', 'option' ) ): ?><a href="<?php the_field( 'twitter', 'option' ); ?>"><i class="fab fa-twitter-square"></i></a><?php endif; ?>
                        <?php if( get_field( 'facebook', 'option' ) ): ?><a href="<?php the_field( 'facebook', 'option' ); ?>"><i class="fab fa-facebook-square"></i></a><?php endif; ?>
                        <?php if( get_field( 'pinterest', 'option' ) ): ?><a href="<?php the_field( 'pinterest', 'option' ); ?>"><i class="fab fa-pinterest-square"></i></a><?php endif; ?>
                        <?php if( get_field( 'instagram', 'option' ) ): ?><a href="<?php the_field( 'instagram', 'option' ); ?>"><i class="fab fa-instagram"></i></a><?php endif; ?>
                        <?php if( get_field( 'linkedin', 'option' ) ): ?><a href="<?php the_field( 'linkedin', 'option' ); ?>"><i class="fab fa-linkedin"></i></a><?php endif; ?>
                    </div> 
                    <span>|</span>
                    <a href="tel:<?php echo get_field( 'phone', 'option' ); ?>"><?php the_field( 'phone', 'option' ); ?></a> 
                    <span>|</span>
                    <a href="mailto:<?php echo get_field( 'email', 'option' ); ?>"><?php the_field( 'email', 'option' ); ?></a>
                </div>
                <div class="footer__copyright">
                    <?php 
                    wp_nav_menu( array(
                        'theme_location'    =>  'copyright_menu',
                        'menu_class'        =>  'navbar-nav copyright__nav',
                        'walker'            =>  new Custom_Nav_Walker()
                    ) ); ?>
                    <p><?php the_field( 'copyright', 'option' ); ?></p>
                </div>
            </div>
        </div>
    </footer>
    
    <?php wp_footer(); ?>
</body>
</html>