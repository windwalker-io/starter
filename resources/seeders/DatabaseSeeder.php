<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Windwalker\Core\Seeder\AbstractSeeder;

/**
 * The DatabaseSeeder class.
 * 
 * @since  1.0
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
		$this->execute(new UserSeeder);

		$this->execute(new LanguageSeeder);

		$this->execute(new TagSeeder);

		$this->execute(new CategorySeeder);

		$this->execute(new ArticleSeeder);

		$this->execute(new CommentSeeder);

		$this->execute(new ModuleSeeder);

		// @muse-placeholder  seeder-execute  Do not remove this.
	}

	/**
	 * doClean
	 *
	 * @return  void
	 */
	public function doClear()
	{
		$this->clear(new UserSeeder);

		$this->clear(new LanguageSeeder);

		$this->clear(new TagSeeder);

		$this->clear(new CategorySeeder);

		$this->clear(new ArticleSeeder);

		$this->clear(new CommentSeeder);

		$this->clear(new ModuleSeeder);

		// @muse-placeholder  seeder-clean  Do not remove this.
	}
}
