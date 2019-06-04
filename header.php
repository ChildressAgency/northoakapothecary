<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width initial-scale=1.0" name="viewport">
    <meta content="The Childress Agency" name="author">
    <meta content="public" http-equiv="cache-control">
    <meta content="private" http-equiv="cache-control">
    
    <title><?php echo get_bloginfo( 'name' ); if( get_bloginfo( 'description' ) ): echo ' | ' . get_bloginfo( 'description' ); endif; ?></title>

    <?php wp_head(); ?>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
    <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
    <!--[if gte IE 9]
    <style type='text/css'>
    footer {
    filter: none;
    }
    </style>
    <![endif]-->
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="masthead">
            <div class="masthead__contact">
                <a href="tel:<?php echo get_field( 'phone', 'option' ); ?>"><?php the_field( 'phone', 'option' ); ?></a> | <a href="mailto:<?php echo get_field( 'email', 'option' ); ?>"><?php the_field( 'email', 'option' ); ?></a>
            </div>
            <div class="masthead__newsletter">
                <a href="#"><em>Join Our Newsletter</em></a>
            </div>
            <div class="masthead__shop">
                <?php if( is_user_logged_in() ): ?>
                    <a href="<?php echo esc_url(home_url('my-account')); ?>">My Account <i class="fas fa-user"></i></a>
                <?php else: ?>
                    <a href="<?php echo home_url( 'login' ); ?>">Login <i class="fas fa-user"></i></a>
                <?php endif; ?>

                <!--<a href="#">Cart <i class="fas fa-shopping-cart"></i> (0)</a>-->
                <?php do_action('northoak_show_cart_link'); ?>
                <a href=""><i class="fas fa-search"></i></a>
            </div>
        </div>
        <div class="header">
            <?php $logo = get_field( 'logo', 'option' ); ?>
            <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo[ 'url' ]; ?>" alt="<?php echo $logo[ 'alt' ]; ?>" /></a>
            <nav class="navbar navbar-expand-md">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="collapse navbar-collapse">
                    <?php 
                    wp_nav_menu( array(
                        'theme_location'    =>  'main_menu',
                        'menu_class'        =>  'navbar-nav header__nav',
                        'walker'            =>  new Custom_Nav_Walker()
                    ) ); ?>
                </div>
            </nav>
            <?php if( get_field( 'header_text', 'option' ) ): ?><p><em><?php the_field( 'header_text', 'option' ); ?></em></p><?php endif; ?>
        </div>
    </header>
