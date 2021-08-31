<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Lyrasoft\Luna\Entity\User;
use Lyrasoft\Luna\Subscriber\AdminSessionSubscriber;
use Lyrasoft\Luna\Subscriber\RememberMeSubscriber;
use Lyrasoft\Luna\Subscriber\UserAuthSubscriber;
use Lyrasoft\Luna\User\Handler\UserHandler;
use Lyrasoft\Luna\User\Handler\UserHandlerInterface;
use Lyrasoft\Luna\User\UserService;
use Windwalker\Core\Application\AppContext;

return [
    'user' => [
        'enabled' => true,

        'login_name' => 'username',

        'remember_expires' => '+100days',

        'entity' => User::class,

        'bindings' => [
            UserHandlerInterface::class => UserHandler::class
        ],

        'listeners' => [
            AppContext::class => AdminSessionSubscriber::class,

            UserService::class => [
                UserAuthSubscriber::class,
                RememberMeSubscriber::class
            ]
        ],

        'providers' => [
            //
        ]
    ]
];
