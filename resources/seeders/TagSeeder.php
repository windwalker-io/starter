<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Lyrasoft\Luna\Admin\DataMapper\TagMapper;
use Lyrasoft\Luna\Table\LunaTable;
use Faker\Factory;
use Windwalker\Core\DateTime\DateTime;
use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\Data\Data;
use Windwalker\Filter\OutputFilter;
use Lyrasoft\Warder\Admin\DataMapper\UserMapper;
use Lyrasoft\Warder\Helper\WarderHelper;

/**
 * The TagSeeder class.
 * 
 * @since  1.0
 */
class TagSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = Factory::create();

		if (WarderHelper::tableExists('users'))
		{
			$userIds = UserMapper::findAll()->id;
		}
		else
		{
			$userIds = range(1, 50);
		}

		foreach (range(1, 30) as $i)
		{
			$data = new Data;

			$data['title']       = ucfirst($faker->word);
			$data['alias']       = OutputFilter::stringURLSafe($data['title']);
			$data['state']       = $faker->randomElement(array(1, 1, 1, 1, 0, 0));
			$data['created']     = $faker->dateTime->format(DateTime::getSqlFormat());
			$data['created_by']  = $faker->randomElement($userIds);
			$data['modified']    = $faker->dateTime->format(DateTime::getSqlFormat());
			$data['modified_by'] = $faker->randomElement($userIds);
			$data['language']    = 'en-GB';
			$data['params']      = '';

			TagMapper::createOne($data);

			$this->outCounting();
		}
	}

	/**
	 * doClean
	 *
	 * @return  void
	 */
	public function doClean()
	{
		$this->truncate(LunaTable::TAGS);
	}
}
