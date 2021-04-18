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

use App\Entity\Category;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Pagination\Pagination;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

/**
 * @var $items      Category[]
 * @var $pagination Pagination
 */

$asset->css('https://unpkg.com/vue2-animate@2.1.4/dist/vue2-animate.min.css');

?>

@extends('admin.global.body')

@section('toolbar-buttons')
    @include('toolbar-list')
@stop

@push('script')
    {{--<script>--}}
    {{--    const state = {};--}}
    {{--</script>--}}
    <script defer>
        window.foo = 123;
    </script>
    <script>
        // const bs5 = System.import('@unicorn/ui/ui-bootstrap5.js?sdf').then(c => console.log(c));
    </script>
@endpush

@section('content')

    <form id="grid-form" action="" x-data
        x-ref="gridForm"
        data-ordering="{{ $ordering }}"
        method="post">

        <x-filter-bar :form="$form" :open="$showFilters" ::goo="goo"></x-filter-bar>

{{--        @component('@filter-bar', ['open' => $showFilters])--}}

{{--        @endcomponent--}}

        <div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 1%">
                        <input type="checkbox" data-task="toggle-all"
                            class="form-check-input"
                            @click="grid.toggleAll($event.target.checked)"
                        />
                    </th>
                    <th>
                        <x-sort field="category.state">
                            State
                        </x-sort>
                    </th>
                    <th>
                        <x-sort field="category.title">
                            Title
                        </x-sort>
                    </th>
                    <th>
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
                            <input id="cb{{ $i }}" type="checkbox" name="id[]"
                                class="form-check-input"
                                value="{{ $item->getId() }}" data-role="grid-checkbox" />
                        </td>
                        <td>
                            <x-state-button></x-state-button>
                        </td>
                        <td>
                            {{ str_repeat('—', $item->getLevel() - 1) }}
                            <a href="{{ $nav->to('category_edit')->id($item->getId()) }}">
                                {{ $item->getTitle() }}
                            </a>
                        </td>
                        <td>
                            {{ $item->getLft() }}
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
