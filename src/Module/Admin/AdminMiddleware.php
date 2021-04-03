<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Middleware\AbstractLifecycleMiddleware;

/**
 * The FrontMiddleware class.
 */
class AdminMiddleware extends AbstractLifecycleMiddleware
{
    /**
     * FrontMiddleware constructor.
     *
     * @param  AppContext    $app
     * @param  AssetService  $asset
     * @param  LangService   $lang
     */
    public function __construct(
        protected AppContext $app,
        protected AssetService $asset,
        protected LangService $lang
    ) {
    }

    /**
     * prepareExecute
     *
     * @param  ServerRequestInterface  $request
     *
     * @return  void
     */
    protected function preprocess(ServerRequestInterface $request): void
    {
        // $this->asset->js('test/test.js');
        // $this->asset->js('https://use.fontawesome.com/releases/v5.15.3/js/all.js', ['sri' => 'sha384-haqrlim99xjfMxRP6EWtafs0sB1WKcMdynwZleuUSwJR0mDeRYbhtY+KPMr+JL6f']);
        $this->asset->css(
            'https://use.fontawesome.com/releases/v5.15.3/css/all.css',
            ['sri' => 'sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk']
        );
        $this->asset->css('@awesome-checkbox');

        $this->asset->js(
            'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js'
        );

        $this->asset->js('@systemjs');
        $this->asset->js('js/admin/main.js');
    }

    /**
     * postExecute
     *
     * @param  ResponseInterface  $response
     *
     * @return  mixed
     */
    protected function postProcess(ResponseInterface $response): void
    {
    }
}
