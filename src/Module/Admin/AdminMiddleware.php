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
use Unicorn\Script\UnicornScript;
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
        protected LangService $lang,
        protected UnicornScript $unicornScript
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
        $this->asset->importMap('@main', '@/admin/main.js');

        $this->asset->css('@vendor/@fortawesome/fontawesome-free/css/all.css');
        $this->asset->css('@awesome-checkbox');
        $this->asset->css('css/admin/app.css');

        $this->asset->js(
            'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js'
        )
            ->sri('sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf');

        $this->unicornScript->systemJS();
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
