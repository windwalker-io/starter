<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Psr\Log\NullLogger;
use Windwalker\Core\Manager\LoggerManager;
use Windwalker\Core\Provider\MonologProvider;
use Windwalker\Core\Service\LoggerService;
use Windwalker\DI\Container;

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
            LoggerManager::class,
            LoggerService::class,
        ],
        'aliases' => [
            'logger.manager' => LoggerManager::class,
            'logger.service' => LoggerService::class,
        ],
        'factories' => [
            'instances' => [
                'none' => create(NullLogger::class),
                'default' => function (Container $container, array $args, int $options = 0) {
                    return MonologProvider::logger(
                        $args['_name'],
                        [
                            ref('logs.factories.handlers.rotating'),
                        ]
                    );
                },
            ],
            'handlers' => [
                'stream' => create(StreamHandler::class),
                'rotating' => function (Container $container, array $args, int $options = 0) {
                    $args['filename'] ??= $args[0] ?? $container->getParam('@logs') . '/' . $args['_name'] . '.log';

                    unset($args[0]);

                    return create(RotatingFileHandler::class, ...$args);
                },
            ],
        ],
    ],
];
