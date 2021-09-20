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
use Lyrasoft\Luna\User\Handler\SessionDatabaseHandler;
use Windwalker\Session\Handler\DatabaseHandler;

return [
    'luna' => [
        'enabled' => true,

        'providers' => [
            LunaPackage::class
        ],

        'listeners' => [
            EntityBuildingSubscriber::class,
            BuildFormFieldSubscriber::class,
        ],

        'aliases' => [
            DatabaseHandler::class => SessionDatabaseHandler::class
        ]
    ]
];
