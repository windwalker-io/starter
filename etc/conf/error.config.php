<?php

declare(strict_types=1);

namespace App\Config;

use Windwalker\Core\Application\AppType;
use Windwalker\Core\Error\ErrorLogHandler;
use Windwalker\Core\Error\SimpleErrorPageHandler;
use Windwalker\Core\Provider\ErrorHandlingProvider;
use Windwalker\DI\Container;

use function Windwalker\DI\create;
use function Windwalker\ref;

$errorReporting = include __DIR__ . '/error-reporting.config.php';

return [
    /*
     * --------------------------------------------------------------------------
     * Php.ini Configurations
     * --------------------------------------------------------------------------
     * Windwalker will use ini_set() to configure PHP by these settings.
     * All values should be **STRING**.
     */
    'ini' => [
        'display_errors' => 'on',
        'error_reporting' => (string) (WINDWALKER_DEBUG ? E_ALL : $errorReporting),
    ],

    /*
     * --------------------------------------------------------------------------
     * Error Report Level
     * --------------------------------------------------------------------------
     * PHP Error Levels to show error page and stop running.
     * Please see ./error-reporting.php file to configure reporting levels.
     * If the php.ini error_reporting set to E_ALL and some error level set to false here,
     * it will only show error text on web page but won't show error page.
     */
    'report_level' => env('ERROR_REPORT_LEVEL') ?? $errorReporting,

    /*
     * --------------------------------------------------------------------------
     * Restore Error Handler
     * --------------------------------------------------------------------------
     * Restore default error / exception handlers before register
     * framework error handlers.
     */
    'restore' => false,

    /*
     * --------------------------------------------------------------------------
     * Register shutdown handler
     * --------------------------------------------------------------------------
     * Register the shutdown handler to catch errors if PHP unexpectedly stop.
     */
    'register_shutdown' => true,

    'template' => 'layout.error.default',

    'log' => true,

    'log_channel' => 'error',

    'providers' => [
        ErrorHandlingProvider::class
    ],

    'handlers' => [
        AppType::WEB->name => [
            'default' => ref('error.factories.handlers.default'),
            'log' => ref('error.factories.handlers.log'),
        ],
        AppType::CONSOLE->name => [
            'default' => ref('error.factories.handlers.console_log'),
        ],
        AppType::CLI_WEB->name => [
            'default' => ref('error.factories.handlers.default'),
            'log' => ref('error.factories.handlers.log'),
        ]
    ],

    'deprecation_handlers' => [
        AppType::WEB->name => [],
        AppType::CONSOLE->name => [],
        AppType::CLI_WEB->name => [],
        'all' => [
            'deprecation' => ref('error.factories.handlers.deprecation')
        ]
    ],

    'factories' => [
        'handlers' => [
            'default' => static fn () => create(
                SimpleErrorPageHandler::class,
                options: static fn(Container $container) => [
                    'debug' => $container->getParam('system.debug'),
                    'layout' => $container->getParam('error.template'),
                ]
            ),
            'log' => static fn () => create(
                ErrorLogHandler::class,
                options: static fn(Container $container) => [
                    'channel' => 'error',
                    'enabled' => $container->getParam('error.log')
                ]
            ),
            'console_log' => static fn () => create(
                ErrorLogHandler::class,
                options: static fn(Container $container) => [
                    'channel' => 'console-error',
                    'enabled' => $container->getParam('error.log'),
                    'ignore_40x' => false
                ]
            ),
            'deprecation' => static fn () => create(
                ErrorLogHandler::class,
                options: static fn(Container $container) => [
                    'channel' => 'system/deprecations',
                    'enabled' => $container->getParam('error.log'),
                    'ignore_40x' => false,
                    'backtraces' => false,
                    'print' => false,
                ]
            ),
        ]
    ]
];
