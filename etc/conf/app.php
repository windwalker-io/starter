<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

return [
    'debug' => (bool) (env('APP_DEBUG') ?? false),

    'mode' => env('APP_ENV') ?? 'prod'
];
