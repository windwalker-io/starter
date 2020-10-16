<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace Front\Test;

use Psr\Http\Message\ServerRequestInterface;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Manager\CacheManager;
use Windwalker\Core\Manager\CryptoManager;
use Windwalker\Crypt\HiddenString;
use Windwalker\Crypt\Key;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\Queue\Queue;
use Windwalker\Renderer\CompositeRenderer;

#[Controller(
    config: __DIR__ . '/test.config.php'
)]
class TestController
{
    /**
     * TestController constructor.
     */
    public function __construct(Queue $queue)
    {
        show($queue);
    }

    public function hello(
        string $id,
        ?string $name,
        AppContext $app,
        CacheManager $cacheManager,
        CryptoManager $cryptoManager
    ): mixed {
        var_dump($id, $name);

        $cache = $cacheManager->get();
        $cipher = $cryptoManager->get();

        $key = new Key(
            base64_decode(
                $cache->call('test_key', fn() => base64_encode($cipher::generateKey()->get()))
            )
        );

        $enc = $cache->call(
            'hello',
            fn() => $cipher->encrypt(
                new HiddenString('Hello World Controller'),
                $key
            )
        );

        return $cipher->decrypt($enc, $key);
    }

    public function index(
        AppContext $app,
        #[Autowire] CompositeRenderer $renderer
    ) {
        [$name, $id] = $app->input(
            name: 'raw',
            id: 'range: max=500',
        )->values();

        $renderer->addPath(WINDWALKER_VIEWS . '/front');
        $renderer->addFileExtensions('edge', 'blade.php');

        return $renderer->render('hello');
    }

    public function save(AppContext $app)
    {
        $req = $app->getRequest();
        $files = $req->getUploadedFiles();
        
        show($files);exit(' @Checkpoint');
    }
}
