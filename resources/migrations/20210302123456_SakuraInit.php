<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Migration;

use Windwalker\Core\Migration\Migration;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\Database\Schema\Schema;

/** @var Migration $mig */
/** @var Migration $this */

$mig->up(
    static function (DatabaseAdapter $db) use ($mig) {
        $db->getTable('sakuras')->create(
            function (Schema $schema) {
                $schema->primary('id');
                $schema->varchar('title');
                $schema->text('content');
                $schema->datetime('created');
            }
        );
    }
);

$mig->down(
    static function () use ($mig) {
        $mig->db->getTable('sakuras')->drop();
    }
);

