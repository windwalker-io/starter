<?php

declare(strict_types=1);

namespace App\Entity;

use Unicorn\Enum\BasicState;
use Windwalker\Core\DateTime\Chronos;
use Windwalker\ORM\Attributes\AutoIncrement;
use Windwalker\ORM\Attributes\Cast;
use Windwalker\ORM\Attributes\CastNullable;
use Windwalker\ORM\Attributes\Column;
use Windwalker\ORM\Attributes\EntitySetup;
use Windwalker\ORM\Attributes\PK;
use Windwalker\ORM\Attributes\Table;
use Windwalker\ORM\Cast\JsonCast;
use Windwalker\ORM\EntityInterface;
use Windwalker\ORM\EntityTrait;
use Windwalker\ORM\Metadata\EntityMetadata;

#[Table('sun_flowers', 'sun_flower')]
#[\AllowDynamicProperties]
class SunFlower implements EntityInterface
{
    use EntityTrait;
    #[Column('id'), PK, AutoIncrement]
    protected ?int $id = null;
    #[Column('category_id')]
    protected int $categoryId = 0;
    #[Column('title')]
    protected string $title = '';
    #[Column('state')]
    #[Cast('int')]
    #[Cast(BasicState::class)]
    protected BasicState $state;
    #[Column('alias')]
    protected string $alias = '';
    #[Column('image')]
    protected string $image = '';
    #[Column('ordering')]
    protected int $ordering = 0;
    #[Column('attachments')]
    #[Cast(JsonCast::class)]
    protected array $attachments = array();
    #[Column('content')]
    protected string $content = '';
    #[Column('created')]
    #[CastNullable(Chronos::class)]
    protected ?Chronos $created = null;
    #[Column('created_by')]
    protected int $createdBy = 0;
    #[Column('modified')]
    #[CastNullable(Chronos::class)]
    protected ?Chronos $modified = null;
    #[Column('modified_by')]
    protected int $modifiedBy = 0;
    #[Column('params')]
    #[Cast(JsonCast::class)]
    protected array $params = array();
    public function getId() : ?int
    {
        return $this->id;
    }
    public function setId(?int $id) : static
    {
        $this->id = $id;
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
    public function getTitle() : string
    {
        return $this->title;
    }
    public function setTitle(string $title) : static
    {
        $this->title = $title;
        return $this;
    }
    public function getState() : BasicState
    {
        return $this->state;
    }
    public function setState(int|BasicState $state) : static
    {
        $this->state = BasicState::wrap($state);
        return $this;
    }
    public function getAlias() : string
    {
        return $this->alias;
    }
    public function setAlias(string $alias) : static
    {
        $this->alias = $alias;
        return $this;
    }
    public function getImage() : string
    {
        return $this->image;
    }
    public function setImage(string $image) : static
    {
        $this->image = $image;
        return $this;
    }
    public function getAttachments() : array
    {
        return $this->attachments;
    }
    public function setAttachments(array $attachments) : static
    {
        $this->attachments = $attachments;
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
    public function getCreated() : ?Chronos
    {
        return $this->created;
    }
    public function setCreated(\DateTimeInterface|string|null $created) : static
    {
        $this->created = Chronos::wrapOrNull($created);
        return $this;
    }
    public function getCreatedBy() : int
    {
        return $this->createdBy;
    }
    public function setCreatedBy(int $createdBy) : static
    {
        $this->createdBy = $createdBy;
        return $this;
    }
    public function getModified() : ?Chronos
    {
        return $this->modified;
    }
    public function setModified(\DateTimeInterface|string|null $modified) : static
    {
        $this->modified = Chronos::wrapOrNull($modified);
        return $this;
    }
    public function getModifiedBy() : int
    {
        return $this->modifiedBy;
    }
    public function setModifiedBy(int $modifiedBy) : static
    {
        $this->modifiedBy = $modifiedBy;
        return $this;
    }
    public function getParams() : array
    {
        return $this->params;
    }
    public function setParams(array $params) : static
    {
        $this->params = $params;
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
}
