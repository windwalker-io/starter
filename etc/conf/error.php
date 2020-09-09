<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use Windwalker\Core\Error\ErrorLogHandler;
use Windwalker\Core\Provider\ErrorHandlingProvider;

return [
    'ini' => [
        'error_reporting' => -1
    ],

    'report_level' => E_ALL | E_STRICT,

    'restore' => false,

    'register_shutdown' => true,

    'log' => true,

    'log_channel' => 'error',

    'providers' => [
        ErrorHandlingProvider::class
    ],

    'factories' => [
        'handlers' => [
            'log' => ErrorLogHandler::class
        ]
    ]
];
