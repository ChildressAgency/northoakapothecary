<?php get_header(); ?>

    <div class="section">
        <div class="container">
            <h1 class="section__heading">JOURNAL</h1>
            <div class="journal-wrapper">
                <div class="journal">
                    <?php 
                    
                    // $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    if( get_query_var( 'paged' ) )
                        $paged = get_query_var( 'paged' );
                    elseif( get_query_var( 'page' ) )
                        $paged = get_query_var( 'page' );
                    else
                        $paged = 1;
                    
                    $args = array(
                        'post_type'             => 'post',
                        'post_status'           => 'publish',
                        'posts_per_page'        => get_option( 'posts_per_page' ),
                        'ignore_sticky_posts'   => 1,
                        'paged'                 => $paged
                    );
                    $query = new WP_Query( $args );
                    
                    if( have_posts() ): ?>
                        <?php while( have_posts() ): the_post(); ?>
                            <div class="journal__post">
                                <h2 class="journal__heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p class="journal__excerpt"><?php echo mb_strimwidth( get_the_content(), 0, 500, '...' ); ?></p>
                                <a class="btn btn-primary" href="<?php the_permalink(); ?>">Read More</a>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No posts found.</p>
                    <?php endif; ?>    
                    
                    <div class="pagination">
                        <?php 
                            global $query;
                            
                            echo paginate_links( array(
                                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                                'total'        => $query->max_num_pages,
                                'current'      => max( 1, get_query_var( 'paged' ) ),
                                'format'       => '?paged=%#%',
                                'show_all'     => false,
                                'type'         => 'plain',
                                'end_size'     => 1,
                                'mid_size'     => 2,
                                'prev_next'    => true,
                                'prev_text' => __( '<', 'textdomain' ),
                                'next_text' => __( '>', 'textdomain' ),
                                'add_args'     => false,
                                'add_fragment' => '',
                            ) );
                        ?>
                    </div>
                    
                    <?php wp_reset_postdata(); ?>
                </div>
                <div class="sidebar">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>