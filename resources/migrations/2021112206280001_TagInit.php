<?php

declare(strict_types=1);

namespace App\Migration;

use Lyrasoft\Luna\Entity\Tag;
use Lyrasoft\Luna\Entity\TagMap;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\MigrateDown;
use Windwalker\Core\Migration\MigrateUp;
use Windwalker\Database\Schema\Schema;

return new /** 2021112206280001_TagInit */ class extends AbstractMigration {
    #[MigrateUp]
    public function up(): void
    {
        $this->createTable(
            Tag::class,
            function (Schema $schema) {
                $schema->primary('id')->comment('Primary Key');
                $schema->varchar('title')->comment('Title');
                $schema->varchar('alias')->comment('Alias');
                $schema->bool('state')->comment('0: unpublished, 1:published');
                $schema->datetime('created')->comment('Created Date');
                $schema->datetime('modified')->comment('Modified Date');
                $schema->integer('created_by')->comment('Author');
                $schema->integer('modified_by')->comment('Modified User');
                $schema->char('language')->length(7)->comment('Language');
                $schema->json('params')->comment('Params');

                $schema->addIndex('alias');
                $schema->addIndex('language');
                $schema->addIndex('created_by');
            }
        );

        $this->createTable(
            TagMap::class,
            function (Schema $schema) {
                $schema->varchar('type')->comment('Type');
                $schema->integer('target_id');
                $schema->integer('tag_id');

                $schema->addIndex('target_id');
                $schema->addIndex('type');
                $schema->addIndex('tag_id');
                $schema->addPrimaryKey(['target_id', 'type', 'tag_id']);
            }
        );
    }

    #[MigrateDown]
    public function down(): void
    {
        $this->dropTables(Tag::class, TagMap::class);
    }
};
