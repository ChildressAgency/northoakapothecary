jQuery(document).ready(function($) {
    //create TinyMCE plugin
    tinymce.create('tinymce.plugins.noa_script', {
        init : function(ed, url) {
            // Setup the command when the button is pressed
            ed.addCommand('noa_custom_insert_script', function() {
                content = '[script]TEXT[/script]';
                tinymce.execCommand('mceInsertContent', false, content);
            });
            //Add Button to Visual Editor Toolbar and launch the above command when it is clicked.
            ed.addButton('noa_script', {
                title : 'Insert Script',
                cmd : 'noa_custom_insert_script',
                image: 'http://dev.childressagency.com/northoak/wp-content/uploads/2018/10/script.png'
            });
        },
    });
    //Setup the TinyMCE plugin. The first parameter is the button ID and the second parameter must match the first parameter of the above "tinymce.create ()" function.
    tinymce.PluginManager.add('noa_script', tinymce.plugins.noa_script);
});