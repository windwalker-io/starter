<?php

/**
 * Part of starter project.
 *
 * @copyright    Copyright (C) 2021 __ORGANIZATION__.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front\Hello;

use Windwalker\Database\DatabaseAdapter;

/**
 * The HelloRepository class.
 */
class HelloRepository
{
    /**
     * HelloRepository constructor.
     */
    public function __construct(protected DatabaseAdapter $db)
    {
        //
    }
}
