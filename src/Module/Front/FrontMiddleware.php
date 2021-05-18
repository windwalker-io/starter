<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Middleware\AbstractLifecycleMiddleware;

/**
 * The FrontMiddleware class.
 */
class FrontMiddleware extends AbstractLifecycleMiddleware
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
     * @return  mixed
     */
    protected function preprocess(ServerRequestInterface $request): mixed
    {
        $this->asset->js('test/test.js');
    }

    /**
     * postExecute
     *
     * @param  ResponseInterface  $response
     *
     * @return  mixed
     */
    protected function postProcess(ResponseInterface $response): mixed
    {
    }
}
