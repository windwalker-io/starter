<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Sakura;

use App\Entity\Category;
use App\Entity\Sakura;
use Unicorn\Attributes\Repository;
use Unicorn\Repository\DatabaseRepositoryInterface;
use Unicorn\Repository\DatabaseRepositoryTrait;
use Unicorn\Selector\ListSelector;
use Windwalker\ORM\SelectorQuery;

/**
 * The SakuraRepository class.
 */
#[Repository(Sakura::class)]
class SakuraRepository implements DatabaseRepositoryInterface
{
    use DatabaseRepositoryTrait;

    protected function configureSelector(SelectorQuery $query, ListSelector $selector): void
    {
        $query->from(Sakura::class);
    }
}
