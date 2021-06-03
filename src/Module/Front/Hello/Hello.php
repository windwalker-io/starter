<?php

/**
 * Part of starter project.
 *
 * @copyright    Copyright (C) 2021 __ORGANIZATION__.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front\Hello;

use Windwalker\Core\Attributes\Controller;

/**
 * The Hello class.
 */
#[Controller(
    config: 'hello.config.php.tpl'
)]
class Hello
{
    //
}
