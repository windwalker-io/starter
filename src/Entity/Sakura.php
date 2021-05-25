<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Entity;

use Windwalker\Core\DateTime\Chronos;
use Windwalker\ORM\Attributes\AutoIncrement;
use Windwalker\ORM\Attributes\CastNullable;
use Windwalker\ORM\Attributes\Column;
use Windwalker\ORM\Attributes\ManyToOne;
use Windwalker\ORM\Attributes\PK;
use Windwalker\ORM\Attributes\Table;
use Windwalker\ORM\EntityInterface;
use Windwalker\ORM\EntityTrait;

/**
 * The Sakura class.
 */
#[Table('sakuras', 'sakura')]
class Sakura implements EntityInterface
{
    use EntityTrait;

    #[Column('id'), PK, AutoIncrement]
    protected ?int $id = null;

    #[Column('category_id')]
    protected int $categoryId = 0;

    #[Column('title')]
    protected string $title = '';

    #[Column('content')]
    protected string $content = '';

    #[Column('ordering')]
    protected int $ordering = 0;

    #[Column('created')]
    #[CastNullable(Chronos::class)]
    protected ?Chronos $created = null;

    #[ManyToOne(
        Category::class,
        category_id: 'id'
    )]
    protected ?Category $category = null;

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
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param  int  $categoryId
     *
     * @return  static  Return self to support chaining.
     */
    public function setCategoryId(int $categoryId): static
    {
        $this->categoryId = $categoryId;

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
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param  string  $content
     *
     * @return  static  Return self to support chaining.
     */
    public function setContent(string $content): static
    {
        $this->content = $content;

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
    public function getOrdering(): int
    {
        return $this->ordering;
    }

    /**
     * @param  int  $ordering
     *
     * @return  static  Return self to support chaining.
     */
    public function setOrdering(int $ordering): static
    {
        $this->ordering = $ordering;

        return $this;
    }
}
