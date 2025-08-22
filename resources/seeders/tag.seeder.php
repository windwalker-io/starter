<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\Tag;
use Lyrasoft\Luna\Entity\TagMap;
use Lyrasoft\Luna\Entity\User;
use Windwalker\Core\Seed\AbstractSeeder;
use Windwalker\Core\Seed\SeedClear;
use Windwalker\Core\Seed\SeedImport;
use Windwalker\ORM\EntityMapper;
use Windwalker\Utilities\Utf8String;

return new /** Tag Seeder */ class extends AbstractSeeder {
    #[SeedImport]
    public function import(): void
    {
        $faker = $this->faker('en_US');

        $userIds = $this->orm->findColumn(User::class, 'id', [])->dump();
        /** @var EntityMapper<Tag> $mapper */
        $mapper = $this->orm->mapper(Tag::class);

        foreach (range(1, 30) as $i) {
            $item = $mapper->createEntity();

            $item->title = Utf8String::ucfirst($faker->word);
            $item->state = 1;
            $item->created = $created = $faker->dateTimeThisYear;
            $item->modified = $created->modify('+10days');
            $item->createdBy = (int) $faker->randomElement($userIds);
            $item->modifiedBy = (int) $faker->randomElement($userIds);

            $mapper->createOne($item);

            $this->printCounting();
        }
    }

    #[SeedClear]
    public function clear(): void
    {
        $this->truncate(Tag::class, TagMap::class);
    }
};
