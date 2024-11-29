<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\Translation\Entities\Translation;
use Modules\Translation\Entities\TranslationTranslation;

class TranslationMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		Translation::truncate();
		$data = DB::connection('mysql')->table('translations')->select('*')->get();
        Translation::insert(self::toArray($data));

        TranslationTranslation::truncate();
        $data = DB::connection('mysql')->table('translation_translations')->select('*')->get();
        TranslationTranslation::insert(self::toArray($data));

		$command->info('Translation seeded');
	}

}
