<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use Monolog\Handler\StreamHandler;
use Psr\Log\NullLogger;
use Windwalker\Core\Manager\LoggerManager;
use Windwalker\Core\Provider\MonologProvider;

use function Windwalker\DI\create;
use function Windwalker\ref;

return [
    'logs' => [
        'dir' => '',

        'default' => 'default',
        'channels' => [
            'none' => ref('logs.factories.loggers.none'),
            'default' => ref('logs.factories.loggers.default'),
        ],
        'providers' => [
            //
        ],
        'bindings' => [
            LoggerManager::class
        ],
        'aliases' => [
            'logger.manager' => LoggerManager::class
        ],
        'factories' => [
            'default' => MonologProvider::logger(
                'default',
                [
                    MonologProvider::rotatingFileHandler('default'),
                ]
            ),
            'instances' => [
                'none' => create(NullLogger::class),
                'default' => ref('logs.factories.default'),
            ],
            'handlers' => [
                'stream' => create(StreamHandler::class),
                'rotating' => function ($channel) {
                    return MonologProvider::rotatingFileHandler($channel);
                }
            ],
        ]
    ]
];
