<?php

declare(strict_types=1);

namespace App\Migration;

use Lyrasoft\Luna\Entity\Rule;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\MigrateDown;
use Windwalker\Core\Migration\MigrateUp;
use Windwalker\Database\Schema\Schema;

return new /** 2021110708030001_RuleInit */ class extends AbstractMigration {
    #[MigrateUp]
    public function up(): void
    {
        $this->createTable(
            Rule::class,
            function (Schema $schema) {
                $schema->varchar('role_id');
                $schema->varchar('name');
                $schema->varchar('type');
                $schema->varchar('action');
                $schema->varchar('target_id');
                $schema->varchar('title');
                $schema->bool('allow')->nullable(true);

                $schema->addPrimaryKey(['role_id', 'name', 'target_id']);
                $schema->addIndex('role_id');
                $schema->addIndex('type');
                $schema->addIndex('name');
                $schema->addIndex('target_id');
                $schema->addIndex('action');
            }
        );
    }

    #[MigrateDown]
    public function down(): void
    {
        $this->dropTables(Rule::class);
    }
};
