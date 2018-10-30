    <footer>
        <div class="footer-boxes">
            <?php if( have_rows( 'footer_boxes', 'option' ) ): while( have_rows( 'footer_boxes', 'option' ) ): the_row(); ?>
                <div class="footer-box">
                    <div class="footer-box__heading">
                        <h2><?php the_sub_field( 'heading' ); ?></h2>
                    </div>
                    <div class="footer-box__text">
                        <?php the_sub_field( 'text' ); ?>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>

        <div class="footer">
            <?php $logo = get_field( 'footer_logo', 'option' ); ?>
            <div class="footer__logo"><img src="<?php echo $logo[ 'url' ]; ?>" alt="<?php echo $logo[ 'alt' ]; ?>" /></div>
            <div class="footer__info">
                <?php 
                wp_nav_menu( array(
                    'theme_location'    =>  'footer_menu',
                    'menu_class'        =>  'navbar-nav footer__nav',
                    'walker'            =>  new Custom_Nav_Walker()
                ) ); ?>
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