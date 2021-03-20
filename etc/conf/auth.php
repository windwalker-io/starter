<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Core\Auth\Method\DatabaseMethod;
use Windwalker\Core\Provider\AuthProvider;

use function Windwalker\DI\create;
use function Windwalker\ref;

return [
    'providers' => [
        AuthProvider::class,
    ],

    'authentication' => [
        'methods' => [
            'database' => ref('auth.factories.methods.database'),
        ]
    ],

    'authorization' => [
        'policies' => [
            //
        ]
    ],

    'bindings' => [
        //
    ],

    'factories' => [
        'methods' => [
            'database' => create(
                DatabaseMethod::class,
                options: [
                    'table' => 'users',
                    'login_name' => 'username'
                ]
            )
        ]
    ]
];
