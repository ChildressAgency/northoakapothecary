$( document ).ready(function(){

    /**
     * FOOTER BOXES
     */
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



    /**
     * TWO COLUMN LAYOUT
     */
    $( '.two-col__left' ).each( function(){
        $( this ).not( ':has(img)' ).contents().wrapAll( '<div class="two-col__left-border" />' );
    } );
    $( '.two-col__right' ).each( function(){
        $( this ).not( ':has(img)' ).contents().wrapAll( '<div class="two-col__right-border" />' );
    } );



    /**
     * Remove p tags from images
     */
    $('p > img').unwrap();



    /**
     * Add to Cart
     */
    $base_url = $( '#add-to-cart-btn' ).data( 'cart-url' );
    $base_url = $base_url + '&quantity=';

    $( '#add-to-cart-btn' ).click(function( e ){
        $url = $base_url + $( '#product-quantity' ).val();
        $url = $url + '&price=6';

        $( this ).attr( 'href', $url );

        e.currentTarget.click();
    });




    /**
     * Star rating on reviews
     *
     * The rating is submitted via a hidden dropdown. When the user clicks on a
     * star, the stars will change to reflect the chosen rating and the corresponing
     * option in the dropdown will be chosen.
     */

    // get stars
    $stars = $( 'p.stars span a' );
    // default to 5 star rating
    $( '#rating>option:eq(5)' ).prop( 'selected', true );

    $stars.each(function( index ){
        // set all to filled stars
        $( this ).html( '<i class="fas fa-star"></i>' );
        // add id to each star
        $( this ).attr( 'id', 'star-' + index );

        $( this ).on( 'click', function( e ){
            e.preventDefault();
            // get index of current star using id
            $index = parseInt( $( this ).attr( 'id' ).split( '-' )[1], 10 );

            // select appropriate rating from dropdown
            $( '#rating>option:eq(' + ($index + 1) + ')' ).prop( 'selected', true );

            // replace the filled stars after this one with empty stars
            $stars.each(function( i ){
                if( i <= $index )
                    $( this ).html( '<i class="fas fa-star"></i>' );

                else
                    $( this ).html( '<i class="far fa-star"></i>' );
            });
        } );
    });



    /**
     * Single Product Gallery Images
     */
    $gallery = $( '.product__gallery > .attachment-full' );
    $featured = $( '.product__featured-image' );

    $gallery.each( function(){
        console.log( 'TRACE - each' );
        $( this ).click( function(){
            $src = $( this ).attr( 'src' );

            $( '.product__featured-image' ).attr( 'src', $src );
        } );
    } );



    /**
     * Newsletter Popup
     */
    $( '.masthead__newsletter a' ).click(function(){
        $( '#newsletter-popup' ).css( 'display', 'flex' );
    });

    $( '.popup__close' ).click(function(){
        $( '.popup-wrapper' ).css( 'display', 'none' );
    });



    /**
     * Popups
     */
    $( '.popup__trigger' ).click(function(){
        $link = $( this ).attr( 'href' );
        $( $link ).css( 'display', 'flex' );
    });
});