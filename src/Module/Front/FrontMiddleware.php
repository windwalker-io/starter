<?php

declare(strict_types=1);

namespace App\Module\Front;

use Psr\Cache\InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\Language\TranslatorTrait;
use Windwalker\Core\Middleware\AbstractLifecycleMiddleware;
use Windwalker\DI\Exception\DefinitionException;

class FrontMiddleware extends AbstractLifecycleMiddleware
{
    use TranslatorTrait;

    public function __construct(
        protected AppContext $app,
        protected AssetService $asset,
        protected HtmlFrame $htmlFrame,
    ) {
    }

    /**
     * prepareExecute
     *
     * @param  ServerRequestInterface  $request
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws DefinitionException
     */
    protected function preprocess(ServerRequestInterface $request): void
    {
        $this->asset->importMap('@main', '@vite/src/front/main.ts');
        $this->asset->module('@vite/src/front/main.ts');

        $this->asset->css('@vite/scss/front/bootstrap.scss');
        $this->asset->css('@vite/scss/front/main.scss');

        $this->htmlFrame->setFavicon($this->asset->path('images/favicon.png'));
        $this->htmlFrame->setSiteName('Windwalker');
        $this->htmlFrame->setDescription('Windwalker Site Description.');
        // $this->htmlFrame->setCoverImages($this->asset->root('...'));
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
