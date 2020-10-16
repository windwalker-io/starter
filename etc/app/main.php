<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Utilities\Arr;

return Arr::mergeRecursive(
    require __DIR__ . '/windwalker.php',
    [
        'middlewares' => [
            \Windwalker\Core\Middleware\RoutingMiddleware::class
        ],

        'listeners' => [

        ]
    ],
    require __DIR__ . '/../config.php'
);
