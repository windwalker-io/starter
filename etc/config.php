<?php

use Windwalker\Utilities\Arr;

return Arr::mergeRecursive(
    // Load as global
    // require __DIR . '/conf/file.php',

    // Load with namespace
    [
        'dev'      => require __DIR__ . '/conf/dev.php',
        'system'   => require __DIR__ . '/conf/system.php',
        'logs'     => require __DIR__ . '/conf/logs.php',
        'error'    => require __DIR__ . '/conf/error.php',
        'database' => require __DIR__ . '/conf/database.php',
        'session'  => require __DIR__ . '/conf/session.php',
        'routing'  => require __DIR__ . '/conf/routing.php',
        'cache'    => require __DIR__ . '/conf/cache.php',
        'crypt'    => require __DIR__ . '/conf/crypt.php',
        'asset'    => require __DIR__ . '/conf/asset.php',
        'language' => require __DIR__ . '/conf/language.php',
        'console'  => require __DIR__ . '/conf/console.php',
        'mail'     => require __DIR__ . '/conf/mail.php',
        'queue'    => require __DIR__ . '/conf/queue.php',
    ],

    // Load custom values
    is_file(__DIR__ . '/conf/custom.php') ? require __DIR__ . '/conf/custom.php' : []
);
