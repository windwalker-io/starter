<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2021 LYRASOFT.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Migration;

use App\Entity\Sakura;
use Windwalker\Core\Auth\AuthService;
use Windwalker\Core\Migration\Migration;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\Database\Schema\Schema;

/** @var Migration $mig */
/** @var Migration $this */

$mig->up(
    function (DatabaseAdapter $db) use ($mig) {
        /** @var Migration $this */
        $mig->createTable(
            Sakura::class,
            function (Schema $schema) {
                $schema->primary('id');
                $schema->varchar('title');
                $schema->integer('category_id');
                $schema->tinyint('state');
                $schema->text('content');
                $schema->integer('ordering');
                $schema->datetime('created');

                $schema->addIndex('category_id');
            }
        );
    }
);

$mig->down(
    static function () use ($mig) {
        $mig->dropTables(Sakura::class);
    }
);
