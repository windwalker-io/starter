<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2021.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Migration;

use Lyrasoft\Luna\Entity\Session;
use Lyrasoft\Luna\Entity\User;
use Lyrasoft\Luna\Entity\UserSocial;
use Lyrasoft\Luna\User\UserService;
use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\Core\Migration\Migration;
use Windwalker\Database\Schema\Schema;

use Windwalker\ORM\ORM;

use function Windwalker\chronos;
use function Windwalker\now;

/**
 * Migration UP: 20210828063500_UserInit.
 *
 * @var Migration          $mig
 * @var ConsoleApplication $app
 */

// Workaround before WebProvider merge to main process in CLI
$app->prepareWebSimulator();

$mig->up(
    static function (UserService $userService, ORM $orm) use ($mig) {
        $userEntity = $userService->getUserEntityClass();

        // User
        $mig->createTable(
            $userEntity,
            function (Schema $schema) {
                $schema->primary('id');
                $schema->varchar('username')->comment('Username');
                $schema->varchar('email')->comment('Email');
                $schema->varchar('name')->comment('Name');
                $schema->varchar('avatar')->comment('Avatar');
                $schema->varchar('password')->comment('Password');
                $schema->tinyint('enabled')->comment('0: disabled, 1: enabled');
                $schema->tinyint('verified')->comment('0: unverified, 1: verified');
                $schema->varchar('activation')->comment('Activation code.');
                $schema->tinyint('receive_mail')->defaultValue(0)->length(1);
                $schema->varchar('reset_token')->comment('Reset Token');
                $schema->datetime('last_reset')->nullable(true)->comment('Last Reset Time');
                $schema->datetime('last_login')->nullable(true)->comment('Last Login Time');
                $schema->datetime('registered')->nullable(true)->comment('Register Time');
                $schema->datetime('modified')->nullable(true)->comment('Modified Time');
                $schema->json('params')->comment('Params');

                $schema->addIndex('username');
                $schema->addIndex('email');
            }
        );

        // User Social
        $mig->createTable(
            UserSocial::class,
            function (Schema $schema) {
                $schema->integer('user_id')->comment('User ID');
                $schema->varchar('identifier')->comment('User identifier name');
                $schema->char('provider')->length(20)->comment('Social provider');
                $schema->json('params')->comment('Params');

                $schema->addIndex('user_id');
                $schema->addIndex('identifier');
            }
        );

        // Session
        $mig->createTable(
            Session::class,
            function (Schema $schema) {
                $schema->varchar('id')->length(192);
                $schema->text('data');
                $schema->integer('user_id');
                $schema->integer('time');

                $schema->addUniqueKey('id');
                $schema->addIndex('user_id');
                $schema->addIndex('time');
            }
        );

        /** @var User $user */
        $user = $userService->createUserEntity();

        $user->setUsername('admin');
        $user->setEmail('webadmin@simular.co');
        $user->setName('Simular');
        $user->setPassword(password_hash('1234', PASSWORD_DEFAULT));
        $user->setAvatar('https://avatars.githubusercontent.com/u/13175487#.jpg');
        $user->setEnabled(true);
        $user->setVerified(true);
        $user->setReceiveMail(true);

        $orm->createOne($userEntity, $user);
    }
);

/**
 * Migration DOWN.
 */
$mig->down(
    static function () use ($mig) {
        $mig->dropTables(
            User::class,
            UserSocial::class,
            Session::class
        );
    }
);
