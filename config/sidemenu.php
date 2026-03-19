<?php

return [
    [
        'title' => 'Dashboard',
        'icon' => 'fa-solid fa-gauge',
        'route' => 'admin.dashboard',
        'active' => 'admin.dashboard',
        'can' => [],
    ],

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
    [
        'title' => 'Blogging',
        'icon' => 'fa-solid fa-blog',
        'can' => [],
        'children' => [
            [
                'name' => 'Catgeory',
                'route' => 'admin.blog-category.index',
                'active' => 'admin.blog-category.index',
                'can' => [],
            ],
            [
                'name' => 'Post',
                'route' => 'admin.blog.index',
                'active' => 'admin.blog.index',
                'can' => [],
            ],
        ],
    ],

    [
        'title' => 'Members',
        'icon' => 'fa-solid fa-user',
        'url' => '',
        'can' => [],
    ],

    [
        'title' => 'Timeline',
        'icon' => 'fa-solid fa-clock',
        'url' => '',
        'can' => [],
    ],
];
