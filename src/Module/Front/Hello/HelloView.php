<?php

/**
 * Part of starter project.
 *
 * @copyright    Copyright (C) 2021 __ORGANIZATION__.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front\Hello;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;

/**
 * The HelloView class.
 */
#[ViewModel(
    layout: 'hello',
    js: 'hello.js'
)]
class HelloView implements ViewModelInterface
{
    /**
     * HelloView constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Prepare View.
     *
     * @param    AppContext  $app   The web app context.
     * @param    View        $view  The view object.
     *
     * @return    mixed
     */
    public function prepare(AppContext $app, View $view): array
    {
        return [];
    }
}
