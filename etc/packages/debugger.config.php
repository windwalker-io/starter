<?php

declare(strict_types=1);

namespace App\Config;

use Windwalker\Core\Attributes\ConfigModule;

return #[ConfigModule(name: 'debugger', enabled: true, priority: 100, env: 'dev')]
static fn() => [
    'editor' => env('DEBUGGER_EDITOR', 'phpstorm'),

    'profiler_disabled' => false,

    'listeners' => [
        \Windwalker\Core\Application\AppContext::class => [
            \Windwalker\Debugger\Subscriber\DebuggerSubscriber::class,
        ],
    ],

    'providers' => [
        \Windwalker\Debugger\DebuggerPackage::class,
    ],

    'cache' => [
        'max_files' => 100,
    ],
];
