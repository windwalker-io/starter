<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Lyrasoft\Luna\Admin\DataMapper\LanguageMapper;
use Lyrasoft\Luna\Table\LunaTable;
use Symfony\Component\Yaml\Yaml;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Database\Schema\Key;
use Windwalker\Database\Schema\Schema;

/**
 * Migration class of LanguageInit.
 */
class LanguageInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->createTable(LunaTable::LANGUAGES, function(Schema $sc)
		{
			$sc->primary('id')->comment('Primary Key');
			$sc->varchar('title')->length(50)->comment('Title');
			$sc->varchar('alias')->length(50)->comment('URL Prefix');
			$sc->varchar('title_native')->length(50)->comment('Title Native');
			$sc->varchar('code')->length(50)->comment('Language Code');
			$sc->varchar('image')->length(50)->comment('Image');
			$sc->varchar('description')->length(1024)->comment('Description');
			$sc->text('metakey')->comment('Meta Keyword');
			$sc->text('metadesc')->comment('Meta Description');
			$sc->varchar('sitename')->length(1024)->comment('Site Name');
			$sc->integer('state')->comment('State');
			$sc->integer('ordering')->comment('Ordering');

			$sc->addIndex('code');
			$sc->addIndex('alias');
			$sc->addIndex('ordering');
			$sc->addIndex('image');
		});

		$fixtures = Yaml::parse(file_get_contents(__DIR__ . '/fixtures/languages.yml'));
		
		foreach ($fixtures['languages'] as $language)
		{
			$data = new \Windwalker\Data\Data;

			$data->bind($language);

			LanguageMapper::createOne($data);
		}
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(LunaTable::LANGUAGES);
	}
}
