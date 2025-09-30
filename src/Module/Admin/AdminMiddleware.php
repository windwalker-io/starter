<?php

declare(strict_types=1);

namespace App\Module\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Middleware\AbstractLifecycleMiddleware;

class AdminMiddleware extends AbstractLifecycleMiddleware
{
    public function __construct(
        protected AppContext $app,
        protected AssetService $asset,
    ) {
    }

    /**
     * prepareExecute
     *
     * @param ServerRequestInterface $request
     *
     * @return  mixed
     */
    protected function preprocess(ServerRequestInterface $request): void
    {
        $this->asset->importMap('@main', '@vite/src/admin/main.ts');
        $this->asset->module('@vite/src/admin/main.ts');

        $this->asset->css('@vite/scss/admin/main.scss');
    }

    /**
     * postExecute
     *
     * @param ResponseInterface $response
     *
     * @return  mixed
     */
    protected function postProcess(ResponseInterface $response): void
    {
    }
}
