<div class="container">
    <?php if( get_sub_field( 'top_bar' ) ) echo '<hr />'; ?>

    <?php 
    $image = get_sub_field( 'image' ); ?>
    <div class="hero">
        <div class="hero__text-box">
            <div class="overlay overlay--dark"></div>
            <p class="hero__text"><?php the_sub_field( 'text' ); ?></p>
        </div>
        <img class="hero__img" src="<?php echo $image[ 'url' ]; ?>" alt="<?php echo $image[ 'alt' ]; ?>" >
    </div>

    <?php if( get_sub_field( 'bottom_bar' ) ) echo '<hr />'; ?>
</div>