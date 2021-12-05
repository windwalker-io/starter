<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Menu;

use Windwalker\Core\Application\AppContext;
use Lyrasoft\Luna\Menu\MenuBuilder;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Language\LangService;

/**
 * @var MenuBuilder $menu
 * @var AppContext $app
 * @var Navigator $nav
 * @var LangService $lang
 */

// Category
$menu->link(
    $lang('luna.article.category.list'),
    $nav->to('category_list', ['type' => 'article'])
);

// Article
$menu->link(
    $lang('unicorn.title.grid', title: $lang('luna.article.title')),
    $nav->to('article_list')
);

// Page
$menu->link(
    $lang('unicorn.title.grid', title: $lang('luna.page.title')),
    $nav->to('page_list')
);

// Tag
$menu->link(
    $lang('unicorn.title.grid', title: $lang('luna.tag.title')),
    $nav->to('tag_list')
);

// Menu
$menu->link(
    $lang('luna.menu.manager.title', title: $lang('luna.menu.type.mainmenu')),
    $nav->to('menu_list', ['type' => 'mainmenu'])
);

// User
$menu->link(
    $lang('unicorn.title.grid', title: $lang('luna.user.title')),
    $nav->to('user_list')
);

// Config Core
$menu->link(
    $lang('luna.config.title', $lang('luna.config.type.core')),
    $nav->to('config_core')
);
