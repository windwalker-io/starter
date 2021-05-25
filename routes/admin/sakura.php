<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Routes;

// use App\Module\Admin\Sakura\SakuraEditView;
use App\Module\Admin\Sakura\SakuraEditView;
use App\Module\Admin\Sakura\SakuraListView;
use App\Module\Admin\Sakura\SakuraController;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('sakura')
    ->register(function (RouteCreator $router) {
        $router->any('sakura_list', '/sakuras')
            ->controller(SakuraController::class)
            ->view(SakuraListView::class);

        $router->any('sakura_edit', '/sakura/edit[/{id}]')
            ->controller(SakuraController::class)
            ->view(SakuraEditView::class);
    });
