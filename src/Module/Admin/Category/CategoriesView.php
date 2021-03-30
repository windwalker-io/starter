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
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Pagination\PaginationFactory;
use Windwalker\Core\Service\FilterService;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\Data\Collection;
use Windwalker\ORM\ORM;

use function Windwalker\filter;

/**
 * The CategoriesView class.
 */
#[ViewModel(
    layout: 'categories'
)]
class CategoriesView implements ViewModelInterface
{
    /**
     * CategoriesView constructor.
     *
     * @param  ORM                $orm
     * @param  PaginationFactory  $paginationFactory
     * @param  FilterService      $filterService
     */
    public function __construct(
        protected ORM $orm,
        protected PaginationFactory $paginationFactory,
        protected FilterService $filterService
    ) {
    }

    /**
     * @inheritDoc
     */
    public function prepare(Collection $state, AppContext $app): array
    {
        [$page, $limit] = $app->input('page', 'limit')->values();

        $page = filter($page, 'int;range:min=1');
        $limit = filter($limit, 'int') ?? 15;

        $items = $this->orm->from(Category::class)
            ->order('id', 'DESC')
            ->offset($page * $limit)
            ->limit($limit);

        $pagination = $this->paginationFactory->create($page, $limit)
            ->total(fn () => $items->count());

        $items = $items->getIterator(Category::class);

        return compact('items', 'pagination');
    }
}
