<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Lyrasoft\Luna\Admin\DataMapper\CategoryMapper;
use Lyrasoft\Luna\Admin\DataMapper\LanguageMapper;
use Lyrasoft\Luna\Admin\Record\CategoryRecord;
use Lyrasoft\Luna\Table\LunaTable;
use Faker\Factory;
use Windwalker\Core\DateTime\DateTime;
use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\Data\Data;
use Windwalker\Filter\OutputFilter;
use Windwalker\Warder\Admin\DataMapper\UserMapper;

/**
 * The CategorySeeder class.
 * 
 * @since  1.0
 */
class CategorySeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = Factory::create();

		$mapper = new CategoryMapper;
		$record = new CategoryRecord;
		$langMapper = new LanguageMapper;

		$languages = $langMapper->find(array('state' => 1))->code;
		$languages[] = '*';

		if (\Windwalker\Warder\Helper\WarderHelper::tableExists('users'))
		{
			$userMapper = new UserMapper;

			$userIds = $userMapper->findAll()->id;
		}
		else
		{
			$userIds = range(1, 50);
		}

		$existsRecordIds = array(1);

		foreach (range(1, 30) as $i)
		{
			$record->reset();

			$lang = $faker->randomElement($languages);

			$record['title']       = $faker->sentence(rand(1, 3)) . ' - [' . $lang . ']';
			$record['alias']       = OutputFilter::stringURLSafe($record['title']);
			$record['type']        = 'article';
			$record['description'] = $faker->paragraph(5);
			$record['image']       = $faker->imageUrl();
			$record['state']       = $faker->randomElement(array(1, 1, 1, 1, 0, 0));
			$record['version']     = rand(1, 50);
			$record['created']     = $faker->dateTime->format(DateTime::FORMAT_SQL);
			$record['created_by']  = $faker->randomElement($userIds);
			$record['modified']    = $faker->dateTime->format(DateTime::FORMAT_SQL);
			$record['modified_by'] = $faker->randomElement($userIds);
			$record['language']    = $lang;
			$record['params']      = '';

			$record->setLocation($faker->randomElement($existsRecordIds), $record::LOCATION_LAST_CHILD);

			$record->store();

			$record->rebuildPath();

			$existsRecordIds[] = $record->id;

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
		$this->truncate(LunaTable::CATEGORIES);

		$record = new CategoryRecord;
		$record->createRoot();
	}
}
