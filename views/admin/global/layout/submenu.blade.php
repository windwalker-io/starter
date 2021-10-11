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

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

$menu = $app->service(\Unicorn\Legacy\Html\MenuHelper::class);
?>

<h3 class="visible-xs-block d-sm-block d-md-none">
    @lang('unicorn.title.submenu')
</h3>

{{--<div id="user-info" class="text-center" style="padding-top: 50px; padding-bottom: 50px;">--}}
{{--    <div class="user-info-avatar-wrap text-center">--}}
{{--        <img class="img-circle rounded-circle" src="{{ $user->avatar }}" width="75" height="75" alt="Avatar">--}}
{{--    </div>--}}
{{--    <div class="user-info-detail">--}}
{{--        <h5 class="user-info-name my-3"><strong>{{ $user->name }}</strong></h5>--}}
{{--        <a class="btn btn-default btn-outline-secondary btn-sm user-info-profile-button"--}}
{{--           href="@route('user', ['id' => $user->id])">--}}
{{--            Profile--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</div>--}}

<ul id="submenu" class="nav nav-stacked nav-pills flex-column">
    <li class="nav-item {{ $menu->active('category_list', ['type' => 'article']) }}">
        <a href="{{ $nav->to('category_list', ['type' => 'article']) }}"
           class="nav-link {{ $menu->active('category_list', ['type' => 'article']) }}">
            @lang('luna.article.category.list')
        </a>
    </li>

    <li class="nav-item {{ $menu->active('article_list') }}">
        <a href="{{ $nav->to('article_list') }}" class="nav-link {{ $menu->active('article_list') }}">
            @lang('luna.article.list.title')
        </a>
    </li>

    {{--<li class="nav-item {{ $menu->active('pages') }}">--}}
    {{--    <a href="{{ $nav->to('pages') }}" class="nav-link {{ $menu->active('pages') }}">--}}
    {{--        @lang('unicorn.pages.title')--}}
    {{--    </a>--}}
    {{--</li>--}}

    {{--<li class="nav-item {{ $menu->active('tags') }}">--}}
    {{--    <a href="{{ $nav->to('tags') }}" class="nav-link {{ $menu->active('tags') }}">--}}
    {{--        @lang('unicorn.tags.title')--}}
    {{--    </a>--}}
    {{--</li>--}}

    {{--<li class="nav-item {{ $menu->active('comments') }}">--}}
    {{--    <a href="{{ $nav->to('comments', ['type' => 'article']) }}"--}}
    {{--       class="nav-link {{ $menu->active('comments') }}">--}}
    {{--        @lang('unicorn.comments.title')--}}
    {{--    </a>--}}
    {{--</li>--}}

    {{--<li class="nav-item {{ $menu->active('languages') }}">--}}
    {{--    <a href="{{ $nav->to('languages') }}" class="nav-link {{ $menu->active('languages') }}">--}}
    {{--        @lang('unicorn.languages.title')--}}
    {{--    </a>--}}
    {{--</li>--}}

    {{--<li class="nav-item {{ $menu->active('modules') }}">--}}
    {{--    <a href="{{ $nav->to('modules') }}" class="nav-link {{ $menu->active('modules') }}">--}}
    {{--        @lang('unicorn.modules.title')--}}
    {{--    </a>--}}
    {{--</li>--}}

    {{--<li class="nav-item {{ $menu->active('menus', ['type' => 'mainmenu']) }}">--}}
    {{--    <a href="{{ $nav->to('menus', ['type' => 'mainmenu']) }}"--}}
    {{--        class="nav-link {{ $menu->active('menus', ['type' => 'mainmenu']) }}">--}}
    {{--        @lang('unicorn.menu.manager.title', __('unicorn.menu.type.mainmenu'))--}}
    {{--    </a>--}}
    {{--</li>--}}

    <li class="nav-item {{ $menu->active('user_list') }}">
        <a href="{{ $nav->to('user_list') }}" class="nav-link {{ $menu->active('user_list') }}">
            @lang('luna.users.title')
        </a>
    </li>

    {{--<li class="nav-item {{ $menu->active('contacts') }}">--}}
    {{--    <a href="{{ $nav->to('contacts') }}" class="nav-link {{ $menu->active('contacts') }}">--}}
    {{--        @lang('unicorn.contacts.title')--}}
    {{--    </a>--}}
    {{--</li>--}}

    <li class="nav-item {{ $menu->active('config_core') }}">
        <a href="{{ $nav->to('config_core') }}"
            class="nav-link {{ $menu->active('config_core') }}">
            @lang('luna.config.title', $lang('luna.config.type.core'))
        </a>
    </li>

    {{-- @muse-placeholder  submenu  Do not remove this line --}}
</ul>
