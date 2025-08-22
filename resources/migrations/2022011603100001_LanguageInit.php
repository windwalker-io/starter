<?php

declare(strict_types=1);

namespace App\Migration;

use Lyrasoft\Luna\Entity\Language;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\MigrateDown;
use Windwalker\Core\Migration\MigrateUp;
use Windwalker\Database\Schema\Schema;

return new /** 2022011603100001_LanguageInit */ class extends AbstractMigration {
    #[MigrateUp]
    public function up(): void
    {
        $this->createTable(
            Language::class,
            function (Schema $schema) {
                $schema->primary('id')->comment('Primary Key');
                $schema->varchar('title')->comment('Title');
                $schema->varchar('alias')->comment('URL Prefix');
                $schema->varchar('title_native')->comment('Title Native');
                $schema->varchar('code')->length(50)->comment('Language Code');
                $schema->varchar('image')->comment('Image');
                $schema->varchar('description')->length(1024)->comment('Description');
                $schema->json('meta')->comment('Meta');
                $schema->varchar('sitename')->length(1024)->comment('Site Name');
                $schema->bool('state')->comment('0:unpublished, 1:published');
                $schema->integer('ordering')->comment('Ordering');

                $schema->addIndex('code');
            }
        );
    }

    #[MigrateDown]
    public function down(): void
    {
        $this->dropTables(Language::class);
    }
};
