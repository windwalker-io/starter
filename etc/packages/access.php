<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2021 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

use Lyrasoft\Luna\Access\AccessService;

use function Lyrasoft\Luna\create_role;

return [
    'access' => [
        'enabled' => true,

        'roles' => [
            'superuser' => create_role(
                'Super User',
            ),
            'public' => create_role(
                'Public',
                children: [
                    'registered' => create_role(
                        'Registered'
                    ),
                    'manager' => create_role(
                        'Manager',
                        children: [
                            'admin' => create_role(
                                'admin',
                                'Admin'
                            )
                        ]
                    ),
                ]
            ),
        ],

        'actions' => [
            AccessService::ADMIN_ACCESS_ACTION => [
                'manager' => true
            ],

            AccessService::SUPERUSER_ACTION => [
                'superuser' => true
            ],

            'create' => [
                'manager' => true
            ],

            'edit' => [
                'manager' => true
            ],

            'delete' => [
                'manager' => true
            ],
        ]
    ]
];
