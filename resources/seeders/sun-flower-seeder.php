<?php

/**
 * Part of starter project.
 *
 * @copyright    Copyright (C) 2021 __ORGANIZATION__.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Seeder;

use App\Entity\SunFlower;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\ORM;

/**
 * SunFlower Seeder
 *
 * @var  Seeder          $seeder
 * @var  ORM             $orm
 * @var  DatabaseAdapter $db
 */
$seeder->import(
    static function () use ($seeder, $orm, $db) {
        $faker = $seeder->faker('en_US');

        $mapper = $orm->mapper(SunFlower::class);

        foreach (range(1, 50) as $i) {
            $item = new SunFlower();
            $item->setTitle($faker->sentence(2));
            $item->setCategoryId(11);
            $item->setState(1);
            $item->setContent($faker->paragraph(5));
            $item->setImage($faker->imageUrl());
            $item->setAttachments(
                [
                    'url' => $faker->imageUrl()
                ]
            );
            $item->setCreated($faker->dateTimeThisYear());
            $item->setCreatedBy(1);
            $item->setModified($faker->dateTimeThisMonth());
            $item->setCreatedBy(4);

            $mapper->createOne($item);

            $seeder->outCounting();
        }
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        $seeder->truncate(SunFlower::class);
    }
);
