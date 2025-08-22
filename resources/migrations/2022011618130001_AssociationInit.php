<?php

declare(strict_types=1);

namespace App\Migration;

use Lyrasoft\Luna\Entity\Association;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\MigrateDown;
use Windwalker\Core\Migration\MigrateUp;
use Windwalker\Database\Schema\Schema;

return new /** 2022011618130001_AssociationInit */ class extends AbstractMigration {
    #[MigrateUp]
    public function up(): void
    {
        $this->createTable(
            Association::class,
            function (Schema $schema) {
                $schema->char('type')->length(50);
                $schema->integer('target_id');
                $schema->varchar('key');
                $schema->char('hash')->length(32);
                $schema->json('params');

                $schema->addIndex('type');
                $schema->addIndex('key');
                $schema->addIndex('target_id');
                $schema->addIndex('hash');
            }
        );
    }

    #[MigrateDown]
    public function down(): void
    {
        $this->dropTables(Association::class);
    }
};
