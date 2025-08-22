<?php

declare(strict_types=1);

namespace App\Migration;

use Lyrasoft\Luna\Entity\Session;
use Lyrasoft\Luna\Entity\User;
use Lyrasoft\Luna\Entity\UserRole;
use Lyrasoft\Luna\Entity\UserRoleMap;
use Lyrasoft\Luna\Entity\UserSocial;
use Lyrasoft\Luna\User\UserService;
use Unicorn\Enum\BasicState;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\MigrateDown;
use Windwalker\Core\Migration\MigrateUp;
use Windwalker\Crypt\Hasher\PasswordHasherInterface;
use Windwalker\Database\Schema\Schema;
use Windwalker\ORM\NestedSetMapper;
use Windwalker\ORM\ORM;

return new /** 2021110708020001_UserInit */ class extends AbstractMigration {
    #[MigrateUp]
    public function up(UserService $userService, ORM $orm, PasswordHasherInterface $hasher): void
    {
        // User
        $this->createTable(
            User::class,
            function (Schema $schema) {
                $schema->primary('id');
                $schema->varchar('username')->comment('Username');
                $schema->varchar('email')->comment('Email');
                $schema->varchar('name')->comment('Name');
                $schema->varchar('avatar')->comment('Avatar');
                $schema->varchar('password')->length(1024)->comment('Password');
                $schema->bool('enabled')->comment('0: disabled, 1: enabled');
                $schema->bool('verified')->comment('0: unverified, 1: verified');
                $schema->varchar('activation')->comment('Activation code.');
                $schema->tinyint('receive_mail')->defaultValue(0)->length(1);
                $schema->varchar('reset_token')->comment('Reset Token');
                $schema->datetime('last_reset')->nullable(true)->comment('Last Reset Time');
                $schema->datetime('last_login')->nullable(true)->comment('Last Login Time');
                $schema->datetime('registered')->nullable(true)->comment('Register Time');
                $schema->datetime('modified')->nullable(true)->comment('Modified Time');
                $schema->json('params')->comment('Params');

                $schema->addIndex('username');
                $schema->addIndex('email');
            }
        );

        // User Group
        $this->createTable(
            UserRole::class,
            function (Schema $schema) {
                $schema->primary('id')->comment('Primary Key');
                $schema->integer('parent_id')->comment('Parent ID');
                $schema->integer('lft')->comment('Left Key');
                $schema->integer('rgt')->comment('Right key');
                $schema->integer('level')->comment('Nested Level');
                $schema->varchar('title')->comment('Title');
                $schema->longtext('description')->comment('Description');
                $schema->tinyint('state')->length(1)->comment('0: unpublished, 1:published');
                $schema->datetime('created')->nullable(true)->comment('Created Date');
                $schema->datetime('modified')->nullable(true)->comment('Modified Date');
                $schema->integer('created_by')->comment('Author');
                $schema->integer('modified_by')->comment('Modified User');
                $schema->json('params')->comment('Params');

                $schema->addIndex(['lft', 'rgt']);
                $schema->addIndex('created_by');
            }
        );

        $this->createTable(
            UserRoleMap::class,
            function (Schema $schema) {
                $schema->integer('user_id');
                $schema->varchar('role_id');

                $schema->addIndex('user_id');
                $schema->addIndex('role_id');
                $schema->addPrimaryKey(['user_id', 'role_id']);
                $schema->addIndex(['user_id', 'role_id']);
            }
        );

        // User Social
        $this->createTable(
            UserSocial::class,
            function (Schema $schema) {
                $schema->integer('user_id')->comment('User ID');
                $schema->varchar('identifier')->comment('User identifier name');
                $schema->char('provider')->length(20)->comment('Social provider');
                $schema->json('params')->comment('Params');

                $schema->addIndex('user_id');
                $schema->addIndex('identifier');
            }
        );

        // Session
        $this->createTable(
            Session::class,
            function (Schema $schema) {
                $schema->varchar('id')->length(192);
                $schema->text('data');
                $schema->integer('user_id');
                $schema->tinyint('remember');
                $schema->integer('time');

                $schema->addUniqueKey('id');
                $schema->addIndex('user_id');
                $schema->addIndex('time');
            }
        );

        /** @var NestedSetMapper<UserRole> $roleMapper */
        $roleMapper = $orm->mapper(UserRole::class);
        $root = $roleMapper->createRootIfNotExist();

        $role = new UserRole();
        $role->title = 'Super User';
        $role->state = BasicState::PUBLISHED;

        $roleMapper->setPosition($role, $root->getPrimaryKeyValue());
        $roleMapper->createOne($role);

        $user = new User();

        $user->username = 'admin';
        $user->email = 'webadmin@simular.co';
        $user->name = 'Simular';
        $user->password = $hasher->hash('1234');
        $user->avatar = 'https://avatars.githubusercontent.com/u/13175487#.jpg';
        $user->enabled = true;
        $user->verified = true;
        $user->receiveMail = true;

        /** @var User $user */
        $user = $orm->createOne(User::class, $user);

        $map = new UserRoleMap();
        $map->userId = $user->getId();
        $map->roleId = 'superuser';

        $orm->createOne($map::class, $map);
    }

    #[MigrateDown]
    public function down(): void
    {
        $this->dropTables(
            User::class,
            UserSocial::class,
            UserRole::class,
            UserRoleMap::class,
            Session::class
        );
    }
};
