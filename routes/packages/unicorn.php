<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Routes;

use Unicorn\Module\FileUpload\FileUploadController;
use Windwalker\Core\Middleware\JsonApiMiddleware;
use Windwalker\Core\Middleware\JsonResponseMiddleware;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->post('file_upload', '/file/upload')
    ->controller(FileUploadController::class)
    ->middleware(JsonApiMiddleware::class);
