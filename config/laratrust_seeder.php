<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'dev' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
            'product' => 'c,r,u,d',
            'role' => 'c,r,u,d',
            'permission' => 'c,r,u,d',
            'role_permission' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'category' => 'c,r,u,d',
            'order' => 'c,r,u,d',
            'order_detail' => 'c,r,u,d',
            'product_category' => 'c,r,u,d',
            'product_image' => 'c,r,u,d',
            'cashier' => 'c,r,u,d',
        ],
        'admin' => [
            'profile' => 'r,u',
            'product' => 'c,r,u,d',
            'category' => 'c,r,u,d',
            'order' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'order_detail' => 'c,r,u,d',
            'product_category' => 'c,r,u,d',
            'product_image' => 'c,r,u,d',
            'cashier' => 'c,r,u,d',
        ],
        'cashier' => [
            'profile' => 'r,u',
            'cashier' => 'c,r,u,d',
            'order' => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
