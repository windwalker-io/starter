<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Front\Test;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\View\ViewModelInterface;

/**
 * The TestView class.
 */
#[ViewModel(
    layout: 'front.sakura.sakura'
)]
class HelloView implements ViewModelInterface
{
    /**
     * Prepare
     *
     * @param  \Windwalker\Data\Collection  $state
     * @param  AppContext                   $app
     *
     * @return  array
     */
    public function prepare(\Windwalker\Data\Collection $state, AppContext $app): array
    {
        $state = $app->getState();



        return [];
    }
}
