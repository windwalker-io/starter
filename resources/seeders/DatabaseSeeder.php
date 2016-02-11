<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

use Windwalker\Core\Seeder\AbstractSeeder;

/**
 * The DatabaseSeeder class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DatabaseSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = \Faker\Factory::create();

		// This is example seeder, you can delete it.
		$mapper = new \Windwalker\DataMapper\DataMapper('main_cover');

		foreach (range(1, 50) as $i)
		{
			$data = new \Windwalker\Data\Data;
			$data->title = $faker->sentence(2);
			$data->text = $faker->paragraph(3);
			$data->state = $faker->randomElement(array(0, 1, 1));

			$mapper->createOne($data);

			$this->command->out('.', false);
		}
		// Example seeder end.

		$this->command->out()->out('Seeder executed.')->out();
	}

	/**
	 * doClean
	 *
	 * @return  void
	 */
	public function doClean()
	{
		$this->truncate('main_cover');

		$this->command->out('Database clean.')->out();
	}
}
 