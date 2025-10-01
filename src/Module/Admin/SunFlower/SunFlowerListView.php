<?php

declare(strict_types=1);

namespace App\Module\Admin\SunFlower;

use App\Entity\SunFlower;
use App\Repository\SunFlowerRepository;
use Unicorn\View\FormAwareViewModelTrait;
use Unicorn\View\ORMAwareViewModelTrait;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewMetadata;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Attributes\ViewPrepare;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\Language\TranslatorTrait;
use Windwalker\Core\View\Contract\FilterAwareViewModelInterface;
use Windwalker\Core\View\Traits\FilterAwareViewModelTrait;
use Windwalker\Core\View\View;
use Windwalker\DI\Attributes\Autowire;

#[ViewModel(
    layout: [
        'default' => 'sun-flower-list',
        'modal' => 'sun-flower-modal',
    ],
    js: 'sun-flower-list.ts'
)]
class SunFlowerListView implements FilterAwareViewModelInterface
{
    use TranslatorTrait;
    use FilterAwareViewModelTrait;
    use ORMAwareViewModelTrait;
    use FormAwareViewModelTrait;

    public function __construct(
        #[Autowire]
        protected SunFlowerRepository $repository,
    ) {
    }

    #[ViewPrepare]
    public function prepare(AppContext $app, View $view): array
    {
        $state = $this->repository->getState();

        // Prepare Items
        $page     = $state->rememberFromRequest('page');
        $limit    = $state->rememberFromRequest('limit') ?? 30;
        $filter   = (array) $state->rememberMergeRequest('filter');
        $search   = (array) $state->rememberMergeRequest('search');
        $ordering = $state->rememberFromRequest('list_ordering') ?? $this->getDefaultOrdering();

        $items = $this->repository->getListSelector()
            ->setFilters($filter)
            ->searchTextFor(
                $search['*'] ?? '',
                $this->getSearchFields()
            )
            ->ordering($ordering)
            ->page($page)
            ->limit($limit)
            ->setDefaultItemClass(SunFlower::class);

        $pagination = $items->getPagination();

        // Prepare Form
        $form = $this->createForm(SunFlowerGridForm::class)
            ->fill(compact('search', 'filter'));

        $showFilters = $this->isFiltered($filter);

        return compact('items', 'pagination', 'form', 'showFilters', 'ordering');
    }

    /**
     * Get default ordering.
     *
     * @return  string
     */
    public function getDefaultOrdering(): string
    {
        return 'sun_flower.id DESC';
    }

    /**
     * Get search fields.
     *
     * @return  string[]
     */
    public function getSearchFields(): array
    {
        return [
            'sun_flower.id',
            'sun_flower.title',
            'sun_flower.alias',
        ];
    }

    #[ViewMetadata]
    protected function prepareMetadata(HtmlFrame $htmlFrame): void
    {
        $htmlFrame->setTitle(
            $this->trans('unicorn.title.grid', title: 'SunFlower')
        );
    }
}
