<?php

declare(strict_types=1);

namespace App\Seeder;

use App\Entity\Acme;
use Windwalker\Core\Seed\AbstractSeeder;
use Windwalker\Core\Seed\SeedClear;
use Windwalker\Core\Seed\SeedImport;

return new /** Acme Seeder */ class extends AbstractSeeder {
    #[SeedImport]
    public function import(): void
    {
        $faker = $this->faker('en_US');

        $mapper = $this->orm->mapper(Acme::class);

        foreach (range(1, 15) as $i) {
            $acme = new Acme();
            $acme->setTitle($faker->sentence(2));
            $acme->setContent($faker->paragraph(5));
            $acme->setCreated($faker->dateTimeThisYear());
            $acme->setCreatedBy(1);

            $mapper->createOne($acme);

            $this->printCounting();
        }
    }

    #[SeedClear]
    public function clear(): void
    {
        $this->truncate(Acme::class);
    }
};
