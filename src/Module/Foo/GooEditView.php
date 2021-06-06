<?php

/**
 * Part of starter project.
 *
 * @copyright    Copyright (C) 2021 __ORGANIZATION__.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Foo;

use App\Entity\Goo;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Form\FormFactory;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\ORM\ORM;

/**
 * The GooEditView class.
 */
#[ViewModel(
    layout: 'goo-edit',
    js: 'goo-edit.js'
)]
class GooEditView implements ViewModelInterface
{
    /**
     * CategoryEditView constructor.
     *
     * @param    ORM          $orm
     * @param    FormFactory  $formFactory
     * @param    Navigator    $nav
     */
    public function __construct(
        protected ORM $orm,
        protected FormFactory $formFactory,
        protected Navigator $nav,
        #[Autowire] protected GooRepository $repository
    ) {
    }

    /**
     * Prepare
     *
     * @param    AppContext  $app
     * @param    View        $view
     *
     * @return    mixed
     */
    public function prepare(AppContext $app, View $view): mixed
    {
        $id = $app->input('id');

        $item = $this->orm->findOne(Goo::class, $id);

        $form = $this->formFactory
            ->create(EditForm::class)
            ->setNamespace('item')
            ->fill(
                $this->repository->getState()->getAndForget('edit.data')
                    ?: $this->orm->extractEntity($item)
            );

        return compact('form', 'id', 'item');
    }
}
