<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use Windwalker\Core\Error\ErrorLogHandler;
use Windwalker\Core\Error\SimpleErrorPageHandler;
use Windwalker\Core\Provider\ErrorHandlingProvider;

use function Windwalker\DI\create;
use function Windwalker\ref;

return [
    'ini' => [
        'error_reporting' => -1
    ],

    'report_level' => E_ALL | E_STRICT,

    'restore' => false,

    'register_shutdown' => true,

    'template' => 'windwalker.error.simple',

    'log' => true,

    'providers' => [
        ErrorHandlingProvider::class
    ],

    'factories' => [
        'handlers' => [
            'default' => create(
                SimpleErrorPageHandler::class,
                [
                    'debug' => ref('system.debug'),
                    'layout' => ref('error.template'),
                ]
            ),
            'log' => create(
                ErrorLogHandler::class,
                options: [
                    'channel' => 'error',
                    'enabled' => ref('log')
                ]
            )
        ]
    ]
];