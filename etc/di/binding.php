<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

return [
    \Windwalker\Renderer\BladeRenderer::class,
    \Windwalker\Edge\Cache\EdgeFileCache::class => fn () => new \Windwalker\Edge\Cache\EdgeFileCache(__DIR__ . '/cache')
];
