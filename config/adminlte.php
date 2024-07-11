<?php
    use Carbon\Carbon;
    $fecha_inicio_anio = Carbon::now()->startOfYear()->format('Y-m-d');
    $fecha_inicial     = Carbon::now()->startOfMonth()->format('Y-m-d');
    $fecha_final       = Carbon::now()->endOfMonth()->format('Y-m-d');
    
    $fecha_inicio = date('Y-m-01');
    $fecha_fin    = date('Y-m-t');
    $subdependencia_id = 0;
return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Grupo @mad',
    'title_prefix' => '@mad|',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    //'logo_img' => 'img/municipalidad_logo_negro.png',
    'logo_img_class' => 'brand-image-xs',
    'logo_img_xl' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_xl_class' => 'brand-image-xl',
    'logo_img_alt' => '@mad',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-navy',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => false,
    'layout_fixed_navbar' => false,
    'layout_fixed_footer' => false,
    'layout_dark_mode' => false,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-navy',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'layout-footer-fixed',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat bg-navy',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-warning elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'xs',
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => true,
    'sidebar_collapse_remember' => true,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-dark',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'light',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => true,
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        [
            'text'    => 'Administración',
            'icon'    => 'fas fa-user-shield',
            'can'     => 'seguridad',
            'submenu' => [
                [
                    'text'   => 'Permisos',
                    'route'  => 'permisos',
                ],
                [
                    'text'   => 'Roles',
                    'route'  => 'roles',
                ],
                [
                    'text'   => 'Usuarios',
                    'route'  => 'usuarios',
                ],
            ],
        ],
        [
            'text'    => 'Generales',
            'icon'    => 'fas fa-cogs',
            'can'     => 'ver-generales',
            'submenu' => [
                [
                    'text'    => 'Ubicaciones',
                    'icon'    => 'fas fa-globe',
                    'can'     => 'ver-ubicaciones',
                    'submenu' => [
                        [
                            'text'  => 'Departamentos',
                            'route' => 'departamentos',
                            'icon'  => 'fas fa-globe-africa',
                            'can'   => 'departamentos-ver'
                        ],
                        [
                            'text'  => 'Municipios',
                            'route' => 'municipios',
                            'icon'  => 'fas fa-globe-americas',
                            'can'   => 'municipios-ver'
                        ],
                        [
                            'text'  => 'Paises',
                            'route' => 'paises',
                            'icon'  => 'fas fa-globe-asia',
                            'can'   => 'paises-ver'
                        ],
                    ],
                ],
                [
                    'text'  => 'Empresas',
                    // 'route' => 'alertas',
                    'route' => 'empresas',
                    'icon'  => 'fas fa-hospital-user',
                    'can'   => 'ver-listado-empresas'
                ],
                [
                    'text'  => 'Puestos',
                    // 'route' => 'alertas',
                    'route' => 'puestos',
                    'icon'  => 'fas fa-sitemap',
                    'can'   => 'puestos-ver'
                ],
                [
                    'text'  => 'Servicios',
                    // 'route' => 'alertas',
                    'route' => 'servicios',
                    'icon'  => 'fas fa-tint',
                    'can'   => 'servicios-ver'
                ],
                [
                    'text'  => 'Variables',
                    // 'route' => 'alertas',
                    'route' => 'variables',
                    'icon'  => 'fas fa-check-circle',
                    'can'   => 'variables-ver'
                ],
            ],
        ],
        [
            'text'         => 'Junta Directiva',
            'route'        => 'directivas',
            'icon'         => 'fas fa-users',
            'topnav_right' => true,
            'can'          => 'directivas-ver',
        ],
        [
            'text'         => 'Personas',
            'route'        => 'personas',
            'icon'         => 'fas fa-user-cog',
            'topnav_right' => true,
            'can'          => 'personas-ver',
        ],
        [
            'text'         => 'Viviendas',
            'route'        => 'viviendas',
            'icon'         => 'fas fa-home',
            'topnav_right' => true,
            'can'          => 'viviendas-ver',
        ],
        [
            'text'         => 'Encuestas',
            'route'        => 'home',
            'icon'         => 'fas fa-signal',
            'topnav_right' => true,
            'can'          => 'encuestas-ver',
        ],
        // [
        //     'text'    => 'Transacciones',
        //     'icon'    => 'fas fa-cogs',
        //     'topnav_right' => true,
        //     'submenu' => [
        //         [
        //             'text'   => 'Gestión de Estudios',
        //             // 'route'  => 'graficos',
        //             'route' => 'trnestudios',
        //             'icon'   => 'fas fa-server',
        //             'can'    => 'ver-listado-transacciones',
        //         ],
        //         [
        //             'text'   => 'Emisión de Cobro',
        //             // 'route'  => ['consulta_solicitudes', ['fechaInicio'  => $fecha_inicio, 
        //             //                                       'fechaFin'     => $fecha_fin
        //             //                                      ]
        //             //             ],
        //             'route' => 'trncobros',
        //             'icon'   => 'fas fa-file-invoice',
        //             'can'    => 'ver-listado-cobros',
        //         ],
        //         [
        //             'text'   => 'Emisión de Pago',
        //             // 'route'  => ['consulta_solicitudes', ['fechaInicio'  => $fecha_inicio, 
        //             //                                       'fechaFin'     => $fecha_fin
        //             //                                      ]
        //             //             ],
        //             'route' => 'trnpagos',
        //             'icon'   => 'fas fa-money-bill-wave',
        //             'can'    => 'ver-listado-pagos',
        //         ],
        //     ],
        // ],

        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],
        // ['header' => 'account_settings'],
        // ['header' => 'labels'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
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
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
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
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
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
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
