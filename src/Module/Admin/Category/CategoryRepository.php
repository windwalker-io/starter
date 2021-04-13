<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Category;

use App\Entity\Category;
use Unicorn\Repository\DatabaseRepositoryInterface;
use Unicorn\Repository\DatabaseRepositoryTrait;
use Unicorn\Selector\ListSelector;
use Windwalker\ORM\SelectorQuery;

/**
 * The CategoryRepository class.
 */
class CategoryRepository implements DatabaseRepositoryInterface
{
    use DatabaseRepositoryTrait;

    protected function configureSelector(SelectorQuery $query, ListSelector $selector): void
    {
        $query->from(Category::class);

        // $selector->addFilterHandler()

    }
}
