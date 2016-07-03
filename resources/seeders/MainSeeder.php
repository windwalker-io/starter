<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

use Windwalker\Core\Seeder\AbstractSeeder;

/**
 * The MainSeeder class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class MainSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$this->execute(UserSeeder::class);

		$this->execute(LanguageSeeder::class);

		$this->execute(TagSeeder::class);

		$this->execute(CategorySeeder::class);

		$this->execute(ArticleSeeder::class);

		$this->execute(CommentSeeder::class);

		$this->execute(ModuleSeeder::class);
	}

	/**
	 * doClear
	 *
	 * @return  void
	 */
	public function doClear()
	{
		$this->clear(UserSeeder::class);

		$this->clear(LanguageSeeder::class);

		$this->clear(TagSeeder::class);

		$this->clear(CategorySeeder::class);

		$this->clear(ArticleSeeder::class);

		$this->clear(CommentSeeder::class);

		$this->clear(ModuleSeeder::class);
	}
}
