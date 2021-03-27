<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2021 LYRASOFT.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Migration;

use App\Entity\Category;
use Windwalker\Core\Migration\Migration;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\Database\Schema\Schema;
use Windwalker\ORM\NestedSetMapper;
use Windwalker\ORM\ORM;

/**
 * Migration UP: 20210327181629_CategoryInit.
 *
 * @var Migration       $mig
 * @var DatabaseAdapter $db
 * @var ORM             $orm
 */
$mig->up(
    static function () use ($orm, $mig) {
        $mig->createTable(Category::class, function (Schema $schema) {
            $schema->primary('id')->comment('Primary Key');
            $schema->integer('parent_id')->comment('Parent ID');
            $schema->integer('lft')->comment('Left Key');
            $schema->integer('rgt')->comment('Right key');
            $schema->integer('level')->comment('Nested Level');
            $schema->varchar('path')->length(1024)->comment('Alias Path');
            $schema->varchar('type')->length(50)->comment('Content Type');
            $schema->varchar('title')->comment('Title');
            $schema->varchar('alias')->comment('Alias');
            $schema->varchar('image')->comment('Main Image');
            $schema->text('description')->comment('Description Text');
            $schema->tinyint('state')->length(1)->comment('0: unpublished, 1:published');
            $schema->datetime('created')->nullable(true)->comment('Created Date');
            $schema->integer('created_by')->comment('Author');
            $schema->datetime('modified')->nullable(true)->comment('Modified Date');
            $schema->integer('modified_by')->comment('Modified User');
            $schema->char('language')->length(7)->comment('Language');
            $schema->text('params')->comment('Params');

            $schema->addIndex('alias');
            $schema->addIndex('path');
            $schema->addIndex(['lft', 'rgt']);
            $schema->addIndex('language');
            $schema->addIndex('created_by');
        });

        /** @var NestedSetMapper $mapper */
        $mapper = $orm->mapper(Category::class);

        if (!$mapper->getRoot()) {
            $mapper->createRoot();
        }
    }
);

/**
 * Migration DOWN.
 */
$mig->down(
    static function () use ($mig) {
        $mig->dropTables(Category::class);
    }
);
