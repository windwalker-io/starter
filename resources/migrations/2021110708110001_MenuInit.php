<?php

declare(strict_types=1);

namespace App\Migration;

use Lyrasoft\Luna\Entity\Menu;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\MigrateDown;
use Windwalker\Core\Migration\MigrateUp;
use Windwalker\Database\Schema\Schema;
use Windwalker\ORM\NestedSetMapper;
use Windwalker\ORM\ORM;

return new /** 2021110708110001_MenuInit */ class extends AbstractMigration {
    #[MigrateUp]
    public function up(ORM $orm): void
    {
        $this->createTable(
            Menu::class,
            function (Schema $schema) {
                $schema->primary('id')->comment('Primary Key');
                $schema->integer('parent_id')->comment('Parent ID');
                $schema->integer('lft')->comment('Left Key');
                $schema->integer('rgt')->comment('Right key');
                $schema->integer('level')->comment('Nested Level');
                $schema->varchar('path')->length(1024)->comment('Alias Path');
                $schema->varchar('type')->length(50)->comment('Content Type');
                $schema->varchar('view')->comment('View Name');
                $schema->varchar('title')->comment('Title');
                $schema->varchar('alias')->comment('Alias');
                $schema->varchar('url')->comment('URL');
                $schema->char('target')->length(10)->comment('Target');
                $schema->json('variables')->comment('Vars');
                $schema->longtext('description')->comment('Description');
                $schema->tinyint('state')->length(1)->comment('0: unpublished, 1:published');
                $schema->datetime('created')->nullable(true)->comment('Created Date');
                $schema->datetime('modified')->nullable(true)->comment('Modified Date');
                $schema->integer('created_by')->comment('Author');
                $schema->integer('modified_by')->comment('Modified User');
                $schema->char('language')->length(7)->comment('Language');
                $schema->json('params')->comment('Params');

                $schema->addIndex(['lft', 'rgt']);
                $schema->addIndex('created_by');
                $schema->addIndex('type');
            }
        );

        /** @var NestedSetMapper<Menu> $mapper */
        $mapper = $orm->mapper(Menu::class);
        $mapper->createRootIfNotExist();
    }

    #[MigrateDown]
    public function down(): void
    {
        $this->dropTables(Menu::class);
    }
};
