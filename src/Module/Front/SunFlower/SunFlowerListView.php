<?php

declare(strict_types=1);

namespace App\Module\Front\SunFlower;

use App\Entity\SunFlower;
use App\Repository\SunFlowerRepository;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewMetadata;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\ORM\ORM;

#[ViewModel(
    layout: 'sun-flower-list',
    js: 'sun-flower-list.js'
)]
class SunFlowerListView implements ViewModelInterface
{
    /**
     * Constructor.
     */
    public function __construct(
        protected ORM $orm,
        #[Autowire]
        protected SunFlowerRepository $repository,
    ) {
        //
    }

    /**
     * Prepare View.
     *
     * @param  AppContext  $app   The web app context.
     * @param  View        $view  The view object.
     *
     * @return  mixed
     */
    public function prepare(AppContext $app, View $view): array
    {
        $page     = $app->input('page');
        $limit    = $app->input('limit') ?: 30;
        $ordering = $this->getDefaultOrdering();

        $items = $this->repository->getListSelector()
            ->setFilters([])
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
