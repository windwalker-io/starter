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
use Windwalker\Queue\Queue;

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
        AppContext $context,
        CacheManager $cacheManager,
        CryptoManager $cryptoManager
    ): mixed {
        var_dump($id, $name);

        $data = $context->input(
            id: 'range: max=1',
            name: 'raw'
        );
        
        show($data);exit(' @Checkpoint');

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

    public function get(ServerRequestInterface $request)
    {
        show($request);
    }
}
