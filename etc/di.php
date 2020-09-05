<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Utilities\Arr;

use function Windwalker\load_configs;

return Arr::mergeRecursive(
    // Load with namespace,
    [
        'factories' => load_configs(__DIR__ . '/di/factories/*', true),
        'providers' => include __DIR__ . '/di/providers.php',
        'binding' => include __DIR__ . '/di/binding.php',
        'aliases' => include __DIR__ . '/di/aliases.php',
    ]
);
