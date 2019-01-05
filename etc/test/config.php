<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use Windwalker\Utilities\Arr;

return Arr::mergeRecursive(
    [
        'system' => [
            'debug' => true,
            'error_reporting' => -1,
            'offline' => false,
        ],

        'cache' => [
            'enabled' => false,
        ],

        'language' => [
            'debug' => true,
        ],

        'whoops' => [
            'editor' => env('WHOOPS_EDITOR') ?? 'phpstorm'
        ]
    ]
);
