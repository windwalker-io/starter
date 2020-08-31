<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Http\Server\HttpServer;
use Windwalker\Http\Server\PhpServer;

use function Windwalker\DI\create;

return [
    'http' => create(
        HttpServer::class,
        ...[
            PhpServer::class => create(PhpServer::class)
        ]
    )
];
