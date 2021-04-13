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
use Windwalker\Core\State\AppState;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\ORM\ORM;

/**
 * The CategoryEditView class.
 */
#[ViewModel(
    name: 'category',
    layout: 'category-edit'
)]
class CategoryEditView implements ViewModelInterface
{
    /**
     * CategoryEditView constructor.
     *
     * @param  ORM          $orm
     * @param  FormFactory  $formFactory
     */
    public function __construct(
        protected ORM $orm,
        protected FormFactory $formFactory,
    )
    {
    }

    /**
     * Prepare
     *
     * @param  AppState    $state
     * @param  AppContext  $app
     *
     * @return  array
     */
    public function prepare(AppState $state, AppContext $app): array
    {
        [$id, $type] = $app->input('id', 'type')->values();

        $item = $this->orm->findOne(Category::class, $id);

        $form = $this->formFactory->create(EditForm::class, options: ['type' => $type]);

        $form->fill($this->orm->extractEntity($item));

        return compact('form', 'type', 'id', 'item');
    }
}
