<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\Author\Entities\Author;
use Modules\Author\Entities\AuthorTranslation;

class AuthorMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		Author::truncate();
		$data = DB::connection('mysql')->table('authors')->select('*')->get();
        foreach (array_chunk(self::toArray($data),99) as $rows) {
            Author::insert($rows);
        }

        AuthorTranslation::truncate();
        $data = DB::connection('mysql')->table('author_translations')->select('*')->get();
        foreach (array_chunk(self::toArray($data),99) as $rows) {
            AuthorTranslation::insert($rows);
        }

		$command->info('Author seeded');
	}

}
