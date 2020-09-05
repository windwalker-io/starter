<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use Monolog\Handler\StreamHandler;
use Psr\Log\NullLogger;
use Windwalker\Core\Factory\MonologFactory;

use function Windwalker\DI\create;

return [
    'default' => MonologFactory::logger(
        'default',
        [
            MonologFactory::rotatingFileHandler('default'),
        ]
    ),
    'loggers' => [
        'none' => create(NullLogger::class),
        'default' => \Windwalker\ref('di.factories.logs.default'),
    ],
    'handlers' => [
        'stream' => create(StreamHandler::class),
        'rotating' => function ($channel) {
            return MonologFactory::rotatingFileHandler($channel);
        }
    ],
];
