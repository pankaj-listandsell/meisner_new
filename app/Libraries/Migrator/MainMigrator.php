<?php

namespace App\Libraries\Migrator;

use App\Libraries\Migrator\Db\ActivationMigrator;
use App\Libraries\Migrator\Db\ActivityLogMigrator;
use App\Libraries\Migrator\Db\AuthorMigrator;
use App\Libraries\Migrator\Db\CategoryMigrator;
use App\Libraries\Migrator\Db\EbookMigrator;
use App\Libraries\Migrator\Db\EventMigrator;
use App\Libraries\Migrator\Db\FilesMigrator;
use App\Libraries\Migrator\Db\MenuMigrator;
use App\Libraries\Migrator\Db\MetaDataMigrator;
use App\Libraries\Migrator\Db\PageMigrator;
use App\Libraries\Migrator\Db\SettingMigrator;
use App\Libraries\Migrator\Db\SliderMigrator;
use App\Libraries\Migrator\Db\TranslationMigrator;
use App\Libraries\Migrator\Db\UserMigrator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MainMigrator
{

    public static function migrateDatabase($command)
    {
        $command->info("Migrating");
        Artisan::call('migrate:fresh');
        $command->info("Migrated \n\n\n");
    }

    public static function seedDatabase($command)
    {
        $command->info("DB Seeding");
        Schema::disableForeignKeyConstraints();
        Artisan::call('db:seed');
        //self::executeSeeder($command);
        Schema::enableForeignKeyConstraints();
        $command->info("DB Seeded \n\n\n");
    }

    public static function clearCache($command)
    {
        $command->info("Cache Clearing");
        Artisan::call('cache:clear');
        $command->info("Cache Cleared \n\n\n");
    }


    public static function executeSeeder($command)
    {
        UserMigrator::execute($command);
        TranslationMigrator::execute($command);
        SettingMigrator::execute($command);
        ActivationMigrator::execute($command);
        ActivityLogMigrator::execute($command);
        CategoryMigrator::execute($command);
        AuthorMigrator::execute($command);
        EventMigrator::execute($command);
        EbookMigrator::execute($command);
        FilesMigrator::execute($command);
        MenuMigrator::execute($command);
        MetaDataMigrator::execute($command);
        PageMigrator::execute($command);
        SliderMigrator::execute($command);
    }

}
