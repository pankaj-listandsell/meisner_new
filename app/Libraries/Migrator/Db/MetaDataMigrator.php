<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\MenuItem;
use Modules\Menu\Entities\MenuItemTranslation;
use Modules\Menu\Entities\MenuTranslation;
use Modules\Meta\Entities\MetaData;
use Modules\Meta\Entities\MetaDataTranslation;

class MetaDataMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		MetaData::truncate();
		$data = DB::connection('mysql')->table('meta_data')->select('*')->get();
        foreach (array_chunk(self::toArray($data),50) as $rows) {
            MetaData::insert($rows);
        }

        MetaDataTranslation::truncate();
        $data = DB::connection('mysql')->table('meta_data_translations')->select('*')->get();
        foreach (array_chunk(self::toArray($data),50) as $rows) {
            MetaDataTranslation::insert($rows);
        }

		$command->info('Meta data seeded');
	}

}
