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
use Unicorn\Attributes\Repository;
use Unicorn\Repository\CrudRepositoryTrait;
use Unicorn\Repository\DatabaseRepositoryInterface;
use Unicorn\Repository\DatabaseRepositoryTrait;
use Unicorn\Selector\ListSelector;
use Windwalker\ORM\SelectorQuery;

/**
 * The CategoryRepository class.
 */
#[Repository(Category::class)]
class CategoryRepository implements DatabaseRepositoryInterface
{
    use CrudRepositoryTrait;

    protected function configureSelector(SelectorQuery $query, ListSelector $selector): void
    {
        $query->from(Category::class);

        // $selector->addFilterHandler()

    }
}
