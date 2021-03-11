<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Utilities\Arr;

return Arr::mergeRecursive(
    require __DIR__ . '/windwalker.php',
    [
        'commands' => [
            'cache:clear' => \Windwalker\Core\Command\CacheClearCommand::class,

            // 'server:start' => '',
            //
            // 'mail:test' => '',
            //
            'debug:dump-server' => \Windwalker\Core\Command\DumpServerCommand::class,
            //
            // 'db:mig:reset' => '',
            'db:migrate' => \Windwalker\Core\Migration\Command\MigrateCommand::class,
            // 'db:mig:rollback' => '',
            // 'db:mig:update' => '',
            // 'db:mig:status' => '',
            // 'db:export' => '',
            // 'db:seed:import' => '',
            // 'db:seed:clear' => '',
            //
            // 'asset:sync' => '',
            // 'asset:makesum' => '',
            //
            // 'run' => '',
            'test' => __DIR__ . '/../../resources/commands/test.php'
        ],

        'listeners' => [

        ]
    ],
    require __DIR__ . '/../config.php'
);
