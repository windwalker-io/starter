<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\Language;
use Windwalker\Core\Seed\AbstractSeeder;
use Windwalker\Core\Seed\SeedClear;
use Windwalker\Core\Seed\SeedImport;

return new /** Language Seeder */ class extends AbstractSeeder {
    #[SeedImport]
    public function import(): void
    {
        $this->orm->updateWhere(Language::class, ['state' => 1], ['code' => ['zh-TW', 'ja-JP']]);
    }

    #[SeedClear]
    public function clear(): void
    {
        //
    }
};
