<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\Page;
use Lyrasoft\Luna\Entity\User;
use Windwalker\Core\Seed\AbstractSeeder;
use Windwalker\Core\Seed\SeedClear;
use Windwalker\Core\Seed\SeedImport;
use Windwalker\ORM\EntityMapper;

return new /** Page Seeder */ class extends AbstractSeeder {
    #[SeedImport]
    public function import(): void
    {
        $faker = $this->faker('en_US');

        $userIds = $this->orm->findColumn(User::class, 'id', [])->dump();
        /** @var EntityMapper<Page> $mapper */
        $mapper = $this->orm->mapper(Page::class);

        $content = json_decode(file_get_contents(__DIR__ . '/data/page.json'), true);

        foreach (range(1, 50) as $i) {
            $item = $mapper->createEntity();

            $item->extends = 'global.body';
            $item->title = $faker->sentence(2);
            $item->image = $faker->unsplashImage(800, 600);
            $item->content = $content;
            $item->state = 1;
            $item->ordering = $i;
            $item->created = $created = $faker->dateTimeThisYear;
            $item->modified = $created->modify('+1month');
            $item->createdBy = (int) $faker->randomElement($userIds);
            $item->modifiedBy = (int) $faker->randomElement($userIds);

            $mapper->createOne($item);

            $this->printCounting();
        }
    }

    #[SeedClear]
    public function clear(): void
    {
        $this->truncate(Page::class);
    }
};
