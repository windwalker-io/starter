<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Lyrasoft\Luna\Entity\User;
use Lyrasoft\Luna\User\Handler\UserHandler;
use Lyrasoft\Luna\User\Handler\UserHandlerInterface;

return [
    'user' => [
        'enabled' => true,

        'login_name' => 'username',

        'entity' => User::class,

        'bindings' => [
            UserHandlerInterface::class => UserHandler::class
        ],

        'providers' => [
            //
        ]
    ]
];
