<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\Article;
use Lyrasoft\Luna\Entity\Category;
use Lyrasoft\Luna\Entity\Menu;
use Lyrasoft\Luna\Enum\MenuTarget;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\Nested\Position;
use Windwalker\ORM\NestedSetMapper;
use Windwalker\ORM\ORM;

$types = [
    'mainmenu' => [
        'max_level' => 3,
        'number' => 30,
    ],
];

/**
 * Menu Seeder
 *
 * @var Seeder          $seeder
 * @var ORM             $orm
 * @var DatabaseAdapter $db
 */
$seeder->import(
    static function () use ($seeder, $orm, $db, $types) {
        $faker = $seeder->faker('en_US');

        /** @var NestedSetMapper $mapper */
        $mapper = $orm->mapper(Menu::class);
        $articles = $orm->findList(Article::class, ['state' => 1])->all()->dump();
        $categories = $orm->findList(Category::class, ['type' => 'article'])->all()->dump();

        $existsMenuIds = [];
        $views = [
            'article',
            'article_category',
        ];

        foreach ($types as $type => $detail) {
            $maxLevel = $detail['max_level'];

            $existsMenuIds[$type] = [1];

            foreach (range(1, $detail['number']) as $i) {
                /** @var Menu $item */
                $item = $mapper->createEntity();

                $view = $faker->randomElement($views);

                $item->title = $faker->sentence(2);
                $item->type = $type;
                $item->view = $view;

                switch ($view) {
                    case 'article':
                        /** @var Article $article */
                        $article = $faker->randomElement($articles);
                        $item->variables = [
                            'id' => $article->getId(),
                            'alias' => $article->getAlias(),
                        ];
                        break;

                    case 'article_category':
                        /** @var Category $category */
                        $category = $faker->randomElement($categories);

                        $item->variables = [
                            'id' => $category->getId(),
                            'path' => $category->getPath(),
                        ];
                        break;
                }

                $item->image = $faker->unsplashImage();
                $item->state = 1;
                $item->target = MenuTarget::SELF;
                $item->created = $faker->dateTimeThisYear;
                $item->modified = $item->created->modify('+5days');

                $mapper->setPosition(
                    $item,
                    $faker->randomElement($existsMenuIds[$item->type]),
                    Position::LAST_CHILD
                );

                /** @var Menu $item */
                $item = $mapper->createOne($item);

                if ($item->level < $maxLevel) {
                    $existsMenuIds[$item->type][] = $item->id;
                }

                $seeder->outCounting();
            }
        }
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        $seeder->truncate(Menu::class);
    }
);
