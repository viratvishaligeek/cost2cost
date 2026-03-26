<?php

return [

    // dashboard menu
    [
        'title' => 'Dashboard',
        'icon' => 'fa-solid fa-gauge',
        'route' => 'admin.dashboard',
        'active' => 'admin.dashboard',
        'can' => [],
    ],

    // advance module menu
    [
        'title' => 'Advance Module',
        'icon' => 'fa-solid fa-layer-group',
        'can' => [],

        'children' => [
            [
                'name' => 'Tenant',
                'icon' => 'fa-solid fa-building',
                'route' => 'admin.tenant.index',
                'active' => 'admin.tenant.*',
                'can' => [],
            ],
            [
                'name' => 'Team Members',
                'icon' => 'fa-solid fa-users',
                'route' => 'admin.team.index',
                'active' => 'admin.team.*',
                'can' => [],
            ],
            [
                'name' => 'Roles & Permissions',
                'icon' => 'fa-solid fa-shield-halved',
                'route' => 'admin.role.index',
                'active' => 'admin.role.*',
                'can' => [],
            ],
        ],
    ],

    // blogging module menu
    [
        'title' => 'Blogging',
        'icon' => 'fa-solid fa-blog',
        'can' => [],
        'children' => [
            [
                'name' => 'Catgeory',
                'route' => 'admin.blog-category.index',
                'active' => 'admin.blog-category.*',
                'can' => [],
            ],
            [
                'name' => 'Post',
                'route' => 'admin.blog.index',
                'active' => 'admin.blog.*',
                'can' => [],
            ],
        ],
    ],

    // product module menu
    [
        'title' => 'Products',
        'icon' => 'fa-solid fa-box-open',
        'can' => [],

        'children' => [
            [
                'name' => 'Brands',
                'route' => 'admin.brand.index',
                'active' => 'admin.brand.*',
                'can' => [],
            ],
            [
                'name' => 'Category',
                'route' => 'admin.category.index',
                'active' => 'admin.category.*',
                'can' => [],
            ],
            [
                'name' => 'Product Option',
                'route' => 'admin.options.index',
                'active' => 'admin.options.*',
                'can' => [],
            ],
            [
                'name' => 'Option Value',
                'route' => 'admin.option-value.index',
                'active' => 'admin.option-value.*',
                'can' => [],
            ],
            [
                'name' => 'Products',
                'route' => 'admin.option-value.index',
                'active' => 'admin.option-value.*',
                'can' => [],
            ],
            [
                'name' => 'Low Stock Products',
                'route' => 'admin.option-value.index',
                'active' => 'admin.option-value.*',
                'can' => [],
            ],
        ],
    ],

    // setting module menu
    [
        'title' => 'Setting',
        'icon' => 'fa-solid fa-gear',
        'can' => [],

        'children' => [
            [
                'name' => 'Global',
                'route' => 'admin.setting.edit',
                'active' => 'admin.setting.edit',
                'params' => 'global',
                'can' => [],
            ],
            [
                'name' => 'General',
                'route' => 'admin.setting.edit',
                'active' => 'admin.setting.edit',
                'params' => 'general',
                'can' => [],
            ],
            [
                'name' => 'SEO Config',
                'route' => 'admin.setting.edit',
                'active' => 'admin.setting.edit',
                'params' => 'seo-config',
                'can' => [],
            ],
            [
                'name' => 'Email',
                'route' => 'admin.setting.edit',
                'active' => 'admin.setting.edit',
                'params' => 'email',
                'can' => [],
            ],
        ],
    ],

    // logout menu
    [
        'title' => 'Logout',
        'icon' => 'fa-solid fa-sign-out',
        'route' => 'admin.logout',
        'can' => [],
    ],
];
