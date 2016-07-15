<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Lyrasoft\Luna\Admin\DataMapper\ArticleMapper;
use Lyrasoft\Luna\Admin\DataMapper\CommentMapper;
use Lyrasoft\Luna\Table\LunaTable;
use Faker\Factory;
use Windwalker\Core\DateTime\DateTime;
use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\Data\Data;
use Windwalker\Filter\OutputFilter;
use Lyrasoft\Warder\Admin\DataMapper\UserMapper;
use Lyrasoft\Warder\Helper\WarderHelper;

/**
 * The CommentSeeder class.
 * 
 * @since  1.0
 */
class CommentSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = Factory::create();

		$articleIds = ArticleMapper::findAll()->id;

		if (WarderHelper::tableExists('users'))
		{
			$userIds = UserMapper::findAll()->id;
		}
		else
		{
			$userIds = range(1, 50);
		}

		foreach ($articleIds as $articleId)
		{
			foreach (range(3, rand(5, 7)) as $i)
			{
				$data = new Data;

				$data['target_id']   = $articleId;
				$data['type']        = 'article';
				$data['user_id']     = $faker->randomElement($userIds);
				$data['title']       = $faker->sentence(rand(3, 5));
				$data['content']     = $faker->paragraph(5);
				$data['reply']       = $faker->paragraph(3);
				$data['reply_user_id'] = $faker->randomElement($userIds);
				$data['created']     = $faker->dateTime->format(DateTime::getSqlFormat());
				$data['created_by']  = $faker->randomElement($userIds);
				$data['modified']    = $faker->dateTime->format(DateTime::getSqlFormat());
				$data['modified_by'] = $faker->randomElement($userIds);
				$data['ordering']    = $i;
				$data['state']       = 1;
				$data['params']      = '';

				CommentMapper::createOne($data);

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
		$this->truncate(LunaTable::COMMENTS);
	}
}
