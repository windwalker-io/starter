<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Utilities\Arr;

return Arr::mergeRecursive(
    // Load with namespace,
    [
        'server' => include __DIR__ . '/di/server.php',
        'logs' => include __DIR__ . '/di/logs.php',
    ]
);
