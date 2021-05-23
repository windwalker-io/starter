<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Seeder;

use App\Entity\Category;
use App\Enum\State;
use App\Module\Admin\Category\CategoryState;
use Unicorn\Utilities\SlugHelper;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\Nested\Position;
use Windwalker\ORM\NestedSetMapper;
use Windwalker\ORM\ORM;

use function Windwalker\chronos;

/**
 * Sakura Seeder
 *
 * @var Seeder          $seeder
 * @var ORM             $orm
 * @var DatabaseAdapter $db
 */
$seeder->import(
    static function () use ($seeder, $orm, $db) {
        $types = [
            'article' => [
                'max_level' => 3,
                'number' => 30,
            ],
        ];
        $faker = $seeder->faker('zh_TW');

        /** @var NestedSetMapper $categoryMapper */
        $categoryMapper = $orm->mapper(Category::class);

        $userIds = range(1, 50);
        $existsRecordIds = [];

        foreach ($types as $type => $detail) {
            $maxLevel = $detail['max_level'];

            $existsRecordIds[$type] = [1];

            foreach (range(1, $detail['number']) as $i) {
                $category = new Category();

                $category->setTitle($faker->sentence(random_int(1, 3)));
                $category->setAlias(SlugHelper::slugify($category->getTitle()));
                $category->setType($type);
                $category->setDescription($faker->paragraph(5));
                $category->setImage($faker->imageUrl());
                $category->setState(
                    $faker->optional(0.7, CategoryState::UNPUBLISHED())
                        ->passthrough(CategoryState::PUBLISHED())
                );
                $category->setCreated(chronos());
                $category->setCreatedBy($faker->randomElement($userIds));
                $category->setModifiedBy($faker->randomElement($userIds));
                $category->setLanguage('en-US');
                $category->setParams(['show_title' => '1']);

                $categoryMapper->setPosition(
                    $category,
                    $faker->randomElement($existsRecordIds[$category->getType()]),
                    Position::LAST_CHILD
                );

                $categoryMapper->createOne($category);
                $categoryMapper->rebuildPath($category);

                if ($category->getLevel() < $maxLevel) {
                    $existsRecordIds[$category->getType()][] = $category->getId();
                }

                $seeder->outCounting();
            }
        }
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        $seeder->truncate(Category::class);
    }
);
