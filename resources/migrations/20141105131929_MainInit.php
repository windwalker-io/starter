<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\Schema;

/**
 * Migration class, version: 20141105131929
 */
class MainInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->createTable('main_cover', function(Schema $schema)
		{
			$schema->primary('id')->comment('Primary Key');
			$schema->varchar('title')->comment('Primary Key');
			$schema->text('text')->comment('Content Text');
			$schema->integer('state')->signed(true)->comment('0: unpublished, 1: published');
		});
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop('main_cover');
	}
}
