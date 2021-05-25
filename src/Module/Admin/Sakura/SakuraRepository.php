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
use Unicorn\Repository\Actions\ActionsFactory;
use Unicorn\Repository\Actions\ReorderAction;
use Unicorn\Repository\Actions\SaveAction;
use Unicorn\Repository\CrudRepositoryTrait;
use Unicorn\Repository\DatabaseRepositoryInterface;
use Unicorn\Repository\DatabaseRepositoryTrait;
use Unicorn\Selector\ListSelector;
use Windwalker\ORM\SelectorQuery;
use Windwalker\Query\Query;

/**
 * The SakuraRepository class.
 */
#[Repository(Sakura::class)]
class SakuraRepository implements DatabaseRepositoryInterface
{
    use CrudRepositoryTrait;

    protected function configureSelector(SelectorQuery $query, ListSelector $selector): void
    {
        $query->from(Sakura::class)
            ->leftJoin(Category::class);
    }

    protected function configureActions(ActionsFactory $actionsFactory): void
    {
        $actionsFactory->configure(
            ReorderAction::class,
            function (ReorderAction $action) {
                $action->setReorderGroupHandler(function (Query $query, Sakura $sakura) {
                    $query->where('category_id', $sakura->getCategoryId());
                });
            }
        );
    }
}
