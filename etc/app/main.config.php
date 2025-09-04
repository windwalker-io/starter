<?php

declare(strict_types=1);

namespace App\Config;

use App\Services\FooService;
use App\Subscriber\FooSubscriber;
use Windwalker\Core\Middleware\RoutingMiddleware;

return array_merge(
    require __DIR__ . '/windwalker.config.php',
    [
        'middlewares' => [
            RoutingMiddleware::class,
        ],

        'listeners' => [
            FooService::class => [
                FooSubscriber::class
            ]
        ],

        'http' => [
            'trusted_proxies' => env('PROXY_TRUSTED_IPS'),
            'trusted_headers' => [
                'x-forwarded-for',
                'x-forwarded-host',
                'x-forwarded-proto',
                'x-forwarded-port',
                'x-forwarded-prefix',
            ]
        ],
    ],
    require __DIR__ . '/../config.php'
);
