<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Sakura\Form;

use App\Entity\Sakura;
use Unicorn\Field\ModalField;
use Windwalker\Core\Router\RouteUri;

/**
 * The SakuraModalField class.
 */
class SakuraModalField extends ModalField
{
    protected ?string $table = Sakura::class;

    protected string|RouteUri|null $route = 'sakura_list';
}
