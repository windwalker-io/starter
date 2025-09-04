<?php

declare(strict_types=1);

namespace App\Config;

use function Windwalker\include_arrays;

return array_merge(
    [
        'app'      => include __DIR__ . '/conf/app.config.php',
        'asset'    => include __DIR__ . '/conf/asset.config.php',
        'auth'     => include __DIR__ . '/conf/auth.config.php',
        'company'  => include __DIR__ . '/conf/company.config.php',
        'logs'     => include __DIR__ . '/conf/logs.config.php',
        'error'    => include __DIR__ . '/conf/error.config.php',
        'whoops'   => include __DIR__ . '/conf/whoops.config.php',
        'events'   => include __DIR__ . '/conf/events.config.php',
        'mail'     => include __DIR__ . '/conf/mail.config.php',
        'routing'  => include __DIR__ . '/conf/routing.config.php',
        'security' => include __DIR__ . '/conf/security.config.php',
        // 'queue' => include __DIR__ . '/conf/queue.config.php',

        'di' => include __DIR__ . '/di.config.php',
    ],

    include_arrays(__DIR__ . '/packages/*.php'),

    // Load custom values
    is_file(__DIR__ . '/conf/custom.config.php') ? require __DIR__ . '/conf/custom.config.php' : []
);
