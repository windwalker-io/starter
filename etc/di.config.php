<?php

declare(strict_types=1);

namespace App\Config;

use Windwalker\Utilities\Arr;

use function Windwalker\include_arrays;

return Arr::mergeRecursive(
    // Load with namespace,
    [
        'factories' => include_arrays(__DIR__ . '/di/*.php'),
        'providers' => [
            //
        ],
        'bindings' => [
            //
        ],
        'aliases' => [
            //
        ],
        'layouts' => [
            //
        ],
        'attributes' => [
            //
        ]
    ]
);
