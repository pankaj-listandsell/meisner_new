<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\Files\Entities\Files;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Entities\SettingTranslation;

class SettingMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		Setting::truncate();
		$data = DB::connection('mysql')->table('settings')->select('*')->get();
        Setting::insert(self::toArray($data));


        SettingTranslation::truncate();
        $data = DB::connection('mysql')->table('setting_translations')->select('*')->get();
        SettingTranslation::insert(self::toArray($data));

		$command->info('Setting seeded');
	}

}
