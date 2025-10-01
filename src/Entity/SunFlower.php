<?php

declare(strict_types=1);

namespace App\Entity;

use Unicorn\Enum\BasicState;
use Windwalker\Core\DateTime\Chronos;
use Windwalker\Core\DateTime\ServerTimeCast;
use Windwalker\ORM\Attributes\AutoIncrement;
use Windwalker\ORM\Attributes\CastNullable;
use Windwalker\ORM\Attributes\Column;
use Windwalker\ORM\Attributes\EntitySetup;
use Windwalker\ORM\Attributes\JsonObject;
use Windwalker\ORM\Attributes\PK;
use Windwalker\ORM\Attributes\Table;
use Windwalker\ORM\EntityInterface;
use Windwalker\ORM\EntityTrait;
use Windwalker\ORM\Metadata\EntityMetadata;

// phpcs:disable
// todo: remove this when phpcs supports 8.4
#[Table('sun_flowers', 'sun_flower')]
#[\AllowDynamicProperties]
class SunFlower implements EntityInterface
{
    use EntityTrait;

    #[Column('id'), PK, AutoIncrement]
    public ?int $id = null;

    #[Column('category_id')]
    public int $categoryId = 0;

    #[Column('title')]
    public string $title = '';

    #[Column('state')]
    public BasicState $state {
        set(BasicState|int $value) => $this->state = BasicState::wrap($value);
    }

    #[Column('alias')]
    public string $alias = '';

    #[Column('image')]
    public string $image = '';

    #[Column('ordering')]
    public int $ordering = 0;

    #[Column('attachments')]
    #[JsonObject]
    public array $attachments = [];

    #[Column('content')]
    public string $content = '';

    #[Column('created')]
    #[CastNullable(ServerTimeCast::class)]
    public ?Chronos $created = null {
        set(\DateTimeInterface|string|null $value) => $this->created = Chronos::tryWrap($value);
    }

    #[Column('created_by')]
    public int $createdBy = 0;

    #[Column('modified')]
    #[CastNullable(ServerTimeCast::class)]
    public ?Chronos $modified = null {
        set(\DateTimeInterface|string|null $value) => $this->modified = Chronos::tryWrap($value);
    }

    #[Column('modified_by')]
    public int $modifiedBy = 0;

    #[Column('params')]
    #[JsonObject]
    public array $params = [];

    #[EntitySetup]
    public static function setup(EntityMetadata $metadata): void
    {
        //
    }
}
