<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin;

use Lyrasoft\Luna\Script\FontAwesomeScript;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Unicorn\Script\UnicornScript;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\Middleware\AbstractLifecycleMiddleware;

/**
 * The FrontMiddleware class.
 */
class AdminMiddleware extends AbstractLifecycleMiddleware
{
    public function __construct(
        protected AppContext $app,
        protected AssetService $asset,
        protected UnicornScript $unicornScript,
        protected FontAwesomeScript $fontAwesomeScript,
        protected HtmlFrame $htmlFrame,
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
        // Unicorn
        $this->unicornScript->init('js/admin/main.js');

        // Font Awesome
        $this->fontAwesomeScript->cssFont(FontAwesomeScript::DEFAULT_SET);

        // Bootstrap
        $this->asset->css('vendor/bootstrap/dist/css/bootstrap.min.css');
        $this->asset->js('vendor/bootstrap/dist/js/bootstrap.bundle.min.js');

        // Main
        $this->asset->css('css/admin/main.css');

        // HtmlFrame
        $this->htmlFrame->setFavicon($this->asset->path('images/admin/favicon.png'));
    }

    // protected function checkAccess(): bool
    // {
    //     $user = $this->app->service(UserService::class)->getUser();
    //
    //     return $user->isLogin();
    // }
    //
    // public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    // {
    //     $user = $this->app->service(UserService::class)->getUser();
    //
    //     if (!$user->isLogin()) {
    //         return $this->app->service(Navigator::class)->redirectTo('front::home');
    //     }
    //
    //     return parent::process($request, $handler);
    // }

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
