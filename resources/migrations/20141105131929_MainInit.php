<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\Schema;
use Windwalker\Database\Schema\Column;

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
		$this->getTable('main_cover', function(Schema $schema)
		{
			$schema->addColumn('id',    new Column\Primary)->comment('Primary Key');
			$schema->addColumn('title', new Column\Varchar)->comment('Primary Key');
			$schema->addColumn('text',  new Column\Text)->comment('Content Text');
			$schema->addColumn('state', new Column\Integer)->signed(true)->comment('0: unpublished, 1: published');
		})->create(true);
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop('acme_cover');
	}
}
