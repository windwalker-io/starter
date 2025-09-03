<?php

declare(strict_types=1);

namespace App\Config;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ConfigModule;
use Windwalker\Debugger\DebuggerPackage;
use Windwalker\Debugger\Subscriber\DebuggerSubscriber;

return #[ConfigModule(name: 'debugger', enabled: true, priority: 100, env: 'dev')]
static fn() => [
    'editor' => env('DEBUGGER_EDITOR', 'phpstorm'),

    'profiler_disabled' => false,

    'listeners' => [
        AppContext::class => [
            DebuggerSubscriber::class,
        ],
    ],

    'providers' => [
        DebuggerPackage::class,
    ],

    'cache' => [
        'max_files' => 100,
    ],
];
