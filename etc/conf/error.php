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
    'error' => [
        'ini' => [
            'error_reporting' => -1
        ],

        'report_level' => E_ALL | E_STRICT,

        'log' => true,

        'log_channel' => 'error',

        'providers' => [
            ErrorHandlingProvider::class
        ],

        'factories' => [
            'handlers' => [
                ErrorLogHandler::class
            ]
        ]
    ]
];
