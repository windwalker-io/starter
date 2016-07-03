<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Lyrasoft\Luna\Admin\DataMapper\ModuleMapper;
use Lyrasoft\Luna\Module\ModuleHelper;
use Lyrasoft\Luna\Table\LunaTable;
use Faker\Factory;
use Windwalker\Core\DateTime\DateTime;
use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\Data\Data;
use Windwalker\Filter\OutputFilter;
use Lyrasoft\Warder\Admin\DataMapper\UserMapper;
use Lyrasoft\Warder\Helper\WarderHelper;

/**
 * The ModuleSeeder class.
 * 
 * @since  1.0
 */
class ModuleSeeder extends AbstractSeeder
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

		$positions = $faker->words(20);

		$types = ModuleHelper::getModuleTypes()->dump();

		foreach (range(1, 75) as $i)
		{
			$data = new Data;

			/** @var \Lyrasoft\Luna\Module\ModuleType $module */
			$module = $faker->randomElement($types);

			$data['title']       = $faker->sentence(rand(3, 5));
			$data['type']        = $module->type;
			$data['class']       = $module->class;
			$data['position']    = $faker->randomElement($positions);
			$data['note']        = $faker->sentence(5);
			$data['content']     = $faker->paragraph(5);
			$data['state']       = $faker->randomElement(array(1, 1, 1, 1, 0, 0));
			$data['created']     = $faker->dateTime->format(DateTime::getSqlFormat());
			$data['created_by']  = $faker->randomElement($userIds);
			$data['modified']    = $faker->dateTime->format(DateTime::getSqlFormat());
			$data['modified_by'] = $faker->randomElement($userIds);
			$data['ordering']    = $i;
			$data['language']    = 'en-GB';
			$data['params']      = '';

			ModuleMapper::createOne($data);

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
		$this->truncate(LunaTable::MODULES);
	}
}
