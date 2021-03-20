<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Component\Front\Home;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\Data\Collection;

/**
 * The HomeView class.
 */
#[ViewModel(
    layout: 'home'
)]
class HomeView implements ViewModelInterface
{
    /**
     * Prepare
     *
     * @param  Collection  $state
     * @param  AppContext  $app
     *
     * @return  array
     */
    public function prepare(Collection $state, AppContext $app): array
    {
        return [];
    }
}
