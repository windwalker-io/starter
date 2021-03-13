<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

return array_merge(
    require __DIR__ . '/windwalker.php',
    [
        'commands' => include __DIR__ . '/../../resources/routes/commands.php',

        'listeners' => [

        ],

        'schedules' => [
            __DIR__ . '/../../resources/routes/schedules.php'
        ],

        'scripts' => include __DIR__ . '/../../resources/routes/commands.php'
    ],
    require __DIR__ . '/../config.php'
);
