<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Lyrasoft\Luna\LunaPackage;
use Lyrasoft\Luna\Subscriber\BuildFormFieldSubscriber;
use Lyrasoft\Luna\Subscriber\EntityBuildingSubscriber;

return [
    'luna' => [
        'enabled' => true,

        'providers' => [
            LunaPackage::class
        ],

        'listeners' => [
            EntityBuildingSubscriber::class,
            BuildFormFieldSubscriber::class,
        ]
    ]
];
