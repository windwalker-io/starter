<?php

declare(strict_types=1);

namespace App\Migration;

use Lyrasoft\Luna\Entity\Category;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\MigrateDown;
use Windwalker\Core\Migration\MigrateUp;
use Windwalker\Database\Schema\Schema;
use Windwalker\ORM\NestedSetMapper;
use Windwalker\ORM\ORM;

return new /** 2021110708040001_CategoryInit */ class extends AbstractMigration {
    #[MigrateUp]
    public function up(ORM $orm): void
    {
        $this->createTable(
            Category::class,
            function (Schema $schema) {
                $schema->primary('id')->comment('Primary Key');
                $schema->integer('parent_id')->comment('Parent ID');
                $schema->integer('lft')->comment('Left Key');
                $schema->integer('rgt')->comment('Right key');
                $schema->integer('level')->comment('Nested Level');
                $schema->varchar('path')->length(1024)->comment('Alias Path');
                $schema->varchar('type')->length(50)->comment('Content Type');
                $schema->varchar('title')->comment('Title');
                $schema->varchar('alias')->comment('Alias');
                $schema->varchar('image')->comment('Main Image');
                $schema->longtext('description')->comment('Description');
                $schema->tinyint('state')->length(1)->comment('0: unpublished, 1:published');
                $schema->datetime('created')->comment('Created Date');
                $schema->datetime('modified')->comment('Modified Date');
                $schema->integer('created_by')->comment('Author');
                $schema->integer('modified_by')->comment('Modified User');
                $schema->char('language')->length(7)->comment('Language');
                $schema->json('params')->comment('Params');

                $schema->addIndex('parent_id');
                $schema->addIndex('alias');
                $schema->addIndex('path');
                $schema->addIndex(['lft', 'rgt']);
                $schema->addIndex('created_by');
                $schema->addIndex('language');
                $schema->addIndex('type');
            }
        );

        /** @var NestedSetMapper<Category> $mapper */
        $mapper = $orm->mapper(Category::class);
        $mapper->createRootIfNotExist();
    }

    #[MigrateDown]
    public function down(): void
    {
        $this->dropTables(Category::class);
    }
};
