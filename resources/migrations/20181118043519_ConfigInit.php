<?php

/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2014 - 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

declare(strict_types=1);

namespace App\Migration;

use Lyrasoft\Luna\Entity\Config;
use Windwalker\Core\Migration\Migration;
use Windwalker\Database\Schema\Schema;

/**
 * Migration UP: 20181118043519_ConfigInit.
 *
 * @var Migration $mig
 */
$mig->up(
    static function () use ($mig) {
        $mig->createTable(Config::class, function (Schema $schema) {
            $schema->char('type')->length(50)->comment('Type');
            $schema->char('subtype')->length(50)->comment('Sub Type');
            $schema->longtext('content')->comment('Content');
            $schema->datetime('modified')->nullable(true)->comment('Modified');
            $schema->integer('modified_by')->comment('Modified User');

            $schema->addIndex('type');
            $schema->addIndex('subtype');
            $schema->addPrimaryKey(['type', 'subtype']);
        });
    }
);

/**
 * Migration DOWN.
 */
$mig->down(
    static function () use ($mig) {
        $mig->dropTables(Config::class);
    }
);
