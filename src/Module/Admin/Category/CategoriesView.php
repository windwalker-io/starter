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
use App\Enum\State;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\Data\Collection;
use Windwalker\ORM\ORM;

/**
 * The CategoriesView class.
 */
#[ViewModel(
    layout: 'categories'
)]
class CategoriesView implements ViewModelInterface
{
    /**
     * CategoriesView constructor.
     *
     * @param  ORM  $orm
     */
    public function __construct(protected ORM $orm)
    {
    }

    /**
     * @inheritDoc
     */
    public function prepare(Collection $state, AppContext $app): array
    {
        $category = $this->orm->findOne(Category::class, 3);

        $cat = new Category();

        show($cat->getState());

        show(
            $category->getState() === State::UNPUBLISHED()
        );

        return [];
    }
}
