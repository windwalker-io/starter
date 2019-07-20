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
use Windwalker\DI\Container;

return [
    'handlers' => [
        'default' => Container::meta(function (Container $container, array $args) {
            return new RotatingFileHandler(
                $args['filename'],
                7,
                $args['level']
            );
        })
    ],
    'channels' => [
        'message' => [
            'enabled' => true,
            'level' => LogLevel::INFO,
            'handlers' => [
                MessageHandler::class,
                Container::ref('logs.handlers.default')
            ],
        ],
        'error' => [
            'enabled' => true,
            'level' => LogLevel::ERROR,
            'handlers' => [
                Container::ref('logs.handlers.default')
            ]
        ],
    ]
];
