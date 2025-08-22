<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Access\AccessService;
use Lyrasoft\Luna\Entity\User;
use Windwalker\Core\Seed\SeedClear;
use Windwalker\Core\Seed\AbstractSeeder;
use Windwalker\Core\Seed\SeedImport;
use Windwalker\Crypt\Hasher\PasswordHasherInterface;
use Windwalker\ORM\EntityMapper;

return new /** Article Seeder */ class extends AbstractSeeder {
    #[SeedImport]
    public function import(PasswordHasherInterface $password, AccessService $accessService): void
    {
        $faker = $this->faker('en_US');

        /** @var EntityMapper<User> $mapper */
        $mapper = $this->orm->mapper(User::class);

        $pass = $password->hash('1234');
        $basicRoles = $accessService->getBasicRoles();

        foreach (range(1, 50) as $i) {
            $item = $mapper->createEntity();

            $item->name = $faker->name();
            $item->username = $faker->userName();
            $item->email = $faker->safeEmail();
            $item->password = $pass;
            $item->avatar = $faker->avatar(400);
            $item->enabled = (bool) $faker->randomElement([1, 1, 1, 0]);
            $item->verified = true;
            $item->lastLogin = $faker->dateTimeThisYear();
            $item->registered = $faker->dateTimeThisYear();

            $item = $mapper->createOne($item);

            $accessService->addRolesToUser($item, $basicRoles);

            $this->printCounting();
        }
    }

    #[SeedClear]
    public function clear(): void
    {
        $this->truncate(User::class);
    }
};
