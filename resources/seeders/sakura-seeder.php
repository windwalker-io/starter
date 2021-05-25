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
use App\Entity\Sakura;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
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
        $faker = $seeder->faker('zh_TW');

        $categoryIds = $orm->from(Category::class)
            ->where('id', '!=', 1)
            ->loadColumn('id')
            ->values();

        foreach (range(1, 50) as $i) {
            $item = new Sakura();
            $item->setTitle($faker->sentence());
            $item->setContent($faker->paragraph());
            $item->setCategoryId((int) $faker->randomElement($categoryIds));
            $item->setCreated(chronos());
            $item->setOrdering($i);

            $orm->saveOne(Sakura::class, $item);

            $seeder->outCounting();
        }
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        //
    }
);
