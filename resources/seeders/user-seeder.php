<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 LYRASOFT.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Access\AccessService;
use Lyrasoft\Luna\Entity\User;
use Lyrasoft\Luna\Entity\UserRoleMap;
use Lyrasoft\Luna\User\Password;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\EntityMapper;
use Windwalker\ORM\ORM;

use function Windwalker\uid;

/**
 * User Seeder
 *
 * @var Seeder          $seeder
 * @var ORM             $orm
 * @var DatabaseAdapter $db
 */
$seeder->import(
    static function (Password $password, AccessService $accessService) use ($seeder, $orm, $db) {
        $faker = $seeder->faker('en_US');

        /** @var EntityMapper<User> $mapper */
        $mapper = $orm->mapper(User::class);

        $pass = $password->hash('1234');
        $basicRole = $accessService->getBasicRole();

        foreach (range(1, 50) as $i) {
            $item = $mapper->createEntity();

            $item->setName($faker->name());
            $item->setUsername($faker->userName());
            $item->setEmail($faker->safeEmail());
            $item->setPassword($pass);
            $item->setAvatar($faker->avatar(400));
            $item->setEnabled((bool) $faker->randomElement([1, 1, 1, 0]));
            $item->setVerified(true);
            $item->setLastLogin($faker->dateTimeThisYear());
            $item->setRegistered($faker->dateTimeThisYear());

            $item = $mapper->createOne($item);

            $accessService->addRolesToUser($item, $basicRole);

            $seeder->outCounting();
        }
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        $seeder->truncate(User::class);
    }
);
