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
    'channels' => [
        'message' => [
            'enabled' => true,
            'level' => LogLevel::INFO,
            'handlers' => [
                MessageHandler::class,
                Container::meta(function (Container $container, array $args) {
                    return new RotatingFileHandler(
                        $args['filename'],
                        7,
                        $args['level']
                    );
                })
            ],
        ],
        'error' => [
            'enabled' => true,
            'level' => LogLevel::ERROR,
            'handlers' => [
                Container::meta(function (Container $container, array $args) {
                    return new RotatingFileHandler(
                        $args['filename'],
                        7,
                        $args['level']
                    );
                })
            ]
        ],
    ]
];
