<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\Page\Entities\Page;
use Modules\Page\Entities\PageTranslation;

class PageMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		Page::truncate();
		$data = DB::connection('mysql')->table('pages')->select('*')->get();
        Page::insert(self::toArray($data));

        PageTranslation::truncate();
        $data = DB::connection('mysql')->table('page_translations')->select('*')->get();
        PageTranslation::insert(self::toArray($data));

		$command->info('Page seeded');
	}

}
