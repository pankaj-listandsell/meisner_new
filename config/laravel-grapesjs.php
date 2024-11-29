<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Expose API
    |--------------------------------------------------------------------------
    |
    | This will expose the editor variable. 
    | It can be accessed via a window.gjsEditor
    |
    */

    'expose_api' => false,

    /*
    |--------------------------------------------------------------------------
    | Routes 
    |--------------------------------------------------------------------------
    |
    | Routes Settings
    |
    */
    
    'routes' => [
        'middleware' => [
            'web', 'auth',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Force Class
    |--------------------------------------------------------------------------
    |
    | @See https://github.com/artf/grapesjs/issues/546
    |
    */
    
    'force_class' => false,

    /*
    |--------------------------------------------------------------------------
    | Global Styles
    |--------------------------------------------------------------------------
    |
    | Global Styles for the editor blade file.
    */

    'styles' => [
        'vendor/laravel-grapesjs/assets/editor.css',
    ],

    /*
    |--------------------------------------------------------------------------
    | Global Scripts
    |--------------------------------------------------------------------------
    |
    | Global scripts for the editor blade file.
    */

    'scripts' => [
        //'vendor/laravel-grapesjs/assets/editor.js'
    ],

    /*
    |--------------------------------------------------------------------------
    | Canvas styles and scripts
    |--------------------------------------------------------------------------
    |
    | The styles and scripts for the editor content.
    | You need to add these also to your layout.
    | e.g the bootstrap files, etc
    |
    */

    'canvas' => [
        'styles' => [
            'css/frontend-app.css',
            'css/owl.carousel.css',
            'css/combined-app.css',
            'css/huzaifa-custom.css',
            'css/frontend-custom.css'
        ],
        'scripts' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Assets Manager
    |--------------------------------------------------------------------------
    |
    | Here you can configure the disk and custom upload URL for your asset
    | manager.
    |
    */

    'assets' => [
        'disk' => 'uploads', //Default: local
        'path' => '', //Default: 'laravel-grapesjs/media',
        'upload_url' => 'admin/module/media/store-multiple',
    ],

    /*
    |--------------------------------------------------------------------------
    | Style Manager
    |--------------------------------------------------------------------------
    |
    | Enable/Disable selectors.
    | @see https://grapesjs.com/docs/api/style_manager.html#stylemanager
    |
    */

    'style_manager' => [
        'limited_selectors' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage Manager
    |--------------------------------------------------------------------------
    |
    | Enable/Disable the autosave function for your editor.
    |
    */

    'storage_manager' => [
        'autosave' => true,
        'steps_before_save' => 10,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugin Manager
    |--------------------------------------------------------------------------
    |
    | You can enable/disable built-in plugins or can add any custom plugin from
    | this config. Formats for custom plugins are as below.
    |
    | 1. Simplest way
    |   'plugin-name' => 'https://url_to_plugin_script.com'
    |    
    | 2. Simple with options (Plugin script will be added to global scrips above)
    |   'plugin-name' => [
    |       //plugin options goes here
    |     ]
    |
    | 3. Advanced way
    |   [
    |       'enabled => true,
    |       'name' => 'plugin-name',
    |       'styles' => [
    |           'https://url_to_plugin_styles.com',
    |       ],
    |       'scripts' => [
    |           'https://url_to_plugin_script.com',
    |       ],
    |       'options' => [
    |           //plugin options goes here
    |       ],
    |   ]
    |
    */

    'plugins' => [
        'default' => [
            'basic_blocks' => true,
            'bootstrap4_blocks' => true,
            'code_editor' => true,
            'image_editor' => false,
            'custom_fonts' => [],
            'templates' => true,
        ],
        'custom' => [
            'grapesjs-custom-code' => 'https://unpkg.com/grapesjs-custom-code',
            [
                'enabled' => true,
                'name' => 'gjs-plugin-ckeditor',
                'scripts' => [
                    'https://cdn.ckeditor.com/4.14.0/full-all/ckeditor.js',
                    'https://unpkg.com/grapesjs-plugin-ckeditor',
                ],
                'options' => [
                    'position' => 'left',
                    'options' => [ 
                        'toolbarGroups' => [
                            [ "name" => "document", "groups" => [ "mode", "document", "doctools" ] ],
                            [ "name" => "clipboard", "groups" => [ "clipboard", "undo" ] ],
                            [ "name" => "editing", "groups" => [ "find", "selection", "spellchecker", "editing" ] ],
                            [ "name" => "forms", "groups" => [ "forms" ] ],
                            [ "name" => "basicstyles", "groups" => [ "basicstyles", "cleanup" ] ],
                            [ "name" => "styles", "groups" => [ "styles" ] ],
                            [ "name" => "paragraph", "groups" => [ "list", "indent", "blocks", "align", "bidi", "paragraph" ] ],
                            [ "name" => "links", "groups" => [ "links" ] ],
                            [ "name" => "insert", "groups" => [ "insert" ] ],
                            [ "name" => "colors", "groups" => [ "colors" ] ],
                            [ "name" => "tools", "groups" => [ "tools" ] ],
                            [ "name" => "others", "groups" => [ "others" ] ],
                            [ "name" => "about", "groups" => [ "about" ] ]
                        ],
                        'removeButtons' => 'Save,NewPage,Preview,Print,Templates,Source,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Table,About'
                    ],
                ],
            ],
            [
                'enabled' => false,
                'name' => 'grapesjs-plugin-forms',
                'options' => [],
                'scripts' => [
                    'https://unpkg.com/grapesjs-plugin-forms',
                ],
            ],
        ],
    ],
];