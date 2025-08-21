<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\Page;
use Lyrasoft\Luna\Entity\User;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\EntityMapper;
use Windwalker\ORM\ORM;

/**
 * Page Seeder
 *
 * @var Seeder          $seeder
 * @var ORM             $orm
 * @var DatabaseAdapter $db
 */
$seeder->import(
    static function () use ($seeder, $orm, $db) {
        $faker = $seeder->faker('en_US');

        $userIds = $orm->findColumn(User::class, 'id', [])->dump();
        /** @var EntityMapper<Page> $mapper */
        $mapper = $orm->mapper(Page::class);

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

            $seeder->outCounting();
        }
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        $seeder->truncate(Page::class);
    }
);
