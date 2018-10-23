<?php
/*
 * This custom shortcode creates span that defines a bigtext
 */
function bigtext_function( $atts, $content = null ) {

    $return_string = '<span class="bigtext">';

    // button text
    if( $content )
        $return_string .= $content;
    else
        $return_string .= 'Subtext';

    $return_string .= '</span>';

    return $return_string;
}

/*
 * 'bigtext' is how the shortcode is called
 * e.g. [bigtext]
 */
function register_bigtext_shortcode(){
   add_shortcode('bigtext', 'bigtext_function');
}
add_action( 'init', 'register_bigtext_shortcode');

/*
 *Initialize process for registering your custom TinyMCE buttons hook
 */
add_action('init', 'sh_custom_shortcode_bigtext_init_callback');
/*
 * Initialize process for registering your custom TinyMCE buttons callback
 */
function sh_custom_shortcode_bigtext_init_callback() {
 
    //If the user can not see the TinyMCE please stop early
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true') {
        return;
    }
 
    //Add a callback request to register the tinymce plugin hook
    add_filter("mce_external_plugins", "noa_custom_register_tinymce_bigtext_plugin_callback");
    //Add a callback request to add the button to the TinyMCE toolbar hook
    add_filter('mce_buttons', 'noa_custom_add_tinymce_bigtext_callback');
}

/*
 * This callback is process our TinyMCE Editor plug-in.
 */
function noa_custom_register_tinymce_bigtext_plugin_callback($plugin_array) {
    $url = get_template_directory_uri() . '/js/bigtext-shortcode.js';
    //set custom js url path
    $plugin_array['noa_bigtext'] = $url;
    //return
    return $plugin_array;
}
 
/*
 * This callback adds our button to the TinyMCE Editor toolbar
 */
function noa_custom_add_tinymce_bigtext_callback($buttons) {
    //Set the custom button identifier to the $buttons array
    $buttons[] = "noa_bigtext";
    //return $buttons
    return $buttons;
}