<?php

declare(strict_types=1);

namespace App\Migration;

use Lyrasoft\Luna\Entity\Config;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\MigrateDown;
use Windwalker\Core\Migration\MigrateUp;
use Windwalker\Database\Schema\Schema;

return new /** 2021110708010001_ConfigInit */ class extends AbstractMigration {
    #[MigrateUp]
    public function up(): void
    {
        $this->createTable(
            Config::class,
            function (Schema $schema) {
                $schema->char('type')->length(50)->comment('Type');
                $schema->char('subtype')->length(50)->comment('Sub Type');
                $schema->json('content')->comment('Content');
                $schema->datetime('modified')->nullable(true)->comment('Modified');
                $schema->integer('modified_by')->comment('Modified User');

                $schema->addIndex('type');
                $schema->addIndex('subtype');
                $schema->addPrimaryKey(['type', 'subtype']);
            }
        );
    }

    #[MigrateDown]
    public function down(): void
    {
        $this->dropTables(Config::class);
    }
};
