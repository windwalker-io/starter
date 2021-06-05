<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Entity;

use App\Enum\State;
use App\Module\Admin\Sakura\SakuraRepository;
use Windwalker\Core\DateTime\Chronos;
use Windwalker\Data\Collection;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\ORM\Attributes\AutoIncrement;
use Windwalker\ORM\Attributes\Cast;
use Windwalker\ORM\Attributes\CastNullable;
use Windwalker\ORM\Attributes\Column;
use Windwalker\ORM\Attributes\EntitySetup;
use Windwalker\ORM\Attributes\ManyToOne;
use Windwalker\ORM\Attributes\PK;
use Windwalker\ORM\Attributes\Table;
use Windwalker\ORM\Cast\JsonCast;
use Windwalker\ORM\EntityInterface;
use Windwalker\ORM\EntityTrait;
use Windwalker\ORM\Event\BeforeSaveEvent;
use Windwalker\ORM\Metadata\EntityMetadata;

/**
 * The Sakura class.
 */
#[Table('sakuras', 'sakura')]
class Sakura implements EntityInterface
{
    use EntityTrait;

    // #[Column('id'), PK, AutoIncrement]
    // protected ?int $id = null;

    #[Column('parent_id')]
    protected ?int $parentId = null;

    #[Column('extra')]
    protected mixed $extra = null;

    #[CastNullable(Chronos::class)]
    protected bool $enabled = false;
}
