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
use Windwalker\Core\View\View;
use Windwalker\DI\Attributes\Autowire;

#[ViewModel(
    layout: 'sun-flower-edit',
    js: 'sun-flower-edit.ts'
)]
class SunFlowerEditView
{
    use TranslatorTrait;
    use ORMAwareViewModelTrait;
    use FormAwareViewModelTrait;

    public function __construct(
        #[Autowire] protected SunFlowerRepository $repository,
    ) {
    }

    #[ViewPrepare]
    public function prepare(AppContext $app, View $view): mixed
    {
        $id = $app->input('id');

        /** @var ?SunFlower $item */
        $item = $this->repository->getItem($id);

        // Bind item for injection
        $view[SunFlower::class] = $item;

        $form = $this->createForm(SunFlowerEditForm::class)
            ->fillTo('item', $this->orm->extractEntity($item))
            ->fillTo('item', $this->repository->getState()->getAndForget('edit.data'));

        return compact('form', 'id', 'item');
    }

    #[ViewMetadata]
    protected function prepareMetadata(HtmlFrame $htmlFrame): void
    {
        $htmlFrame->setTitle(
            $this->trans('unicorn.title.edit', title: 'SunFlower')
        );
    }
}
