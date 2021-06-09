<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

return [
    'debugger' => [
        'enabled' => env('APP_ENV') === 'dev',

        'listeners' => [
            \Windwalker\Core\Application\AppContext::class => [
                \Windwalker\Debugger\Subscriber\DebuggerSubscriber::class
            ]
        ],

        'providers' => [
            \Windwalker\Debugger\DebuggerPackage::class
        ],

        'cache' => [
            'max_files' => 100
        ]
    ]
];
