<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * The State class.
 *
 * @method static self TRASHED()
 * @method static self UNPUBLISHED()
 * @method static self PUBLISHED()
 */
class State extends Enum
{
    public const TRASHED = -1;
    public const UNPUBLISHED = 0;
    public const PUBLISHED = 1;
}
