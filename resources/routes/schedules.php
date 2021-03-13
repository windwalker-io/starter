<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Schedule;

use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\Core\Schedule\Schedule;

/**
 * @var Schedule           $schedule
 * @var ConsoleApplication $app
 */

$schedule->monthly('hello')
    ->dayOfMonth(1, 5, 10, 15, 20)
    ->handler(function () {
        show('GGGG');
    });
