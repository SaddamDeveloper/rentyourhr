<?php

return [
    'role_structure' => [
        'superadmin' => [
            'dashboard' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'c,r,u,d'
        ],
        'admin' => [
            'dashboard' => 'c,r,u',
            'users' => 'c,r,u',
            'profile' => 'c,r,u'
        ],
        'user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
