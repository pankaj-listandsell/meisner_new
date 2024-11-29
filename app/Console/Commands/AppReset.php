<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use App\Libraries\Migrator\MainMigrator;

class AppReset extends Command
{
    protected $signature = 'app:reset';

    protected $description = 'Application reset';

    public function handle()
    {
        MainMigrator::migrateDatabase($this);

        MainMigrator::seedDatabase($this);

        MainMigrator::clearCache($this);
    }
}
