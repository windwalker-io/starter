<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var $view      CategoryEditView       The view modal object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

declare(strict_types=1);

use App\Module\Admin\Category\CategoryEditView;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

/**
 * @var $form \Windwalker\Form\Form
 */

$lang = $lang->extract('luna.');

$a = [
    'foo' => 'FOO',
    'bar' => 'BAR'
];

?>

@extends('admin.global.body')

@section('content')

    <form name="admin-form" id="admin-form" action="{{ $nav->to('category', ['type' => $type]) }}"
        method="POST" enctype="multipart/form-data">

        <x-title-bar :form="$form"></x-title-bar>

{{--        @component('@title-bar', ['form' => $form])--}}
{{--            @slot('end')--}}
{{--                @scope($field)--}}
{{--                {{ json_encode($field)  }}--}}
{{--                Hello--}}
{{--            @endslot--}}

{{--            @slot--}}
{{--                @scope($field)--}}
{{--                {{ json_encode($field)  }}--}}
{{--                Main--}}
{{--            @endslot--}}
{{--            --}}{{-- todo: Must add root slot --}}
{{--        @endcomponent--}}

        <div class="row">
            <div class="col-md-7">
                <fieldset class="form-horizontal">
                    <legend>@lang('category.edit.fieldset.basic')</legend>

{{--                    {!! $form->renderFields('basic') !!}--}}

                    @foreach ($form->getFields('basic') as $field)
                        <x-field :field="$field" class="mb-3"></x-field>
                    @endforeach
                </fieldset>

                <fieldset class="form-horizontal">
                    <legend>@lang('category.edit.fieldset.text')</legend>

                    {!! $form->getField('description')->renderInput() !!}
                </fieldset>
            </div>
            <div class="col-md-5">
                <fieldset class="form-horizontal">
                    <legend>@lang('category.edit.fieldset.created')</legend>

                    {!! $form->renderFields('created') !!}
                </fieldset>
            </div>
        </div>

        <div class="hidden-inputs">
            @formToken
        </div>

    </form>

@stop
