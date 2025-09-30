<?php

declare(strict_types=1);

namespace App\Seeder;

use App\Entity\SunFlower;
use Windwalker\Core\Seed\AbstractSeeder;
use Windwalker\Core\Seed\SeedClear;
use Windwalker\Core\Seed\SeedImport;

return new /** SunFlower Seeder */ class extends AbstractSeeder {
    #[SeedImport]
    public function import(): void
    {
        $faker = $this->faker('en_US');

        $mapper = $this->orm->mapper(SunFlower::class);

        foreach (range(1, 50) as $i) {
            $item = new SunFlower();
            $item->setTitle($faker->sentence(2));
            $item->setCategoryId(11);
            $item->setState(1);
            $item->setContent($faker->paragraph(5));
            $item->setImage($faker->imageUrl());
            $item->setAttachments(
                [
                    'url' => $faker->imageUrl()
                ]
            );
            $item->setCreated($faker->dateTimeThisYear());
            $item->setCreatedBy(1);
            $item->setModified($faker->dateTimeThisMonth());
            $item->setCreatedBy(4);

            $mapper->createOne($item);

            $this->printCounting();
        }
    }

    #[SeedClear]
    public function clear(): void
    {
        $this->truncate(SunFlower::class);
    }
};
