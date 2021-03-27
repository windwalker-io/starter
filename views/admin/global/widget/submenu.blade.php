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
    <li class="nav-item {{ $menu->active('categories', ['type' => 'article']) }}">
        <a href="{{ $nav->to('categories', ['type' => 'article']) }}"
           class="nav-link {{ $menu->active('categories', ['type' => 'article']) }}">
            @lang('unicorn.article.categories')
        </a>
    </li>

    {{--<li class="nav-item {{ $menu->active('articles') }}">--}}
    {{--    <a href="{{ $nav->to('articles') }}" class="nav-link {{ $menu->active('articles') }}">--}}
    {{--        @lang('unicorn.articles.title')--}}
    {{--    </a>--}}
    {{--</li>--}}

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

    {{--<li class="nav-item {{ $menu->active('users') }}">--}}
    {{--    <a href="{{ $nav->to('users') }}" class="nav-link {{ $menu->active('users') }}">--}}
    {{--        @lang($warder->langPrefix . 'users.title')--}}
    {{--    </a>--}}
    {{--</li>--}}

    {{--<li class="nav-item {{ $menu->active('contacts') }}">--}}
    {{--    <a href="{{ $nav->to('contacts') }}" class="nav-link {{ $menu->active('contacts') }}">--}}
    {{--        @lang('unicorn.contacts.title')--}}
    {{--    </a>--}}
    {{--</li>--}}

    {{--<li class="nav-item {{ $menu->active('config', ['type' => 'core']) }}">--}}
    {{--    <a href="{{ $nav->to('config', ['type' => 'core']) }}" class="nav-link {{ $menu->active('config', ['type' => 'core']) }}">--}}
    {{--        @lang('unicorn.config.title')--}}
    {{--    </a>--}}
    {{--</li>--}}

    {{-- @muse-placeholder  submenu  Do not remove this line --}}
</ul>
