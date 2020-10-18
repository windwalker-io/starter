<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Front\Sakura;

use App\Front\Test\HelloView;
use Psr\Http\Message\ResponseInterface;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\View\View;

/**
 * The Sakura class.
 */
#[Controller]
class Sakura
{
    public function index(
        string $view,
        AppContext $app,
    ) {
        /** @var View $vm */
        $vm = $app->service($view);

        return $vm->render(['foo' => 'bar']);
    }

    public function save(AppContext $app): ResponseInterface
    {
        return $app->to('sakura')->go();
    }
}
