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
    include_files(__DIR__ . '/conf/*.php'),
    [
        'di' => include __DIR__ . '/di.php',
    ]
);
