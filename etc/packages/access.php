<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Lyrasoft\Luna\Entity\User;
use Lyrasoft\Luna\Subscriber\AdminSessionSubscriber;
use Lyrasoft\Luna\Subscriber\RememberMeSubscriber;
use Lyrasoft\Luna\Subscriber\UserAuthSubscriber;
use Lyrasoft\Luna\User\Handler\UserHandler;
use Lyrasoft\Luna\User\Handler\UserHandlerInterface;
use Lyrasoft\Luna\User\UserService;
use Windwalker\Core\Application\AppContext;

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
