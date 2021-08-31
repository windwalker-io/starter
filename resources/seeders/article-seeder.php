<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\Category;
use Lyrasoft\Luna\Entity\Article;
use Lyrasoft\Luna\Entity\User;
use Unicorn\Utilities\SlugHelper;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\EntityMapper;
use Windwalker\ORM\ORM;
use Windwalker\Utilities\Utf8String;

/**
 * Article Seeder
 *
 * @var Seeder          $seeder
 * @var ORM             $orm
 * @var DatabaseAdapter $db
 */
$seeder->import(
    static function () use ($seeder, $orm, $db) {
        $faker = $seeder->faker('en_US');
        $type = 'article';

        /** @var EntityMapper<Article> $mapper */
        $mapper = $orm->mapper(Article::class);
        $categoryIds = $orm->findColumn(Category::class, 'id', ['type' => $type])->dump();
        $userIds = $orm->findColumn(User::class, 'id')->dump();

        foreach (range(1, 150) as $i) {
            $item = $mapper->createEntity();

            $item->setCategoryId((int) $faker->randomElement($categoryIds));
            $item->setType($type);
            $item->setTitle(
                Utf8String::ucwords(
                    trim($faker->sentence(3), '.')
                )
            );
            $item->setAlias(SlugHelper::safe($item->getTitle()));
            $item->setImage($faker->unsplashImage(800, 600));
            $item->setState($faker->optional(0.7, 0)->passthrough(1));
            $item->setIntrotext($faker->paragraph(5));
            $item->setFulltext($faker->paragraph(20));
            $item->setOrdering($i);
            $item->setCreated($faker->dateTimeThisYear());
            $item->setModified($item->getCreated()->modify('+10days'));
            $item->setCreatedBy((int) $faker->randomElement($userIds));

            $item = $mapper->createOne($item);

            $seeder->outCounting();
        }
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        //
    }
);
