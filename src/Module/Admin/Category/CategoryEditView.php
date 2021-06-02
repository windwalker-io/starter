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
use App\Module\Admin\Category\Form\EditForm;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Form\FormFactory;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\State\AppState;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\DI\Attributes\AttributesResolver;
use Windwalker\ORM\ORM;
use Windwalker\Utilities\Arr;

/**
 * The CategoryEditView class.
 */
#[ViewModel(
    module: CategoryModule::class,
    layout: 'category-edit',
    js: 'category-edit.js'
)]
class CategoryEditView implements ViewModelInterface
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
     * @param  AppContext                  $app
     * @param  \Windwalker\Core\View\View  $view
     *
     * @return  mixed
     */
    public function prepare(AppContext $app, \Windwalker\Core\View\View $view): mixed
    {
        [$id, $type] = $app->input('id', 'type')->values();
        
        $item = $this->orm->findOne(Category::class, $id);

        $form = $this->formFactory
            ->create(EditForm::class, options: ['type' => $type])
            ->setNamespace('item');

        $form->fill($state->getAndForget('edit.data') ?: $this->orm->extractEntity($item));

        return compact('form', 'type', 'id', 'item');
    }
}
