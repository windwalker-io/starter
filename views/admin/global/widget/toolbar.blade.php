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

?>
<aside id="admin-toolbar" class="">
    <button data-toggle="collapse" class="btn btn-default toolbar-toggle-button" data-target=".admin-toolbar-buttons">
        <span class="glyphicon glyphicon-wrench"></span>
        @lang('phoenix.toolbar.toggle')
    </button>
    <div class="admin-toolbar-buttons">
        <hr/>
        @yield('toolbar-buttons')
    </div>
</aside>
