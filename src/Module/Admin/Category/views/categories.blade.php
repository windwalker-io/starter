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
$asset->js('vendor/systemjs/dist/system.js');

?>

@extends('admin.global.body')

@section('toolbar')
    @include('toolbar')
@stop

@push('script')
    {{--<script>--}}
    {{--    const state = {};--}}
    {{--</script>--}}
    <script type="module">
        window.gridState = {
            form: null,
            grid: null
        };

        // await import('@systemjs');
        const uni = await System.import('@unicorn/unicorn.js?{{ \Windwalker\uid() }}');
        const { UIBootstrap5 } = await System.import('@unicorn/ui/ui-bootstrap5.js');
        const a = await import('@alpinejs');

        u.use(UIBootstrap5);

        gridState.form = u.form('#grid-form');
        gridState.grid = u.grid('#grid-form');

        u.ui.bootstrap.tooltip();
    </script>
    <script>
        // const bs5 = System.import('@unicorn/ui/ui-bootstrap5.js?sdf').then(c => console.log(c));
    </script>
@endpush

@section('content')

    <form id="grid-form" action="" x-data="gridState" x-ref="gridForm" method="post">

        @component('@theme.grid.filter-bar', ['open' => $showFilters], get_defined_vars())

        @endcomponent

        <div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        State
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Order
                    </th>
                    <th>
                        Delete
                    </th>
                    <th>
                        ID
                    </th>
                </tr>
                </thead>

                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>

                        </td>
                        <td>
                            <button class="btn btn-light">
                                <span class="fa fa-check text-success"></span>
                            </button>
                        </td>
                        <td>
                            {{ str_repeat('—', $item->getLevel() - 1) }}
                            <a href="{{ $nav->to('category_edit')->id($item->getId()) }}">
                                {{ $item->getTitle() }}
                            </a>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
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
