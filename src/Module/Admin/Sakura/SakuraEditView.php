<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Sakura;

use App\Entity\Sakura;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Form\FormFactory;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\State\AppState;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\ORM\ORM;

/**
 * The SakuraEditView class.
 */
#[ViewModel(
    layout: 'sakura-edit',
    js: 'sakura-edit.js'
)]
class SakuraEditView implements ViewModelInterface
{
    /**
     * CategoryEditView constructor.
     *
     * @param  ORM          $orm
     * @param  FormFactory  $formFactory
     * @param  Navigator    $nav
     */
    public function __construct(
        protected ORM $orm,
        protected FormFactory $formFactory,
        protected Navigator $nav
    ) {
    }

    /**
     * Prepare
     *
     * @param  AppState    $state
     * @param  AppContext  $app
     *
     * @return  mixed
     */
    public function prepare(AppState $state, AppContext $app): mixed
    {
        $id = $app->input('id');

        $item = $this->orm->findOne(Sakura::class, $id);

        $form = $this->formFactory
            ->create(EditForm::class)
            ->setNamespace('item');

        $form->fill($state->getAndForget('edit.data') ?: $this->orm->extractEntity($item));

        return compact('form', 'id', 'item');
    }
}
