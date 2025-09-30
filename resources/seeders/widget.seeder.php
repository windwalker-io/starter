<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\User;
use Lyrasoft\Luna\Entity\Widget;
use Lyrasoft\Luna\Services\LocaleService;
use Lyrasoft\Luna\Widget\AbstractWidget;
use Lyrasoft\Luna\Widget\WidgetService;
use Unicorn\Enum\BasicState;
use Windwalker\Core\Seed\AbstractSeeder;
use Windwalker\Core\Seed\SeedClear;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Core\Seed\SeedImport;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\EntityMapper;
use Windwalker\ORM\ORM;
use Windwalker\Utilities\Utf8String;

return new /** Widget Seeder */ class extends AbstractSeeder {
    #[SeedImport]
    public function import(WidgetService $widgetService): void
    {
        $faker = $this->faker('en_US');

        $positions = $faker->words(5);

        /** @var EntityMapper<Widget> $mapper */
        $mapper = $this->orm->mapper(Widget::class);
        $langCodes = LocaleService::getSeederLangCodes($this->orm);
        $userIds = $this->orm->findColumn(User::class, 'id')->dump();

        foreach (range(1, 30) as $i) {
            $langCode = $faker->randomElement($langCodes);
            $item = $mapper->createEntity();

            /** @var AbstractWidget $widgetType */
            $widgetType = $faker->randomElement($widgetService->getWidgetTypes());

            $faker = $this->faker($langCode);

            $item->type = $widgetType::getType();
            $item->title = Utf8String::ucwords($faker->sentence(3));
            $item->position = $faker->randomElement($positions);
            $item->note = $faker->sentence(5);
            $item->content = $faker->paragraph(10);
            $item->state = BasicState::PUBLISHED;
            $item->ordering = $i;
            $item->language = $langCode;
            $item->created = $faker->dateTimeThisYear();
            $item->modified = $item->created->modify('+10days');
            $item->createdBy = (int) $faker->randomElement($userIds);

            $item = $mapper->createOne($item);

            $this->printCounting();
        }
    }

    #[SeedClear]
    public function clear(): void
    {
        $this->truncate(Widget::class);
    }
};
