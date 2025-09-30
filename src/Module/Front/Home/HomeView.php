<?php

declare(strict_types=1);

namespace App\Module\Front\Home;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Attributes\ViewPrepare;
use Windwalker\Core\View\View;

/**
 * The HomeView class.
 */
#[ViewModel(
    layout: 'home',
    js: 'home.ts',
)]
class HomeView
{
    /**
     * HomeView constructor.
     */
    public function __construct()
    {
        //
    }

    #[ViewPrepare]
    public function prepare(AppContext $app, View $view): array
    {
        return [];
    }
}
