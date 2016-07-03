<?php
/**
 * @var $helper \Admin\Helper\MenuHelper
 * @var $router \Windwalker\Core\Router\PackageRouter
 */
?>

<h3 class="visible-xs-block">
    @translate('phoenix.title.submenu')
</h3>

<div id="submenu" class="list-group">
    <a href="{{ $router->route('categories', ['type' => 'article']) }}"
        class="list-group-item {{ $helper->menu->active('categories', ['type' => 'article']) }}">
        @translate($luna->langPrefix . 'categories.title')
    </a>

    <a href="{{ $router->route('articles') }}"
        class="list-group-item {{ $helper->menu->active('articles') }}">
            @translate($luna->langPrefix . 'articles.title')
    </a>

    <a href="{{ $router->route('tags') }}"
        class="list-group-item {{ $helper->menu->active('tags') }}">
        @translate($luna->langPrefix . 'tags.title')
    </a>

    <a href="{{ $router->route('comments', array('type' => 'article')) }}"
        class="list-group-item {{ $helper->menu->active('comments') }}">
        @translate($luna->langPrefix . 'comments.title')
    </a>

    <a href="{{ $router->route('languages') }}"
        class="list-group-item {{ $helper->menu->active('languages') }}">
        @translate($luna->langPrefix . 'languages.title')
    </a>

    <a href="{{ $router->route('modules') }}"
        class="list-group-item {{ $helper->menu->active('modules') }}">
        @translate($luna->langPrefix . 'modules.title')
    </a>

    <a href="{{ $router->route('users') }}"
        class="list-group-item {{ $helper->menu->active('users') }}">
        @translate($warder->langPrefix . 'users.title')
    </a>

    {{-- @muse-placeholder  submenu  Do not remove this line --}}
</div>
