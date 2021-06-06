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
        'enabled' => true,

        'listeners' => [
        ],

        'providers' => [
            \Windwalker\Debugger\DebuggerPackage::class
        ],
    ]
];
