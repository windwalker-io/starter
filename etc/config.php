<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Utilities\Arr;

use function Windwalker\include_files;

return Arr::mergeRecursive(
    [
        'app' => include __DIR__ . '/conf/app.php',
        'logs' => include __DIR__ . '/conf/logs.php',
        'error' => include __DIR__ . '/conf/error.php',
        'events' => include __DIR__ . '/conf/events.php',
        'whoops' => include __DIR__ . '/conf/whoops.php',
        'di' => include __DIR__ . '/di.php',
    ]
);
