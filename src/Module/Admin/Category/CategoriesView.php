<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Category;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\Data\Collection;

/**
 * The CategoriesView class.
 */
#[ViewModel(
    layout: 'categories'
)]
class CategoriesView implements ViewModelInterface
{
    /**
     * @inheritDoc
     */
    public function prepare(Collection $state, AppContext $app): array
    {
        return [];
    }
}
