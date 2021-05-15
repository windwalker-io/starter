<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Entity;

use App\Module\Admin\Category\CategoryState;
use App\Module\Admin\Category\CategoryStateWorkflow;
use Windwalker\Core\DateTime\Chronos;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\ORM\Attributes\AutoIncrement;
use Windwalker\ORM\Attributes\Cast;
use Windwalker\ORM\Attributes\CastNullable;
use Windwalker\ORM\Attributes\Column;
use Windwalker\ORM\Attributes\EntitySetup;
use Windwalker\ORM\Attributes\NestedSet;
use Windwalker\ORM\Attributes\PK;
use Windwalker\ORM\Cast\JsonCast;
use Windwalker\ORM\Event\WatchEvent;
use Windwalker\ORM\Metadata\EntityMetadata;
use Windwalker\ORM\Nested\NestedPathableInterface;
use Windwalker\ORM\Nested\NestedPathableTrait;

/**
 * The Category class.
 */
#[NestedSet('categories', 'category')]
class Category implements NestedPathableInterface
{
    use NestedPathableTrait;

    #[Column('id'), PK, AutoIncrement]
    protected ?int $id = null;

    #[Column('type')]
    protected string $type = '';

    #[Column('title')]
    protected string $title = '';

    #[Column('image')]
    protected string $image = '';

    #[Column('description')]
    protected string $description = '';

    #[Column('state')]
    #[
        Cast('int'),
        Cast(CategoryState::class)
    ]
    protected ?CategoryState $state = null;

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

    #[Column('language')]
    protected string $language = '';

    #[Column('params')]
    #[Cast(JsonCast::class)]
    protected array $params = [];

    #[EntitySetup]
    public static function setup(
        EntityMetadata $metadata,
        #[Autowire] CategoryStateWorkflow $stateWorkflow
    ) {
        $stateWorkflow->listen($metadata);

        // $metadata->watch(
        //     'state',
        //     function (WatchEvent $event) use ($metadata, $stateWorkflow) {
        //         $stateWorkflow->build($metadata->getORM())->
        //     }
        // );
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryKeyValue(): int
    {
        return $this->getId();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param  int|null  $id
     *
     * @return  static  Return self to support chaining.
     */
    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param  string  $type
     *
     * @return  static  Return self to support chaining.
     */
    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param  string  $title
     *
     * @return  static  Return self to support chaining.
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param  string  $image
     *
     * @return  static  Return self to support chaining.
     */
    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param  string  $description
     *
     * @return  static  Return self to support chaining.
     */
    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Chronos|null
     */
    public function getCreated(): ?Chronos
    {
        return $this->created;
    }

    /**
     * @param  Chronos|null  $created
     *
     * @return  static  Return self to support chaining.
     */
    public function setCreated(?Chronos $created): static
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param  int  $createdBy
     *
     * @return  static  Return self to support chaining.
     */
    public function setCreatedBy(int $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Chronos|null
     */
    public function getModified(): ?Chronos
    {
        return $this->modified;
    }

    /**
     * @param  Chronos|null  $modified
     *
     * @return  static  Return self to support chaining.
     */
    public function setModified(?Chronos $modified): static
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * @return int
     */
    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }

    /**
     * @param  int  $modifiedBy
     *
     * @return  static  Return self to support chaining.
     */
    public function setModifiedBy(int $modifiedBy): static
    {
        $this->modifiedBy = $modifiedBy;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param  string  $language
     *
     * @return  static  Return self to support chaining.
     */
    public function setLanguage(string $language): static
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param  array  $params
     *
     * @return  static  Return self to support chaining.
     */
    public function setParams(array $params): static
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return CategoryState
     */
    public function getState(): CategoryState
    {
        return $this->state ??= CategoryState::UNPUBLISHED();
    }

    /**
     * @param  CategoryState  $state
     *
     * @return  static  Return self to support chaining.
     */
    public function setState(CategoryState $state): static
    {
        $this->state = $state;

        return $this;
    }
}
