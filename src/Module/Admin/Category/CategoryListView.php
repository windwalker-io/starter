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
use Windwalker\Core\Service\FilterService;
use Windwalker\Core\State\AppState;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\ORM\ORM;
use Windwalker\Query\Query;
use Windwalker\Session\Session;

use function Windwalker\filter;

/**
 * The CategoriesView class.
 */
#[ViewModel(
    name: 'category',
    layout: 'category-list',
    js: 'category-list.js'
)]
class CategoryListView implements ViewModelInterface
{
    /**
     * CategoriesView constructor.
     *
     * @param  ORM                 $orm
     * @param  CategoryRepository  $categoryRepository
     * @param  FormFactory         $formFactory
     */
    public function __construct(
        protected ORM $orm,
        #[Autowire]
        protected CategoryRepository $categoryRepository,
        protected FormFactory $formFactory
    ) {
    }

    /**
     * @inheritDoc
     */
    public function prepare(AppState $state, AppContext $app): array
    {
        [$page, $limit] = $app->input('page', 'limit')->values();

        $page  = filter($page, 'int;range:min=1');
        $limit = filter($limit, 'int') ?? 15;

        $state = $state->withPrefix('category');

        $filter   = (array) $state->persistFromRequest('filter');
        $search   = (array) $state->persistFromRequest('search');
        $ordering = $state->persistFromRequest('list_ordering') ?? 'category.id ASC';

        $items = $this->categoryRepository->getListSelector()
            ->setFilters($filter)
            ->searchFor(
                $search['*'] ?? null,
                [
                    'category.title',
                    'category.alias'
                ]
            )
            ->ordering($ordering)
            ->page($page)
            ->limit($limit)
            ->modifyQuery(
                fn(Query $query) => $query->where('parent_id', '!=', 0)
            );

        $pagination = $items->getPagination();

        $items = $items->getIterator(Category::class);

        // Form
        $form = $this->formFactory->create(GridForm::class);
        $form->fill(compact('search', 'filter'));

        $showFilters = $this->showFilterBar($filter);

        return compact('items', 'pagination', 'form', 'showFilters', 'ordering');
    }

    public function showFilterBar(array $filter): bool
    {
        foreach ($filter as $value) {
            if ($value !== null && (string) $value !== '') {
                return true;
            }
        }

        return false;
    }
}
