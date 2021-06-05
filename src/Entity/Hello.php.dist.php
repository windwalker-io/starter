<?php

/**
* Part of starter project.
*
* @copyright    Copyright (C) 2021 __ORGANIZATION__.
* @license        __LICENSE__
*/

declare (strict_types=1);

namespace App\Entity;

use Windwalker\ORM\Attributes\AutoIncrement;
use Windwalker\ORM\Attributes\Column;
use Windwalker\ORM\Attributes\EntitySetup;
use Windwalker\ORM\Attributes\PK;
use Windwalker\ORM\Attributes\Table;
use Windwalker\ORM\EntityInterface;
use Windwalker\ORM\EntityTrait;
use Windwalker\ORM\Metadata\EntityMetadata;
/**
* The Hello class.
*/
#[Table('hellos', 'hello')]
class Hello implements EntityInterface
{
    use EntityTrait;
    #[Column('id'), PK, AutoIncrement]
    protected ?int $id = null;
    #[EntitySetup]
    public static function setup(EntityMetadata $metadata) : void
    {
        //
    }
    /**
     * @return  int|null
     */
    public function getId() : ?int
    {
        return $this->id;
    }
    /**
     * @param    int|null  $id
     *
     * @return    static  Return self to support chaining.
     */
    public function setId(?int $id) : static
    {
        $this->id = $id;
        return $this;
    }
}
