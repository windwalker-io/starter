<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Utilities\Arr;

use function Windwalker\include_files;

return Arr::mergeRecursive(
    // Load with namespace,
    [
        'factories' => include_files(__DIR__ . '/di/factories/*.php'),
        'providers' => include __DIR__ . '/di/providers.php',
        'binding' => include __DIR__ . '/di/bindings.php',
        'aliases' => include __DIR__ . '/di/aliases.php',
    ]
);
