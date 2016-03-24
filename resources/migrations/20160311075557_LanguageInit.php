<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Lyrasoft\Luna\Table\LunaTable;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\Schema;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Database\Schema\Key;

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
		$this->getTable(LunaTable::LANGUAGES, function(Schema $sc)
		{
			$sc->addColumn('id',           new Column\Primary)->comment('Primary Key');
			$sc->addColumn('title',        new Column\Varchar)->length(50)->comment('Title');
			$sc->addColumn('alias',        new Column\Varchar)->length(50)->comment('URL Prefix');
			$sc->addColumn('title_native', new Column\Varchar)->length(50)->comment('Title Native');
			$sc->addColumn('code',         new Column\Varchar)->length(50)->comment('Language Code');
			$sc->addColumn('image',        new Column\Varchar)->length(50)->comment('Image');
			$sc->addColumn('description',  new Column\Varchar)->length(1024)->comment('Description');
			$sc->addColumn('metakey',      new Column\Text)->comment('Meta Keyword');
			$sc->addColumn('metadesc',     new Column\Text)->comment('Meta Description');
			$sc->addColumn('sitename',     new Column\Varchar)->length(1024)->comment('Site Name');
			$sc->addColumn('state',        new Column\Integer)->comment('State');
			$sc->addColumn('ordering',     new Column\Integer)->comment('Ordering');

			$sc->addIndex(Key::TYPE_INDEX, 'idx_languages_code', 'code');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_languages_alias', 'alias');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_languages_ordering', 'ordering');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_languages_image', 'image');
		})->create(true);

		$fixtures = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . '/fixtures/languages.yml'));

		$mapper = new \Lyrasoft\Luna\Admin\DataMapper\LanguageMapper;

		foreach ($fixtures['languages'] as $language)
		{
			$data = new \Windwalker\Data\Data;

			$data->bind($language);

			$mapper->createOne($data);
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
