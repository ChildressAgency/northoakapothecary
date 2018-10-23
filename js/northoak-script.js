$( document ).ready(function(){

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
});