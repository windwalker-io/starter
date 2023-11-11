<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var $view      ViewModel       The view modal object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

declare(strict_types=1);

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

$menu = $app->service(\Unicorn\Legacy\Html\MenuHelper::class);

$root = $app->service(\Lyrasoft\Luna\Services\MenuService::class)
    ->loadMenuFromFile('sidemenu', WINDWALKER_RESOURCES . '/menu/admin/sidemenu.menu.php');
?>

<ul id="submenu" class="nav nav-stacked nav-pills flex-column">
    @foreach ($root->getChildren() as $menuItem)
        <li class="nav-item {{ $menuItem->isActive(true) ? 'active' : '' }}">
            <a href="{{ $menuItem->route($nav) }}"
                class="nav-link {{ $menuItem->isActive(true) ? 'active' : '' }}">
                {{ $menuItem->getTitle() }}
            </a>
        </li>
    @endforeach
</ul>
