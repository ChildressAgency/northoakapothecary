jQuery(document).ready(function($) {
    //create TinyMCE plugin
    tinymce.create('tinymce.plugins.noa_custom_button', {
        init : function(ed, url) {
            // Setup the command when the button is pressed
            ed.addCommand('noa_custom_insert_button', function() {
                content = '[button link="#" type="1"]TEXT[/button]';
                tinymce.execCommand('mceInsertContent', false, content);
            });
            //Add Button to Visual Editor Toolbar and launch the above command when it is clicked.
            ed.addButton('noa_custom_button', {
                title : 'Insert Button',
                cmd : 'noa_custom_insert_button',
                image: 'http://dev.childressagency.com/northoak/wp-content/uploads/2018/10/button.png'
            });
        },
    });
    //Setup the TinyMCE plugin. The first parameter is the button ID and the second parameter must match the first parameter of the above "tinymce.create ()" function.
    tinymce.PluginManager.add('noa_custom_button', tinymce.plugins.noa_custom_button);
});