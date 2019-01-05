<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

return [
    'driver' => env('DATABASE_DRIVER') ?? 'mysql',
    'host' => env('DATABASE_HOST') ?? 'localhost',
    'user' => env('DATABASE_USER') ?? 'root',
    'password' => env('DATABASE_PASSWORD'),
    'name' => env('DATABASE_NAME') ?? 'db_name',
    'prefix' => env('DATABASE_PREFIX') ?? 'wind_'
];
