<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var  $app       AppContext      Application context.
 * @var  $view      SunFlowerEditView  The view modal object.
 * @var  $uri       SystemUri       System Uri information.
 * @var  $chronos   ChronosService  The chronos datetime service.
 * @var  $nav       Navigator       Navigator object to build route.
 * @var  $asset     AssetService    The Asset manage service.
 * @var  $lang      LangService     The language translation service.
 */

declare(strict_types=1);

use App\Module\Admin\SunFlower\SunFlowerEditView;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

?>

<div x-id="toolbar" x-data="{ form: $store.form }">
    <div class="btn-group">
        <button type="button" class="btn btn-success btn-sm"
            @click="form.post();">
            <span class="fa fa-save"></span>
            @lang('unicorn.toolbar.save')
        </button>
        <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split"
            data-bs-toggle="dropdown"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only visually-hidden">Toggle Dropdown</span>
        </button>

        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item"
                    href="javascript://"
                    @click="form.post(null, { task: 'save2copy' });">
                    <span class="fa fa-copy"></span>
                    @lang('unicorn.toolbar.save2copy')
                </a>
            </li>

            <li>
                <a class="dropdown-item"
                    href="javascript://"
                    @click="form.post(null, { task: 'save2new' });">
                    <span class="fa fa-plus"></span>
                    @lang('unicorn.toolbar.save2new')
                </a>
            </li>
        </ul>
    </div>

    <button type="button" class="btn  btn-primary btn-sm"
        @click="form.post(null, { task: 'save2close' });">
        <span class="fa fa-check"></span>
        @lang('unicorn.toolbar.save2close')
    </button>

    <a class="btn btn-default btn-outline-secondary btn-sm"
        href="{{ $nav->to('sun_flower_list') }}">
        <span class="glyphicon glyphicon-remove fa fa-remove fa-times"></span>
        @lang('unicorn.toolbar.cancel')
    </a>
</div>
