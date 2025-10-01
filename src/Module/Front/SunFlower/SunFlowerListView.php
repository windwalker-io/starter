<?php

declare(strict_types=1);

namespace App\Module\Front\SunFlower;

use App\Entity\SunFlower;
use App\Repository\SunFlowerRepository;
use Unicorn\View\ORMAwareViewModelTrait;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewMetadata;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Attributes\ViewPrepare;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\DI\Attributes\Autowire;

#[ViewModel(
    layout: 'sun-flower-list',
    js: 'sun-flower-list.ts'
)]
class SunFlowerListView
{
    use ORMAwareViewModelTrait;

    public function __construct(
        #[Autowire]
        protected SunFlowerRepository $repository,
    ) {
        //
    }

    #[ViewPrepare]
    public function prepare(AppContext $app, View $view): array
    {
        $page     = $app->input('page');
        $limit    = $app->input('limit') ?? 30;
        $ordering = $this->getDefaultOrdering();

        $items = $this->repository->getListSelector()
            ->addFilters([])
            ->ordering($ordering)
            ->page($page)
            ->limit($limit)
            ->setDefaultItemClass(SunFlower::class);

        $pagination = $items->getPagination();

        return compact('items', 'pagination');
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

    #[ViewMetadata]
    protected function prepareMetadata(HtmlFrame $htmlFrame): void
    {
        $htmlFrame->setTitle('SunFlower List');
    }
}
