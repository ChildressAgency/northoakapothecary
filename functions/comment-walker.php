<?php

class Comment_Walker extends Walker_Comment {
    var $tree_type = 'comment';
    var $db_fields = array( 
        'parent'    => 'comment_parent',
        'id'        => 'comment_ID'
    );

    function __construct(){ ?>
        
        <div class="comments-list">

    <?php }

    function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) { 
        $GLOBALS['comment'] = $comment; 

        $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

        $stars = '';
        $remainingStars = $rating;

        for( $remainingStars; floor( $remainingStars ) > 0; $remainingStars-- ){
            $stars .= '<i class="fas fa-star"></i>';
        }

        if( $remainingStars >= .5 ){
            $stars .= '<i class="fas fa-star-half-alt"></i>';
            $rating = ceil( $rating );
        }

        if( $rating < 5 ){
            for( $rating; $rating < 5; $rating++ ){
                $stars .= '<i class="far fa-star"></i>';
            }
        }?>

        <div id="comment-<?php comment_ID(); ?>" class="comment">
            <p><?php echo $stars; ?></p>
            <p class="comment__text"><?php echo $comment->comment_content; ?></p>
            <p class="comment__author"><?php echo $comment->comment_author; ?> on <?php echo date( 'F j, Y', strtotime( $comment->comment_date ) ); ?></p>
        </div>

    <?php }

    function __destruct(){ ?>

        </div>

    <?php }

}