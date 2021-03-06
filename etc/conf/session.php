<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Ref;
use Windwalker\Core\Provider\SessionProvider;
use Windwalker\Core\Runtime\Config;
use Windwalker\Session\Bridge\NativeBridge;
use Windwalker\Session\Bridge\PhpBridge;
use Windwalker\Session\Cookie\ArrayCookies;
use Windwalker\Session\Cookie\CallbackCookies;
use Windwalker\Session\Cookie\Cookies;
use Windwalker\Session\Handler\ArrayHandler;
use Windwalker\Session\Handler\DatabaseHandler;
use Windwalker\Session\Handler\FilesystemHandler;
use Windwalker\Session\Handler\NativeHandler;
use Windwalker\Session\Handler\RedisHandler;
use Windwalker\Session\Session;

use function Windwalker\DI\create;
use function Windwalker\ref;

return [
    'default' => env('SESSION_DEFAULT') ?: 'native',

    'cookie_params' => [
        'expires' => time() + 15,
        'path' => '/',
        'domain' => null,
        'secure' => false,
        'httponly' => true,
        'samesite' => Cookies::SAMESITE_LAX
    ],

    'providers' => [
        SessionProvider::class,
    ],

    'bindings' => [
        //
    ],

    'factories' => [
        'instances' => [
            'native' => create(
                Session::class,
                options: [],
                bridge: ref('session.factories.bridges.native'),
                cookies: ref('session.factories.cookies.request')
            ),
        ],
        'bridges' => [
            'native' => create(
                NativeBridge::class,
                options: [],
                handler: ref('session.factories.handlers.native')
            ),
            'php' => create(
                PhpBridge::class,
                options: [],
                handler: ref('session.factories.handlers.native')
            )
        ],
        'handlers' => [
            'array' => create(ArrayHandler::class),
            'native' => create(NativeHandler::class),
            'database' => create(
                DatabaseHandler::class,
                db: ref('database.connections.local'),
                options: []
            ),
            'filesystem' => create(
                FilesystemHandler::class,
                path: null,
                options: []
            ),
            'redis' => create(RedisHandler::class)
        ],
        'cookies' => [
            'request' => create(SessionProvider::psrCookies()),
            'native' => create(Cookies::class),
        ]
    ],
];
