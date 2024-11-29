<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\Author\Entities\Author;
use Modules\Author\Entities\AuthorTranslation;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\CategoryTranslation;

class CategoryMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		Category::truncate();
		$data = DB::connection('mysql')->table('categories')->select('*')->get();
        Category::insert(self::toArray($data));

        CategoryTranslation::truncate();
        $data = DB::connection('mysql')->table('category_translations')->select('*')->get();
        CategoryTranslation::insert(self::toArray($data));

		$command->info('Category seeded');
	}

}
