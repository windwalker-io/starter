<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\Article;
use Lyrasoft\Luna\Entity\Category;
use Lyrasoft\Luna\Entity\Menu;
use Lyrasoft\Luna\Enum\MenuTarget;
use Windwalker\Core\Seed\AbstractSeeder;
use Windwalker\Core\Seed\SeedClear;
use Windwalker\Core\Seed\SeedImport;
use Windwalker\ORM\Nested\Position;
use Windwalker\ORM\NestedSetMapper;

return new /** Menu Seeder */ class extends AbstractSeeder {
    #[SeedImport]
    public function import(): void
    {
        $types = [
            'mainmenu' => [
                'max_level' => 3,
                'number' => 30,
            ],
        ];

        $faker = $this->faker('en_US');

        /** @var NestedSetMapper $mapper */
        $mapper = $this->orm->mapper(Menu::class);
        $articles = $this->orm->findList(Article::class, ['state' => 1])->all()->dump();
        $categories = $this->orm->findList(Category::class, ['type' => 'article'])->all()->dump();

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
                    $faker->randomElement($existsMenuIds[$type]),
                    Position::LAST_CHILD
                );

                $item = $mapper->createOne($item);

                if ($item->level < $maxLevel) {
                    $existsMenuIds[$type][] = $item->id;
                }

                $this->printCounting();
            }
        }
    }

    #[SeedClear]
    public function clear(): void
    {
        $this->truncate(Menu::class);
    }
};
