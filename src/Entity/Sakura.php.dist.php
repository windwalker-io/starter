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
    #[Column('id'), PK, AutoIncrement]
    protected ?int $id = null;
    #[Column('title')]
    protected string $title = '';
    #[Column('category_id')]
    protected int $categoryId = 0;
    #[Column('state')]
    protected int $state = 0;
    #[Column('content')]
    protected string $content = '';
    #[Column('ordering')]
    protected int $ordering = 0;
    #[Column('created')]
    #[CastNullable(Chronos::class)]
    protected ?Chronos $created = null;
    public function getParentId() : ?int
    {
        return $this->parentId;
    }
    public function setParentId(?int $parentId) : static
    {
        $this->parentId = $parentId;
        return $this;
    }
    public function getExtra() : mixed
    {
        return $this->extra;
    }
    public function setExtra(mixed $extra) : static
    {
        $this->extra = $extra;
        return $this;
    }
    public function isEnabled() : bool
    {
        return $this->enabled;
    }
    public function setEnabled(bool $enabled) : static
    {
        $this->enabled = $enabled;
        return $this;
    }
    public function getId() : ?int
    {
        return $this->id;
    }
    public function setId(?int $id) : static
    {
        $this->id = $id;
        return $this;
    }
    public function getTitle() : string
    {
        return $this->title;
    }
    public function setTitle(string $title) : static
    {
        $this->title = $title;
        return $this;
    }
    public function getCategoryId() : int
    {
        return $this->categoryId;
    }
    public function setCategoryId(int $categoryId) : static
    {
        $this->categoryId = $categoryId;
        return $this;
    }
    public function getState() : int
    {
        return $this->state;
    }
    public function setState(int $state) : static
    {
        $this->state = $state;
        return $this;
    }
    public function getContent() : string
    {
        return $this->content;
    }
    public function setContent(string $content) : static
    {
        $this->content = $content;
        return $this;
    }
    public function getOrdering() : int
    {
        return $this->ordering;
    }
    public function setOrdering(int $ordering) : static
    {
        $this->ordering = $ordering;
        return $this;
    }
    public function getCreated() : ?Chronos
    {
        return $this->created;
    }
    public function setCreated(?Chronos $created) : static
    {
        $this->created = $created;
        return $this;
    }
}
