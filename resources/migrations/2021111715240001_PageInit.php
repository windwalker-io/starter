<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2021.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Migration;

use App\Entity\Page;
use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\Core\Migration\Migration;
use Windwalker\Database\Schema\Schema;

/**
 * Migration UP: 2021111715240001_PageInit.
 *
 * @var Migration          $mig
 * @var ConsoleApplication $app
 */
$mig->up(
    static function () use ($mig) {
        $mig->createTable(
            Page::class,
            function (Schema $schema) {
                $schema->primary('id')->comment('Primary Key');
                $schema->varchar('extends')->comment('Extends Layout');
                $schema->varchar('title')->comment('Title');
                $schema->varchar('alias')->comment('Alias');
                $schema->json('content')->comment('Page data');
                $schema->longtext('css')->comment('CSS');
                $schema->json('meta')->comment('Metadata');
                $schema->bool('state')->comment('0: unpublished, 1:published');
                $schema->integer('ordering')->comment('Ordering');
                $schema->datetime('created')->comment('Created Date');
                $schema->integer('created_by')->comment('Author');
                $schema->datetime('modified')->comment('Modified Date');
                $schema->integer('modified_by')->comment('Modified User');
                $schema->char('language')->length(7)->comment('Language');
                $schema->char('preview_secret')->length(32);
                $schema->json('params')->comment('Params');

                $schema->addIndex('extends');
                $schema->addIndex('alias');
                $schema->addIndex('language');
                $schema->addIndex('preview_secret');
            }
        );
    }
);

/**
 * Migration DOWN.
 */
$mig->down(
    static function () use ($mig) {
        $mig->dropTables(Page::class);
    }
);
