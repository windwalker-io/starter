<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var $vm        object          The view model object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
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
    @include('list-toolbar')
@stop

@section('content')
    <form id="grid-form" action="" x-data="{ grid: $store.grid }"
        x-ref="gridForm"
        data-ordering="{{ $ordering }}"
        method="post">

        <x-filter-bar :form="$form" :open="$showFilters"></x-filter-bar>

        <div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 1%">
                        <x-toggle-all></x-toggle-all>
                    </th>
                    <th>
                        <x-sort field="sakura.state">
                            State
                        </x-sort>
                    </th>
                    <th>
                        <x-sort field="sakura.title">
                            Title
                        </x-sort>
                    </th>
                    <th>
                        <x-sort field="sakura.category_id">
                            Category
                        </x-sort>
                    </th>
                    <th style="width: 10%" class="">
                        <div class="d-flex w-100 justify-content-between">
                            <x-sort
                                asc="sakura.category_id ASC, sakura.ordering ASC"
                                desc="sakura.category_id DESC, sakura.ordering DESC"
                            >
                                Order
                            </x-sort>
                            @if ($ordering === 'sakura.category_id ASC, sakura.ordering ASC')
                                <x-save-order></x-save-order>
                            @endif
                        </div>
                    </th>
                    <th>
                        Delete
                    </th>
                    <th>
                        <x-sort field="category.id">
                            ID
                        </x-sort>
                    </th>
                </tr>
                </thead>

                <tbody>
                @foreach ($items as $i => $item)
                    <tr>
                        <td>
                            <x-row-checkbox :row="$i" :id="$item->id"></x-row-checkbox>
                        </td>
                        <th>
                            {{ $item->state }}
                        </th>
                        <td>
                            <a href="{{ $nav->to('sakura_edit')->id($item->id) }}">
                                {{ $item->title }}
                            </a>
                        </td>
                        <td>
                            {{ $item->category->title ?? '' }}
                        </td>
                        <td>
                            <x-order-control
                                :enabled="$ordering === 'sakura.category_id ASC, sakura.ordering ASC'"
                                :row="$i"
                                :id="$item->id"
                                :value="$item->ordering"
                            ></x-order-control>
                        </td>
                        <td></td>
                        <td>
                            {{ $item->id }}
                        </td>
                    </tr>
                @endforeach
                </tbody>

                <tfoot>
                <tr>
                    <td colspan="20">
                        {!! $pagination->render() !!}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-none">

        </div>

        <x-batch-modal :form="$form" namespace="batch"></x-batch-modal>
    </form>

@stop
