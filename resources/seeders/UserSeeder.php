<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Faker\Factory;
use Windwalker\Core\DateTime\DateTime;
use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\Crypt\Password;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Lyrasoft\Warder\Admin\DataMapper\UserMapper;
use Lyrasoft\Warder\Helper\UserHelper;
use Lyrasoft\Warder\Table\WarderTable;

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

			$data->name        = $faker->name;
			$data->username    = $faker->userName;
			$data->email       = $faker->email;
			$data->password    = $pass;
			$data->avatar      = $faker->imageUrl(600, 600, 'people');
			$data->group       = 1;
			$data->blocked     = 0;
			$data->activation  = '';
			$data->reset_token = '';
			$data->last_reset  = $faker->dateTime->format(DateTime::getSqlFormat());
			$data->last_login  = $faker->dateTime->format(DateTime::getSqlFormat());
			$data->registered  = $faker->dateTime->format(DateTime::getSqlFormat());
			$data->modified    = $faker->dateTime->format(DateTime::getSqlFormat());
			$data->params      = '';

			UserMapper::createOne($data);

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
		$this->truncate(WarderTable::USERS);
	}
}
