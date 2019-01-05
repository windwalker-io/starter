<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

return [
    // Enable debug mode, will disable cache, and log some errors.
    'debug' => (bool) (env('SYSTEM_DEBUG') ?? false),

    // The PHP error reporting level, 0 is hide all errors, -1 is the biggest report level.
    'error_reporting' => env('SYSTEM_ERROR_REPORTING') ?? 0,

    // Default system timezone.
    'timezone' => env('SYSTEM_TIMEZONE') ?? 'UTC',

    // Set system offline
    'offline' => (bool) (env('SYSTEM_OFFLINE') ?? false),

    // Secret code will be a salt to generate hashs when system running,
    // Will be replace when Windwalker installation.
    'secret' => 'This-token-is-not-safe'
];
