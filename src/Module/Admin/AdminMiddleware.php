<?php

declare(strict_types=1);

namespace App\Module\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Unicorn\Script\UnicornScript;
use Unicorn\UnicornPackage;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Middleware\AbstractLifecycleMiddleware;

class AdminMiddleware extends AbstractLifecycleMiddleware
{
    public function __construct(
        protected AppContext $app,
        protected AssetService $asset,
        protected UnicornScript $unicornScript,
        protected LangService $langService,
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
        $this->langService->loadAllFromVendor(UnicornPackage::class, 'ini');

        $this->unicornScript->init('@vite/src/admin/main.ts');

        $this->asset->css('vendor/@fortawesome/fontawesome-free/css/all.css');
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
