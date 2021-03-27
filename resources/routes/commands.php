<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

return [
    'cache:clear' => \Windwalker\Core\Command\CacheClearCommand::class,

    // 'server:start' => '',
    //
    'mail:test' => \Windwalker\Core\Command\MailTestCommand::class,
    //
    'dump-server' => \Windwalker\Core\Command\DumpServerCommand::class,

    'mig:go' => \Windwalker\Core\Migration\Command\MigrateGoCommand::class,
    'mig:reset' => \Windwalker\Core\Migration\Command\ResetCommand::class,
    'mig:status' => \Windwalker\Core\Migration\Command\StatusCommand::class,
    'mig:create' => \Windwalker\Core\Migration\Command\CreateCommand::class,
    'db:export' => \Windwalker\Core\Command\DbExportCommand::class,
    'seed:import' => \Windwalker\Core\Seed\Command\SeedImportCommand::class,
    'seed:clear' => \Windwalker\Core\Seed\Command\SeedClearCommand::class,

    'schedule' => \Windwalker\Core\Schedule\Command\ScheduleCommand::class,
    //
    'asset:sync' => \Windwalker\Core\Asset\Command\AssetSyncCommand::class,
    'asset:version' => \Windwalker\Core\Asset\Command\AssetVersionCommand::class,

    'pkg:install' => \Windwalker\Core\Package\Command\PackageInstallCommand::class,
    //
    'run' => \Windwalker\Core\Command\RunCommand::class
];
