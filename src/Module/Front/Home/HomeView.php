<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front\Home;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Pagination\PaginationFactory;
use Windwalker\Core\Renderer\RendererService;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\Data\Collection;
use Windwalker\ORM\ORM;

/**
 * The HomeView class.
 */
#[ViewModel(
    layout: 'home',
    css: 'home.scss',
    modules: [
        '@home' => 'home.js'
    ]
)]
class HomeView implements ViewModelInterface
{
    /**
     * HomeView constructor.
     *
     * @param  ORM  $orm
     */
    public function __construct(protected ORM $orm)
    {
        //
    }

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
        $page = (int) $app->input('page');

        $articles = $this->orm->from('articles')
            ->limit($page);

        $pf = $app->service(PaginationFactory::class);

        $pagin = $pf->create();
        $pagin->currentPage($page)
            ->limit(3)
            ->total($articles->count());

        $renderer = $app->service(RendererService::class);
        $tmpl = $renderer->make('layout.pagination.basic-pagination');

        $pagin->template($renderer->make('layout.pagination.basic-pagination'));

        return compact('pagin', 'articles');
    }
}
