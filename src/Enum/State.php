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
 * @method static static ARCHIVED()
 * @method static static TRASHED()
 * @method static static UNPUBLISHED()
 * @method static static PUBLISHED()
 */
class State extends Enum
{
    public const TRASHED = -2;
    public const UNPUBLISHED = 0;
    public const PUBLISHED = 1;
    public const ARCHIVED = -1;

    /**
     * Creates a new value of some type
     *
     * @psalm-pure
     *
     * @param  mixed  $value
     *
     * @psalm-param T $value
     * @throws \UnexpectedValueException if incompatible type is given.
     */
    public function __construct($value)
    {
        $value = (string) $value === '' ? 0 : $value;

        parent::__construct($value);
    }
}
