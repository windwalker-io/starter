<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2021 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

namespace App\Schedule;

use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\Core\Schedule\Schedule;

/**
 * @var Schedule           $schedule
 * @var ConsoleApplication $app
 */

$schedule->hourly('hello')
    ->minuteOfHour(5)
    ->tags('foo', 'yoo', 'bar')
    ->handler(function () {
        show('GGGG');
    });
