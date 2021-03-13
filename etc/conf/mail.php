<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Cache\CachePool;
use Windwalker\Cache\Serializer\PhpSerializer;
use Windwalker\Cache\Serializer\RawSerializer;
use Windwalker\Cache\Storage\FileStorage;
use Windwalker\Cache\Storage\NullStorage;
use Windwalker\Core\Manager\CacheManager;
use Windwalker\Core\Manager\LoggerManager;
use Windwalker\DI\Container;

use function Windwalker\DI\create;

return [
    'enabled' => !env('MAIL_ENABLED'),

    'default' => 'default',

    'providers' => [

    ],

    'bindings' => [
        CacheManager::class,
    ],

    'factories' => [
        'instances' => [
            'default' => ''
        ],
    ],
];
