<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var  $app       AppContext      Application context.
 * @var  $vm        object          The view model object.
 * @var  $uri       SystemUri       System Uri information.
 * @var  $chronos   ChronosService  The chronos datetime service.
 * @var  $nav       Navigator       Navigator object to build route.
 * @var  $asset     AssetService    The Asset manage service.
 * @var  $lang      LangService     The language translation service.
 */

declare(strict_types=1);

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

?>

@extends('admin.global.body')

@section('toolbar-buttons')
    @include('edit-toolbar')
@stop

@section('content')
    <uni-form-validate scroll>
        <form name="admin-form" id="admin-form" novalidate
            action="{{ $nav->to('sun_flower_edit') }}"
            method="POST" enctype="multipart/form-data">

            <x-title-bar :form="$form"></x-title-bar>

            <div class="row">
                <div class="col-md-7">
                    <x-fieldset name="basic" title="Basic"
                        :form="$form" class="mb-4"
                    >
                    </x-fieldset>
                    <x-fieldset name="text" title="Text"
                        :form="$form" class="mb-4"
                    >
                    </x-fieldset>
                </div>
                <div class="col-md-5">
                    <x-fieldset name="meta" title="Meta"
                        :form="$form" class="mb-4"
                    >
                    </x-fieldset>
                </div>
            </div>

            <div class="d-none">
                @include('@csrf')
            </div>

            <uni-iframe-modal id="modal-1"></uni-iframe-modal>
        </form>
    </uni-form-validate>
@stop
