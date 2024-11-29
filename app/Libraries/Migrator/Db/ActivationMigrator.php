<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;

class ActivationMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
        DB::connection('sqlite')->table('activations')->truncate();
		$data = DB::connection('mysql')->table('activations')->select('*')->get();
        DB::connection('sqlite')->table('activations')->insert(self::toArray($data));

		$command->info('Activation seeded');
	}

}
