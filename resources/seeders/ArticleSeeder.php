<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Lyrasoft\Luna\Admin\DataMapper\ArticleMapper;
use Lyrasoft\Luna\Admin\DataMapper\CategoryMapper;
use Lyrasoft\Luna\Admin\DataMapper\LanguageMapper;
use Lyrasoft\Luna\Admin\DataMapper\TagMapMapper;
use Lyrasoft\Luna\Admin\DataMapper\TagMapper;
use Lyrasoft\Luna\Table\LunaTable;
use Faker\Factory;
use Lyrasoft\Unidev\Helper\UnsplashHelper;
use Windwalker\Core\DateTime\DateTime;
use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\Data\Data;
use Windwalker\Filter\OutputFilter;
use Lyrasoft\Warder\Admin\DataMapper\UserMapper;
use Lyrasoft\Warder\Helper\WarderHelper;

/**
 * The ArticleSeeder class.
 * 
 * @since  1.0
 */
class ArticleSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = Factory::create();

		$languages = LanguageMapper::find(array('state' => 1))->code;
		$languages[] = '*';

		$categories = CategoryMapper::find(array(
			'parent_id != 0',
			'type' => 'article'
		));

		if (WarderHelper::tableExists('users'))
		{
			$userIds = UserMapper::findAll()->id;
		}
		else
		{
			$userIds = range(1, 50);
		}

		$tags = TagMapper::findAll()->dump();

		foreach ($categories as $category)
		{
			foreach (range(7, 15) as $i)
			{
				$data = new Data;

				$lang = $faker->randomElement($languages);

				$data['category_id'] = $category->id;
				$data['title']       = '(' . $lang . ') ' . $faker->sentence(rand(3, 5));
				$data['alias']       = OutputFilter::stringURLSafe($data['title']);
				$data['introtext']   = '(' . $lang . ') ' . $faker->paragraph(5);
				$data['fulltext']    = $faker->paragraph(5);
				$data['image']       = UnsplashHelper::getImageUrl();
				$data['state']       = $faker->randomElement(array(1, 1, 1, 1, 0, 0));
				$data['version']     = rand(1, 50);
				$data['created']     = $faker->dateTime->format(DateTime::getSqlFormat());
				$data['created_by']  = $faker->randomElement($userIds);
				$data['modified']    = $faker->dateTime->format(DateTime::getSqlFormat());
				$data['modified_by'] = $faker->randomElement($userIds);
				$data['ordering']    = $i;
				$data['language']    = $lang;
				$data['params']      = '';

				ArticleMapper::createOne($data);

				foreach ($faker->randomElements($tags, rand(5, 7)) as $tag)
				{
					$map = new Data;

					$map->tag_id = $tag->id;
					$map->target_id = $data->id;
					$map->type = 'article';

					TagMapMapper::createOne($map);
				}

				$this->outCounting();
			}
		}
	}

	/**
	 * doClean
	 *
	 * @return  void
	 */
	public function doClean()
	{
		$this->truncate(LunaTable::ARTICLES);
	}
}
