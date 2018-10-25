$( document ).ready(function(){

    /**
     * FOOTER BOXES
     */

    // preload object array to gain performance
    $footerBox_headings = $('.footer-box__heading');

    // run at resize
    $( window ).resize(function() {
        $.fn.setHeadingHeight(0);   
    });  

    $.fn.setHeadingHeight = function(height) {

        // reset to auto or else we can't check height
        $($footerBox_headings).css({ 'height': 'auto' });

        // get highest value
        $($footerBox_headings).each(function(i, obj) {    
            height = Math.max(height, $(obj).outerHeight()) 
        });

        // set new height
        $($footerBox_headings).css({ 'height': height + 'px' });    
    }

    // run at load
    $.fn.setHeadingHeight(0);




    /**
     * INSTAGRAM FEED
     */
    $( '.instagram__feed' ).slick({
        slidesToShow:       5,
        slidesToScroll:     1,
        infinite:           true,
        variableWidth:      true,
        dots:               false,
        arrows:             true,
        nextArrow:          $( '.instagram__next' ),
        prevArrow:          $( '.instagram__prev' ),
        autoplay:           true,
        autoplaySpeed:      3000
    });

    $( '.slick-next.slick-arrow' ).html( '<div class="slick-arrow-next"></div>' );
    $( '.slick-prev.slick-arrow' ).html( '<div class="slick-arrow-prev"></div>' );
});