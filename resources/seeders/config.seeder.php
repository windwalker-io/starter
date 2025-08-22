<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\Config;
use Lyrasoft\Luna\Entity\User;
use Windwalker\Core\Seed\AbstractSeeder;
use Windwalker\Core\Seed\SeedClear;
use Windwalker\Core\Seed\SeedImport;
use Windwalker\ORM\EntityMapper;

return new /** Config Seeder */ class extends AbstractSeeder {
    #[SeedImport]
    public function import(): void
    {
        $faker = $this->faker();

        /** @var EntityMapper<Config> $mapper */
        $mapper = $this->orm->mapper(Config::class);
        $userIds = $this->orm->mapper(User::class)->findColumn('id')->dump();

        $item = $mapper->createEntity();

        $item->type = 'core';
        $item->content = ['ga' => ''];
        $item->modified = $faker->dateTimeThisYear();
        $item->modifiedBy = (int) $faker->randomElement($userIds);

        $mapper->createOne($item);

        $this->printCounting();
    }

    #[SeedClear]
    public function clear(): void
    {
        $this->truncate(Config::class);
    }
};
