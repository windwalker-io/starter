<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Seeder;

use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
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

        //
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        //
    }
);
