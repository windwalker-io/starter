<?php

declare(strict_types=1);

namespace App\Config;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\PsrLogMessageProcessor;
use Psr\Log\NullLogger;
use Windwalker\Core\Factory\LoggerFactory;
use Windwalker\Core\Provider\LoggerProvider;

use function Windwalker\DI\create;
use function Windwalker\ref;

return [
    'dir' => '',

    'default' => 'default',
    'channels' => [
        'none' => ref('logs.factories.loggers.none'),
        'default' => ref('logs.factories.loggers.default'),
    ],

    'max_files' => env('LOG_MAX_FILES'),

    'global_handlers' => [],
    'global_processors' => [
        PsrLogMessageProcessor::class,
    ],

    'providers' => [
        LoggerProvider::class,
    ],
    'bindings' => [
        //
    ],
    'aliases' => [
        //
    ],
    'factories' => [
        'instances' => [
            'none' => static fn () => create(NullLogger::class),
            'default' => static fn(string $tag) => LoggerFactory::monolog(
                $tag,
                [
                    ref('logs.factories.handlers.rotating'),
                ]
            ),
            'cli-web' => static fn(string $tag) => LoggerFactory::monolog(
                $tag,
                [
                    ref('logs.factories.handlers.stdout'),
                    ref('logs.factories.handlers.rotating'),
                ],
                formatter: 'console_formatter'
            ),
        ],
        'handlers' => [
            'stream' => static fn () => create(StreamHandler::class),
            'rotating' => static fn () => LoggerFactory::rotatingFileHandler(),
            'stdout' => static fn() => new StreamHandler(fopen('php://stdout', 'wb')),
        ],
        'formatters' => [
            'line_formatter' => static fn () => LoggerFactory::lineFormatter(),
            'console_formatter' => static fn () => new LineFormatter(
                format: "[%datetime%] %level_name%: %message% %context%\n",
                dateFormat: 'Y-m-d\TH:i:s',
                allowInlineLineBreaks: true,
                includeStacktraces: true,
            ),
        ],
    ],
];
