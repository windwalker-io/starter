<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Admin\Table\Table;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\Schema;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Database\Schema\Key;

/**
 * Migration class of SakuraInit.
 */
class SakuraInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->createTable(Table::SAKURAS, function(Schema $schema)
		{
			$schema->primary('id')->comment('Primary Key');
			$schema->varchar('title')->comment('Title');
			$schema->varchar('alias')->comment('Alias');
			$schema->varchar('url')->comment('URL');
			$schema->text('introtext')->comment('Intro Text');
			$schema->text('fulltext')->comment('Full Text');
			$schema->varchar('image')->comment('Main Image');
			$schema->tinyint('state')->signed(true)->comment('0: unpublished, 1:published');
			$schema->integer('ordering')->comment('Ordering');
			$schema->datetime('created')->comment('Created Date');
			$schema->integer('created_by')->comment('Author');
			$schema->datetime('modified')->comment('Modified Date');
			$schema->integer('modified_by')->comment('Modified User');
			$schema->char('language')->length(7)->comment('Language');
			$schema->text('params')->comment('Params');

			$schema->addIndex($schema->indexName('alias'), 'alias');
			$schema->addIndex($schema->indexName('language'), 'language');
			$schema->addIndex($schema->indexName('created_by'), 'created_by');
		});
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(Table::SAKURAS);
	}
}
