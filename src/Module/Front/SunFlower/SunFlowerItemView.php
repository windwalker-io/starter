<?php

declare(strict_types=1);

namespace App\Module\Front\SunFlower;

use App\Entity\SunFlower;
use App\Repository\SunFlowerRepository;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewMetadata;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Attributes\ViewPrepare;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\View\View;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\ORM\ORM;

#[ViewModel(
    layout: 'sun-flower-item',
    js: 'sun-flower-item.ts'
)]
class SunFlowerItemView
{
    public function __construct(
        protected ORM $orm,
        #[Autowire] protected SunFlowerRepository $repository
    ) {
        //
    }

    #[ViewPrepare]
    public function prepare(AppContext $app, View $view): array
    {
        $id = $app->input('id');

        /** @var SunFlower $item */
        $item = $this->repository->mustGetItem($id);

        $view[$item::class] = $item;

        return compact('item');
    }

    #[ViewMetadata]
    public function prepareMetadata(HtmlFrame $htmlFrame, SunFlower $item): void
    {
        $htmlFrame->setTitle($item->title ?: 'SunFlower Item');
    }
}
