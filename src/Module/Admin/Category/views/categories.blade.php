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

?>

@extends('admin.global.body')

@section('content')

    <form action="">

        @component('@theme.grid.filter-bar', [], get_defined_vars())

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
