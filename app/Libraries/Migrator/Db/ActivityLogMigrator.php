<?php


namespace App\Libraries\Migrator\Db;

use Illuminate\Support\Facades\DB;

class ActivityLogMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
        DB::connection('sqlite')->table('activity_log')->truncate();
		$data = DB::connection('mysql')->table('activity_log')->select('*')->get();

        foreach (array_chunk(self::toArray($data),99) as $activityLogs) {
            DB::connection('sqlite')->table('activity_log')->insert($activityLogs);
        }

		$command->info('Activity log seeded');
	}

}
