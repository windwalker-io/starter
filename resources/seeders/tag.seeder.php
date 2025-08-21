<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\Tag;
use Lyrasoft\Luna\Entity\TagMap;
use Lyrasoft\Luna\Entity\User;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\EntityMapper;
use Windwalker\ORM\ORM;
use Windwalker\Utilities\Utf8String;

/**
 * Tag Seeder
 *
 * @var Seeder          $seeder
 * @var ORM             $orm
 * @var DatabaseAdapter $db
 */
$seeder->import(
    static function () use ($seeder, $orm, $db) {
        $faker = $seeder->faker('en_US');

        $userIds = $orm->findColumn(User::class, 'id', [])->dump();
        /** @var EntityMapper<Tag> $mapper */
        $mapper = $orm->mapper(Tag::class);

        foreach (range(1, 30) as $i) {
            $item = $mapper->createEntity();

            $item->title = Utf8String::ucfirst($faker->word);
            $item->state = 1;
            $item->created = $created = $faker->dateTimeThisYear;
            $item->modified = $created->modify('+10days');
            $item->createdBy = (int) $faker->randomElement($userIds);
            $item->modifiedBy = (int) $faker->randomElement($userIds);

            $mapper->createOne($item);

            $seeder->outCounting();
        }
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        $seeder->truncate(Tag::class, TagMap::class);
    }
);
