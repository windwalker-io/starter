<?php
/**
 * @var $helper \Admin\Helper\MenuHelper
 * @var $router \Windwalker\Core\Router\PackageRouter
 */
?>

<h3 class="visible-xs-block">
    @translate('phoenix.title.submenu')
</h3>

<ul class="nav nav-stacked nav-pills">
    <li class="{{ $helper->menu->active('categories') }}">
        <a href="{{ $router->html('categories', array('type' => 'article')) }}">
            @translate($lunaPrefix . 'categories.title')
        </a>
    </li>

    <li class="{{ $helper->menu->active('articles') }}">
        <a href="{{ $router->html('articles') }}">
            @translate($lunaPrefix . 'articles.title')
        </a>
    </li>

    <li class="{{ $helper->menu->active('tags') }}">
        <a href="{{ $router->html('tags') }}">
            @translate($lunaPrefix . 'tags.title')
        </a>
    </li>

    <li class="{{ $helper->menu->active('comments') }}">
        <a href="{{ $router->html('comments', array('type' => 'article')) }}">
            @translate($lunaPrefix . 'comments.title')
        </a>
    </li>

    <li class="{{ $helper->menu->active('languages') }}">
        <a href="{{ $router->html('languages') }}">
            @translate($lunaPrefix . 'languages.title')
        </a>
    </li>

    <li class="{{ $helper->menu->active('modules') }}">
        <a href="{{ $router->html('modules') }}">
            @translate($lunaPrefix . 'modules.title')
        </a>
    </li>

    <li class="{{ $helper->menu->active('users') }}">
        <a href="{{ $router->html('users') }}">
            @translate($warderPrefix . 'users.title')
        </a>
    </li>

    {{-- @muse-placeholder  submenu  Do not remove this line --}}
</ul>
