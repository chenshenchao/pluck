<?php return [
    /**
     * Pluck 默认设置。
     */
    

    /**
     * 权限
     * 
     */
    'permission' => [

    ],

    /**
     * 顶部栏
     * 
     */
    'topbar' => [
        'brand' => [
            'text' => 'Pluck',
            'link' => ['pluck-page', ['page' => 'index']],
        ],
        'left' => [
            'home' => [
                'icon' => 'fas fa-home',
                'text' => ['_home_'],
                'link' => '/',
            ],
        ],
        'right' => [
            'logout' => [
                'icon' => 'fas fa-sign-out-alt',
                'text' => ['_logout_'],
                'link' => ['pluck-page', ['page' => 'logout']],
            ]
        ],
    ],

    /**
     * 侧边栏
     * 
     */
    'sidebar' => [
        /**
         * 侧边栏菜单。
         * 
         */
        'menu' => [
            'administrator' => [
                'text' => ['_administrator_'],
                'icon' => 'fas fa-user',
                'link' => ['pluck-administrator-page', ['page' => 'index']],
                'order' => 0,
                'children' => [
                    'listing' => [
                        'text' => ['_administrator_list_'],
                        'icon' => 'fas fa-users',
                        'link' => ['pluck-administrator-page', ['page' => 'listing']],
                        'order' => 1,
                    ],
                    'add' => [
                        'text' => ['_administrator_add_'],
                        'icon' => 'fas fa-user-plus',
                        'link' => ['pluck-administrator-page', ['page' => 'add']],
                        'order' => 0,
                    ],
                ]
            ],
        ],
    ],
];