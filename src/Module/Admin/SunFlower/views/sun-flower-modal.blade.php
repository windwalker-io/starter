<?php

declare(strict_types=1);

namespace App\View;

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var $vm        SunFlowerListView  The view model object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

use App\Module\Admin\SunFlower\SunFlowerListView;
use Unicorn\Workflow\BasicStateWorkflow;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

$callback = $app->input('callback');
$workflow = $app->service(BasicStateWorkflow::class);
?>

@extends('admin.global.pure')

@section('body')
    <form id="admin-form" action="" x-data="{ grid: $store.grid }"
        x-ref="gridForm"
        data-ordering="{{ $ordering }}"
        method="post">

        <x-filter-bar :form="$form" :open="$showFilters"></x-filter-bar>

        {{-- RESPONSIVE TABLE DESC --}}
        <div class="d-block d-lg-none mb-3">
            @lang('unicorn.grid.responsive.table.desc')
        </div>

        <div class="grid-table table-responsive-lg">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th style="width: 10%">
                        <x-sort field="sun_flower.state">
                            @lang('unicorn.field.state')
                        </x-sort>
                    </th>
                    <th>
                        <x-sort field="sun_flower.title">
                            @lang('unicorn.field.title')
                        </x-sort>
                    </th>
                    <th class="text-end text-nowrap" style="width: 1%">
                        <x-sort field="sun_flower.id">
                            @lang('unicorn.field.id')
                        </x-sort>
                    </th>
                </tr>
                </thead>

                <tbody>
                @foreach($items as $i => $item)
                    @php($data = [
                        'title' => $item->title,
                        'value' => $item->id,
                        'image' => $item->image,
                    ])
                    <tr>
                        <td>
                            <x-state-dropdown color-on="text"
                                button-style="width: 100%"
                                use-states
                                readonly
                                :workflow="$workflow"
                                :id="$item->id"
                                :value="$item->state"
                            ></x-state-dropdown>
                        </td>
                        <td>
                            <a href="javascript://"
                                onclick="parent.{{ $callback }}({{ json_encode($data) }})">
                                {{ $item->title }}
                            </a>
                        </td>
                        <td class="text-end">
                            {{ $item->id }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div>
                <x-pagination :pagination="$pagination">
                    <x-slot name="end">
                        <x-pagination-jump :pagination="$pagination" />
                        <x-pagination-stats :pagination="$pagination" class="ms-0 ms-md-auto" />
                    </x-slot>
                </x-pagination>
            </div>
        </div>

        <div class="d-none">
            <input name="_method" type="hidden" value="PUT" />
            <x-csrf></x-csrf>
        </div>
    </form>

@stop
