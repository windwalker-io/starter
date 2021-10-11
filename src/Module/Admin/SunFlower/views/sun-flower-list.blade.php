<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var  $app       AppContext      Application context.
 * @var  $vm        SunFlowerListView The view model object.
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
use App\Module\Admin\SunFlower\SunFlowerListView;

/**
 * @var \App\Entity\SunFlower $entity
 */

$workflow = $app->service(\Unicorn\Workflow\BasicStateWorkflow::class);
?>

@extends('admin.global.body-list')

@section('toolbar-buttons')
    @include('list-toolbar')
@stop

@section('content')
    <form id="admin-form" action="" x-data="{ grid: $store.grid }"
        x-ref="gridForm"
        data-ordering="{{ $ordering }}"
        method="post">

        <x-filter-bar :form="$form" :open="$showFilters"></x-filter-bar>

        <div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th style="width: 1%">
                        <x-toggle-all></x-toggle-all>
                    </th>
                    <th style="width: 5%" class="text-nowrap">
                        <x-sort field="sun_flower.state">
                            @lang('unicorn.field.state')
                        </x-sort>
                    </th>
                    <th class="text-nowrap">
                        <x-sort field="sun_flower.title">
                            @lang('unicorn.field.title')
                        </x-sort>
                    </th>
                    <th style="width: 10%" class="text-nowrap">
                        <div class="d-flex w-100 justify-content-between">
                            <x-sort
                                asc="sun_flower.ordering ASC"
                                desc="sun_flower.ordering DESC"
                            >
                                @lang('unicorn.field.ordering')
                            </x-sort>
                            @if($vm->reorderEnabled($ordering))
                                <x-save-order></x-save-order>
                            @endif
                        </div>
                    </th>
                    <th style="width: 1%" class="text-nowrap">
                        @lang('unicorn.field.delete')
                    </th>
                    <th style="width: 1%" class="text-nowrap text-right">
                        <x-sort field="sun_flower.id">
                            @lang('unicorn.field.id')
                        </x-sort>
                    </th>
                </tr>
                </thead>

                <tbody>
                @foreach($items as $i => $item)
                    <?php
                        $entity = $vm->prepareItem($item);
                    ?>
                    <tr>
                        <td>
                            <x-row-checkbox :row="$i" :id="$entity->getId()"></x-row-checkbox>
                        </td>
                        <th>
                            <x-state-dropdown color-on="text"
                                button-style="width: 100%"
                                use-states
                                :workflow="$workflow"
                                :id="$entity->getId()"
                                :value="$item->state"
                            />
                        </th>
                        <td>
                            <div>
                                <a href="{{ $nav->to('sun_flower_edit')->id($entity->getId()) }}">
                                    {{ $item->title }}
                                </a>
                            </div>
                        </td>
                        <td>
                            <x-order-control
                                :enabled="$vm->reorderEnabled($ordering)"
                                :row="$i"
                                :id="$entity->getId()"
                                :value="$item->ordering"
                            ></x-order-control>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                @click="grid.deleteItem('{{ $entity->getId() }}')"
                                data-dos
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                        <td class="text-right">
                            {{ $entity->getId() }}
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
            <input name="_method" type="hidden" value="PUT" />
            @include('@csrf')
        </div>

        <x-batch-modal :form="$form" namespace="batch"></x-batch-modal>
    </form>

@stop
