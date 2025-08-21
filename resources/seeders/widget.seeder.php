<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\User;
use Lyrasoft\Luna\Entity\Widget;
use Lyrasoft\Luna\Services\LocaleService;
use Lyrasoft\Luna\Widget\AbstractWidget;
use Lyrasoft\Luna\Widget\WidgetService;
use Unicorn\Enum\BasicState;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\EntityMapper;
use Windwalker\ORM\ORM;
use Windwalker\Utilities\Utf8String;

/**
 * Widget Seeder
 *
 * @var Seeder          $seeder
 * @var ORM             $orm
 * @var DatabaseAdapter $db
 */
$seeder->import(
    static function (WidgetService $widgetService) use ($seeder, $orm, $db) {
        $faker = $seeder->faker('en_US');

        $positions = $faker->words(5);

        /** @var EntityMapper<Widget> $mapper */
        $mapper = $orm->mapper(Widget::class);
        $langCodes = LocaleService::getSeederLangCodes($orm);
        $userIds = $orm->findColumn(User::class, 'id')->dump();

        foreach (range(1, 30) as $i) {
            $langCode = $faker->randomElement($langCodes);
            $item = $mapper->createEntity();

            /** @var AbstractWidget $widgetType */
            $widgetType = $faker->randomElement($widgetService->getWidgetTypes());

            $faker = $seeder->faker($langCode);

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

            $seeder->outCounting();
        }
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        $seeder->truncate(Widget::class);
    }
);
