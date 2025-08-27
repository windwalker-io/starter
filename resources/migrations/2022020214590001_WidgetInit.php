<?php

declare(strict_types=1);

namespace App\Migration;

use Lyrasoft\Luna\Entity\Widget;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\MigrateDown;
use Windwalker\Core\Migration\MigrateUp;
use Windwalker\Database\Schema\Schema;

return new /** 2022020214590001_WidgetInit */ class extends AbstractMigration {
    #[MigrateUp]
    public function up(): void
    {
        $this->createTable(
            Widget::class,
            function (Schema $schema) {
                $schema->primary('id');
                $schema->varchar('title')->comment('Title');
                $schema->varchar('type')->comment('Widget Type');
                $schema->varchar('position')->comment('Position');
                $schema->varchar('note')->comment('Note');
                $schema->longtext('content')->comment('Content');
                $schema->bool('state')->comment('0:unpublished, 1:published');
                $schema->integer('ordering')->comment('Ordering');
                $schema->datetime('created')->comment('Created Date');
                $schema->integer('created_by')->comment('Author');
                $schema->datetime('modified')->comment('Modified Date');
                $schema->integer('modified_by')->comment('Modified User');
                $schema->char('language')->length(7)->comment('Language');
                $schema->json('params')->comment('Params');

                $schema->addIndex('position');
                $schema->addIndex('language');
                $schema->addIndex('created_by');
            }
        );
    }

    #[MigrateDown]
    public function down(): void
    {
        $this->dropTables(Widget::class);
    }
};
