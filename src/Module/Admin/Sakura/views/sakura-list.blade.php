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
                        <x-sort field="category.title">
                            Title
                        </x-sort>
                    </th>
                    <th style="width: 10%">
                        <x-sort field="category.lft">
                            Order
                        </x-sort>
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
                            <x-row-checkbox :row="$i" :id="$item->getId()"></x-row-checkbox>
                        </td>
                        <td>
                            <a href="{{ $nav->to('sakura_edit')->id($item->getId()) }}">
                                {{ $item->getTitle() }}
                            </a>
                        </td>
                        <td>
                            <x-order-control
                                :enabled="true"
                                :row="$i"
                                :id="$item->getId()"
                                :value="$item->getOrdering()"
                            ></x-order-control>
                        </td>
                        <td></td>
                        <td>
                            {{ $item->getId() }}
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
    </form>

@stop
