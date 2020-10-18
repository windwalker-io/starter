<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $this  HelloView
 * @var $app   AppContext
 * @var $uri   SystemUri
 */

use App\Front\Test\HelloView;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Router\SystemUri;
?>

<a href="{{ $app->to('sakura_edit') }}">Edit</a>
