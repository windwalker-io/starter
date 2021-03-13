<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2021 LYRASOFT.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Migration;

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
            'sakuras',
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
        $mig->dropTables('sakuras');
    }
);
