<?php

return [
    /*
     * |--------------------------------------------------------------------------
     * | Title
     * |--------------------------------------------------------------------------
     * |
     * | Here you can change the default title of your admin panel.
     * |
     * | For detailed instructions you can look the title section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
     * |
     */
    'title' => 'Barangay 73',
    'title_prefix' => 'B.I.S. - ',
    'title_postfix' => '',

    /*
     * |--------------------------------------------------------------------------
     * | Favicon
     * |--------------------------------------------------------------------------
     * |
     * | Here you can activate the favicon.
     * |
     * | For detailed instructions you can look the favicon section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
     * |
     */
    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
     * |--------------------------------------------------------------------------
     * | Google Fonts
     * |--------------------------------------------------------------------------
     * |
     * | Here you can allow or not the use of external google fonts. Disabling the
     * | google fonts may be useful if your admin panel internet access is
     * | restricted somehow.
     * |
     * | For detailed instructions you can look the google fonts section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
     * |
     */
    'google_fonts' => [
        'allowed' => true,
    ],

    /*
     * |--------------------------------------------------------------------------
     * | Admin Panel Logo
     * |--------------------------------------------------------------------------
     * |
     * | Here you can change the logo of your admin panel.
     * |
     * | For detailed instructions you can look the logo section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
     * |
     */
    'logo' => '<b>Barangay 73</b>',
    'logo_img' => 'img/uploads/settings/logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-2 me-2',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Barangay Logo',

    /*
     * |--------------------------------------------------------------------------
     * | Authentication Logo
     * |--------------------------------------------------------------------------
     * |
     * | Here you can setup an alternative logo to use on your login and register
     * | screens. When disabled, the admin panel logo will be used instead.
     * |
     * | For detailed instructions you can look the auth logo section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
     * |
     */
    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'img/logo.png',
            'alt' => 'Auth Logo',
            'class' => 'mx-2',
            'width' => 75,
            'height' => 75,
        ],
    ],

    /*
     * |--------------------------------------------------------------------------
     * | Preloader Animation
     * |--------------------------------------------------------------------------
     * |
     * | Here you can change the preloader animation configuration. Currently, two
     * | modes are supported: 'fullscreen' for a fullscreen preloader animation
     * | and 'cwrapper' to attach the preloader animation into the content-wrapper
     * | element and avoid overlapping it with the sidebars and the top navbar.
     * |
     * | For detailed instructions you can look the preloader section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
     * |
     */
    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => '/img/logomanila.png',
            'alt' => 'BIS Logo Img',
            'effect' => 'animation__wobble',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
     * |--------------------------------------------------------------------------
     * | User Menu
     * |--------------------------------------------------------------------------
     * |
     * | Here you can activate and change the user menu.
     * |
     * | For detailed instructions you can look the user menu section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
     * |
     */
    'usermenu_enabled' => false,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
     * |--------------------------------------------------------------------------
     * | Layout
     * |--------------------------------------------------------------------------
     * |
     * | Here we change the layout of your admin panel.
     * |
     * | For detailed instructions you can look the layout section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
     * |
     */
    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
     * |--------------------------------------------------------------------------
     * | Authentication Views Classes
     * |--------------------------------------------------------------------------
     * |
     * | Here you can change the look and behavior of the authentication views.
     * |
     * | For detailed instructions you can look the auth classes section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
     * |
     */
    'classes_auth_card' => 'card-outline card-navy',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
     * |--------------------------------------------------------------------------
     * | Admin Panel Classes
     * |--------------------------------------------------------------------------
     * |
     * | Here you can change the look and behavior of the admin panel.
     * |
     * | For detailed instructions you can look the admin panel classes here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
     * |
     */
    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-navy elevation-4',
    'classes_sidebar_nav' => 'nav-flat',
    'classes_topnav' => 'navbar-dark navbar-navy',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
     * |--------------------------------------------------------------------------
     * | Sidebar
     * |--------------------------------------------------------------------------
     * |
     * | Here we can modify the sidebar of the admin panel.
     * |
     * | For detailed instructions you can look the sidebar section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
     * |
     */
    'sidebar_mini' => null,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => true,
    'sidebar_collapse_remember_no_transition' => false,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
     * |--------------------------------------------------------------------------
     * | Control Sidebar (Right Sidebar)
     * |--------------------------------------------------------------------------
     * |
     * | Here we can modify the right sidebar aka control sidebar of the admin panel.
     * |
     * | For detailed instructions you can look the right sidebar section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
     * |
     */
    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
     * |--------------------------------------------------------------------------
     * | URLs
     * |--------------------------------------------------------------------------
     * |
     * | Here we can modify the url settings of the admin panel.
     * |
     * | For detailed instructions you can look the urls section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
     * |
     */
    'use_route_url' => false,
    'dashboard_url' => '/checkRole',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    /*
     * |--------------------------------------------------------------------------
     * | Laravel Asset Bundling
     * |--------------------------------------------------------------------------
     * |
     * | Here we can enable the Laravel Asset Bundling option for the admin panel.
     * | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
     * | When using 'vite_js_only', it's expected that your CSS is imported using
     * | JavaScript. Typically, in your application's 'resources/js/app.js' file.
     * | If you are not using any of these, leave it as 'false'.
     * |
     * | For detailed instructions you can look the asset bundling section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
     * |
     */
    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
     * |--------------------------------------------------------------------------
     * | Menu Items
     * |--------------------------------------------------------------------------
     * |
     * | Here we can modify the sidebar/top navigation of the admin panel.
     * |
     * | For detailed instructions you can look here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
     * |
     */
    'menu' => [],

    /*
     * |--------------------------------------------------------------------------
     * | Menu Filters
     * |--------------------------------------------------------------------------
     * |
     * | Here we can modify the menu filters of the admin panel.
     * |
     * | For detailed instructions you can look the menu filters section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
     * |
     */
    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
     * |--------------------------------------------------------------------------
     * | Plugins Initialization
     * |--------------------------------------------------------------------------
     * |
     * | Here we can modify the plugins used inside the admin panel.
     * |
     * | For detailed instructions you can look the plugins section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
     * |
     */
    'plugins' => [
        'Jquery' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/jquery/jquery.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/jquery-knob/jquery.knob.min.js',
                ],
            ],
        ],
        'Bootstrap' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/popper/umd/popper.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/bootstrap/js/bootstrap.bundle.min.js',
                ],
            ],
        ],
        'Moment' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/moment/moment.min.js',
                ],
            ],
        ],
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Datatables-plugins' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/pdfmake/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/pdfmake/vfs_fonts.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/buttons/js/buttons.colVis.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
            ],
        ],
        'Datarangepicker' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
                ],
            ],
        ],
        'TempusDominus' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/daterangepicker/daterangepicker.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/daterangepicker/daterangepicker.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/select2/js/select2.full.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/select2/css/select2.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/sweetalert2/sweetalert2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/sweetalert2/sweetalert2.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'Apexchartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/apexcharts/dist/apexcharts.min.js',
                ]
            ]
        ],
        'Inputmask' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/inputmask/jquery.inputmask.min.js',
                ],
            ],
        ],
        'Toastr' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/toastr/toastr.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/toastr/toastr.min.css',
                ],
            ],
        ],
        'iCheck' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/icheck-bootstrap/icheck-bootstrap.min.css',
                ],
            ],
        ],
        'Summernote' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/summernote/summernote-bs4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/summernote/summernote-bs4.min.css',
                ],
            ],
        ],
        'Ekko-Lightbox' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/ekko-lightbox/ekko-lightbox.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/ekko-lightbox/ekko-lightbox.css',
                ],
            ],
        ],
    ],

    /*
     * |--------------------------------------------------------------------------
     * | IFrame
     * |--------------------------------------------------------------------------
     * |
     * | Here we change the IFrame mode configuration. Note these changes will
     * | only apply to the view that extends and enable the IFrame mode.
     * |
     * | For detailed instructions you can look the iframe mode section here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
     * |
     */
    'iframe' => [
        'default_tab' => [
            'url' => '/admin',
            'title' => 'Dashboard',
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => false,
        ],
    ],

    /*
     * |--------------------------------------------------------------------------
     * | Livewire
     * |--------------------------------------------------------------------------
     * |
     * | Here we can enable the Livewire support.
     * |
     * | For detailed instructions you can look the livewire here:
     * | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
     * |
     */
    'livewire' => false,
];
