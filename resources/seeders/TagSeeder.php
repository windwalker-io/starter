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
use Windwalker\Warder\Admin\DataMapper\UserMapper;

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

		$mapper = new TagMapper;

		if (\Windwalker\Warder\Helper\WarderHelper::tableExists('users'))
		{
			$userMapper = new UserMapper;

			$userIds = $userMapper->findAll()->id;
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
			$data['created']     = $faker->dateTime->format(DateTime::FORMAT_SQL);
			$data['created_by']  = $faker->randomElement($userIds);
			$data['modified']    = $faker->dateTime->format(DateTime::FORMAT_SQL);
			$data['modified_by'] = $faker->randomElement($userIds);
			$data['language']    = 'en-GB';
			$data['params']      = '';

			$mapper->createOne($data);

			$this->command->out('.', false);
		}

		$this->command->out();
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
