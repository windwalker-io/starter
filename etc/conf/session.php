<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

return [
    // Session handler, supports `native`, `database`, `apc`, `memcached`
    'handler' => env('SESSION_HANDLER') ?: 'native',

    // By minutes
    'expire_time' => (int) env('SESSION_EXPIRE_TIME', 150),

    'cookie_path' => env('SESSION_COOKIE_PATH', '/'),

    // Session database options
    'database' => [
        'table' => 'sessions'
    ]
];
