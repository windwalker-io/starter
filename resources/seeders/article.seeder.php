<?php

declare(strict_types=1);

namespace App\Seeder;

use Lyrasoft\Luna\Entity\Article;
use Lyrasoft\Luna\Entity\Category;
use Lyrasoft\Luna\Entity\Tag;
use Lyrasoft\Luna\Entity\TagMap;
use Lyrasoft\Luna\Entity\User;
use Lyrasoft\Luna\Services\LocaleService;
use Unicorn\Utilities\SlugHelper;
use Windwalker\Core\Seed\AbstractSeeder;
use Windwalker\Core\Seed\SeedClear;
use Windwalker\Core\Seed\SeedImport;
use Windwalker\ORM\EntityMapper;
use Windwalker\Utilities\Utf8String;

return new /** Article Seeder */ class extends AbstractSeeder {
    #[SeedImport]
    public function import(): void
    {
        $faker = $this->faker('en_US');
        $type = 'article';

        /** @var EntityMapper<Article> $mapper */
        $mapper = $this->orm->mapper(Article::class);
        $langCodes = LocaleService::getSeederLangCodes($this->orm);
        $categoryIds = $this->orm->findColumn(Category::class, 'id', ['type' => $type])->dump();
        $userIds = $this->orm->findColumn(User::class, 'id')->dump();
        $tagIds = $this->orm->findColumn(Tag::class, 'id')->dump();

        foreach (range(1, 150) as $i) {
            $langCode = $faker->randomElement($langCodes);
            $item = $mapper->createEntity();

            $faker = $this->faker($langCode);

            $item->categoryId = (int) $faker->randomElement($categoryIds);
            $item->type = $type;
            $item->title = Utf8String::ucwords($faker->sentence(3));
            $item->alias = SlugHelper::safe($item->title);
            $item->image = $faker->unsplashImage(800, 600);
            $item->state = $faker->optional(0.7, 0)->passthrough(1);
            $item->introtext = $faker->paragraph(5);
            $item->fulltext = $faker->paragraph(20);
            $item->ordering = $i;
            $item->language = $langCode;
            $item->created = $faker->dateTimeThisYear();
            $item->modified = $item->created->modify('+10days');
            $item->createdBy = (int) $faker->randomElement($userIds);

            $item = $mapper->createOne($item);

            foreach ($faker->randomElements($tagIds, random_int(3, 5)) as $tagId) {
                $map = new TagMap();
                $map->tagId = (int) $tagId;
                $map->type = 'article';
                $map->targetId = $item->getId();

                $this->orm->createOne(TagMap::class, $map);
            }

            $this->printCounting();
        }
    }

    #[SeedClear]
    public function clear(): void
    {
        $this->truncate(Article::class);
    }
};
