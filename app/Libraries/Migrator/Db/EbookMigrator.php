<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\Author\Entities\Author;
use Modules\Author\Entities\AuthorTranslation;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\CategoryTranslation;
use Modules\Ebook\Entities\Ebook;
use Modules\Ebook\Entities\EbookTranslation;

class EbookMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		Ebook::truncate();
		$data = DB::connection('mysql')->table('ebooks')->select('*')->get();

        foreach (array_chunk(self::toArray($data),50) as $rows) {
            Ebook::insert($rows);
        }
        // Ebook Translation
        EbookTranslation::truncate();
        $data = DB::connection('mysql')->table('ebook_translations')->select('*')->get();
        foreach (array_chunk(self::toArray($data),50) as $rows) {
            EbookTranslation::insert($rows);
        }

        // Ebook Category
        DB::connection('sqlite')->table('ebook_categories')->truncate();
        $data = DB::connection('mysql')->table('ebook_categories')->select('*')->get();
        foreach (array_chunk(self::toArray($data),50) as $rows) {
            DB::connection('sqlite')->table('ebook_categories')->insert($rows);
        }

        // Ebook Authors
        DB::connection('sqlite')->table('ebook_authors')->truncate();
        $data = DB::connection('mysql')->table('ebook_authors')->select('*')->get();
        foreach (array_chunk(self::toArray($data),50) as $rows) {
            DB::connection('sqlite')->table('ebook_authors')->insert($rows);
        }

        // Ebook Authors
        DB::connection('sqlite')->table('favorite_lists')->truncate();
        $data = DB::connection('mysql')->table('favorite_lists')->select('*')->get();
        foreach (array_chunk(self::toArray($data),50) as $rows) {
            DB::connection('sqlite')->table('favorite_lists')->insert($rows);
        }

		$command->info('Ebook and related tables seeded');
	}

}
