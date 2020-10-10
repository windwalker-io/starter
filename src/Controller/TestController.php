<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Controller;

use Windwalker\Core\Manager\CacheManager;
use Windwalker\Core\Manager\CryptoManager;
use Windwalker\Crypt\HiddenString;
use Windwalker\Crypt\Key;

/**
 * The TestController class.
 */
class TestController
{
    public function hello($id, ?string $name, CacheManager $cacheManager, CryptoManager $cryptoManager)
    {
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
}
