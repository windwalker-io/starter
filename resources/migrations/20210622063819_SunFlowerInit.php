<?php

/**
 * Part of Windwalker project.
 *
 * @copyright    Copyright (C) 2021.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Migration;

use App\Entity\SunFlower;
use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\Core\Migration\Migration;
use Windwalker\Database\Schema\Schema;

/**
 * Migration UP: 20210622063819_SunFlowerInit.
 *
 * @var  Migration          $mig
 * @var  ConsoleApplication $app
 */
$mig->up(
    static function () use ($mig) {
        $mig->createTable(SunFlower::class, function (Schema $schema) {
            $schema->primary('id');
            $schema->integer('category_id');
            $schema->varchar('title');
            $schema->tinyint('state');
            $schema->varchar('alias');
            $schema->varchar('image');
            $schema->text('attachments');
            $schema->text('content');
            $schema->datetime('created')->nullable(true);
            $schema->integer('created_by');
            $schema->datetime('modified')->nullable(true);
            $schema->integer('modified_by');
            $schema->json('params')->nullable(true);

            $schema->addIndex('category_id');
        });
    }
);

/**
 * Migration DOWN.
 */
$mig->down(
    static function () use ($mig) {
        $mig->dropTables(SunFlower::class);
    }
);
