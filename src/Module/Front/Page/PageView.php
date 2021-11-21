<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front\Page;

use Lyrasoft\Luna\Entity\Page;
use Lyrasoft\Luna\PageBuilder\PageService;
use Unicorn\Enum\BasicState;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\Router\Exception\RouteNotFoundException;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\Filesystem\Path;
use Windwalker\ORM\ORM;

/**
 * The PageView class.
 */
#[ViewModel(
    layout: 'page',
    js: 'page.js'
)]
class PageView implements ViewModelInterface
{
    /**
     * Constructor.
     */
    public function __construct(
        protected ORM $orm,
        protected HtmlFrame $htmlFrame,
        protected PageService $pageService
    ) {
        //
    }

    /**
     * Prepare View.
     *
     * @param  AppContext  $app   The web app context.
     * @param  View        $view  The view object.
     *
     * @return  mixed
     */
    public function prepare(AppContext $app, View $view): array
    {
        $path = $app->input('path');

        if (!$path) {
            throw new RouteNotFoundException();
        }

        $ref = new \ReflectionClass($this);
        $file = dirname($ref->getFileName()) . '/views/' . Path::normalize($path) . '.blade.php';

        if (is_file($file)) {
            $layout = Path::normalize($path, '.');
            $view->setLayout($layout);

            return compact('layout');
        }

        /** @var Page|null $page */
        $page = $this->orm->mapper(Page::class)->findOne(['alias' => $path]);

        if (!$page) {
            throw new RouteNotFoundException();
        }

        if (
            $page->getState()->equals(BasicState::UNPUBLISHED())
            && !$this->pageService->secretVerify($page->getId(), $app->input('preview'))
        ) {
            throw new RouteNotFoundException();
        }

        $rows = $page->getContent();
        $css = $page->getCss();

        $this->prepareMeta($page, $page->getMeta());

        return compact(
            'rows',
            'css',
            'page'
        );
    }

    public function prepareMeta(Page $page, array $meta): void
    {
        $this->htmlFrame->setDescription($meta['meta_desc'] ?: $meta['og_desc']);
        $this->htmlFrame->addMetadata('keywords', $meta['meta_keyword'], true);

        if ($page->getImage()) {
            $this->htmlFrame->setCoverImages($page->getImage());
        }

        if ($meta['meta_title']) {
            $this->htmlFrame->setTitle($meta['meta_title']);
        } else {
            $this->htmlFrame->setTitle($page->getTitle());
        }

        if ($meta['og_title']) {
            $this->htmlFrame->addOpenGraph('og:title', $meta['og_title'], true);
        }
    }
}
