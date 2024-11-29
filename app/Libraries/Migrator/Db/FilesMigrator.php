<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\Ebook\Entities\EbookTranslation;
use Modules\Files\Entities\Files;

class FilesMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		Files::truncate();
		$data = DB::connection('mysql')->table('files')->select('*')->get();
        foreach (array_chunk(self::toArray($data),50) as $rows) {
            Files::insert($rows);
        }

        // Entity Files
        DB::connection('sqlite')->table('entity_files')->truncate();
        $data = DB::connection('mysql')->table('entity_files')->select('*')->get();
        foreach (array_chunk(self::toArray($data),50) as $rows) {
            DB::connection('sqlite')->table('entity_files')->insert($rows);
        }

		$command->info('Files seeded');
	}

}
