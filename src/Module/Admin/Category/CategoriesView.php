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
use Windwalker\Core\Form\FormFactory;
use Windwalker\Core\Pagination\PaginationFactory;
use Windwalker\Core\Service\FilterService;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\Data\Collection;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\ORM\ORM;
use Windwalker\Query\Query;

use Windwalker\Session\Session;

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
     * @param  ORM                 $orm
     * @param  CategoryRepository  $categoryRepository
     * @param  Session             $session
     * @param  FormFactory         $formFactory
     * @param  FilterService       $filterService
     */
    public function __construct(
        protected ORM $orm,
        #[Autowire]
        protected CategoryRepository $categoryRepository,
        protected Session $session,
        protected FormFactory $formFactory,
        protected FilterService $filterService
    ) {
    }

    /**
     * @inheritDoc
     */
    public function prepare(Collection $state, AppContext $app): array
    {
        [$page, $limit] = $app->input('page', 'limit')->values();

        $page  = filter($page, 'int;range:min=1');
        $limit = filter($limit, 'int') ?? 15;

        $filter = (array) $this->session->overrideWith('categories.filter', $app->input('filter'));
        $search = (array) $this->session->overrideWith('categories.search', $app->input('search'));
        $ordering = $this->session->overrideWith('categories.list_ordering', $app->input('list_ordering')) ?? 'category.lft';
        $direction = $this->session->overrideWith('categories.list_direction', $app->input('list_direction'));

        $items = $this->categoryRepository->getListSelector()
            ->setFilters($filter)
            ->setSearches($search)
            ->page($page)
            ->limit($limit)
            ->modifyQuery(
                fn(Query $query) => $query->where('parent_id', '!=', 0)
                    ->order('category.lft', 'ASC')
            );

        $pagination = $items->getPagination();

        $items = $items->getIterator(Category::class);

        // Form
        $form = $this->formFactory->create(GridForm::class);
        $form->fill(compact('search', 'filter'));

        $showFilters = $this->showFilterBar($filter);

        return compact('items', 'pagination', 'form', 'showFilters', 'ordering', 'direction');
    }

    public function showFilterBar(array $filter): bool
    {
        foreach ($filter as $value) {
            if ($value !== null || (string) $value === '') {
                return true;
            }
        }

        return false;
    }
}
