<?php get_header(); ?>
    <main>
        <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>

        <?php get_template_part( 'template-parts/tp-flexible-content' ); ?>

    </main>
<?php get_footer(); ?>