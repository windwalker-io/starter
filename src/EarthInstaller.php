<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App;

/**
 * The EarthInstaller class.
 */
class EarthInstaller
{
    public static function install(): void
    {
        $gitignore = __DIR__ . '/../.gitignore';

        $ignore = file_get_contents($gitignore);

        preg_replace('~\# @Dev(.*)\# @EndDev~', '', $ignore);

        file_put_contents($gitignore, $ignore);

        unlink(__FILE__);
    }
}
