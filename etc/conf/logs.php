<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use Monolog\Handler\RotatingFileHandler;
use Psr\Log\LogLevel;
use Windwalker\Core\Logger\Monolog\MessageHandler;

return [
    'channels' => [
        'message' => [
            'enabled' => true,
            'level' => LogLevel::INFO,
            'handlers' => [
                MessageHandler::class,
                [
                    'class' => RotatingFileHandler::class,
                    'file_argument' => 'filename',
                    'args' => [
                        'maxFiles' => 7
                    ]
                ],
            ],
        ],
        'error' => [
            'enabled' => true,
            'level' => LogLevel::ERROR,
            'handlers' => [
                'class' => RotatingFileHandler::class,
                'file_argument' => 'filename',
                'args' => [
                    'maxFiles' => 7
                ]
            ]
        ],
    ]
];
