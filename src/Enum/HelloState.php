<?php

/**
 * Part of starter project.
 *
 * @copyright    Copyright (C) 2021 __ORGANIZATION__.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * The HelloState enum class.
 *
 * @items  Add items here.
 */
class HelloState extends Enum
{
    /**
     * Creates a new value of some type
     *
     * @psalm-pure
     *
     * @param    mixed  $value
     *
     * @psalm-param T $value
     * @throws  \UnexpectedValueException if incompatible type is given.
     */
    public function __construct(mixed $value)
    {
        parent::__construct($value);
    }
}
