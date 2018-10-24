jQuery(document).ready(function($) {
    //create TinyMCE plugin
    tinymce.create('tinymce.plugins.noa_bigtext', {
        init : function(ed, url) {
            // Setup the command when the button is pressed
            ed.addCommand('noa_custom_insert_bigtext', function() {
                content = '[bigtext]TEXT[/bigtext]';
                tinymce.execCommand('mceInsertContent', false, content);
            });
            //Add Button to Visual Editor Toolbar and launch the above command when it is clicked.
            ed.addButton('noa_bigtext', {
                title : 'Insert Big Text',
                cmd : 'noa_custom_insert_bigtext',
                image: 'http://dev.childressagency.com/northoak/wp-content/uploads/2018/10/bigtext.png'
            });
        },
    });
    //Setup the TinyMCE plugin. The first parameter is the button ID and the second parameter must match the first parameter of the above "tinymce.create ()" function.
    tinymce.PluginManager.add('noa_bigtext', tinymce.plugins.noa_bigtext);
});