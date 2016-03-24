<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Faker\Factory;
use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\Crypt\Password;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Warder\Helper\UserHelper;

/**
 * The UserSeeder class.
 *
 * @since  {DEPLOY_VERSION}
 */
class UserSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = Factory::create();

		$pass = UserHelper::hashPassword(1234);

		foreach (range(1, 50) as $i)
		{
			$data = new Data;

			$mapper = new DataMapper('users');

			$data->name        = $faker->name;
			$data->username    = $faker->userName;
			$data->email       = $faker->email;
			$data->password    = $pass;
			$data->avatar      = $faker->imageUrl(600, 600, 'people');
			$data->group       = 1;
			$data->blocked     = 0;
			$data->activation  = '';
			$data->reset_token = '';
			$data->last_reset  = $faker->dateTime->format('Y-m-d H:i:s');
			$data->last_login  = $faker->dateTime->format('Y-m-d H:i:s');
			$data->registered  = $faker->dateTime->format('Y-m-d H:i:s');
			$data->modified    = $faker->dateTime->format('Y-m-d H:i:s');
			$data->params      = '';

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
		$this->truncate('users');
	}
}
