<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Core\Provider\EventProvider;
use Windwalker\Event\EventEmitter;

return [
    'providers' => [
        EventProvider::class
    ],

    'bindings' => [
        EventEmitter::class => EventEmitter::class
    ],

    'factories' => [
        
    ]
];
