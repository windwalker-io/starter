<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App;

use Composer\Script\Event;

/**
 * The EarthInstaller class.
 */
class EarthInstaller
{
    public static function install(Event $event): void
    {
        $io = $event->getIO();
        $gitignore = __DIR__ . '/../.gitignore';

        $ignore = file_get_contents($gitignore);

        $ignore = preg_replace('~# @Dev(.*)# @EndDev\s+~sm', '', $ignore);

        file_put_contents($gitignore, $ignore);

        $io->write('Remove .gitignore dev files.');

        unlink(__FILE__);

        $io->write('Remove: ' . __FILE__);
    }
}
