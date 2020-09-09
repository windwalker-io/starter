<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Core\Manager\DatabaseManager;
use Windwalker\Database\DatabaseAdapter;

use Windwalker\DI\Container;

use function Windwalker\DI\create;
use function Windwalker\ref;

return [
    'default' => 'local',

    'connections' => [
        'local' => ref('factories.instances.local'),
    ],

    'providers' => [

    ],

    'bindings' => [
        DatabaseManager::class,
        DatabaseAdapter::class => fn(Container $container) => $container->get(DatabaseManager::class)->get()
    ],

    'factories' => [
        'instances' => [
            'local' => create(
                DatabaseAdapter::class,
                [
                    'driver'   => env('DATABASE_DRIVER'),
                    'host'     => env('DATABASE_HOST') ?: 'localhost',
                    'database' => env('DATABASE_NAME'),
                    'username' => env('DATABASE_USER'),
                    'password' => env('DATABASE_PASSWORD'),
                    'port'     => env('DATABASE_PORT'),
                    'prefix'   => env('DATABASE_TABLE_PREFIX'),
                ]
            ),
        ],
    ],
];
