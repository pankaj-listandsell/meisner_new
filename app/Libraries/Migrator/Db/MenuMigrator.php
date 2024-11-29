<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\MenuItem;
use Modules\Menu\Entities\MenuItemTranslation;
use Modules\Menu\Entities\MenuTranslation;

class MenuMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		Menu::truncate();
		$data = DB::connection('mysql')->table('menus')->select('*')->get();
        Menu::insert(self::toArray($data));

        MenuTranslation::truncate();
        $data = DB::connection('mysql')->table('menu_translations')->select('*')->get();
        MenuTranslation::insert(self::toArray($data));

        MenuItem::truncate();
        $data = DB::connection('mysql')->table('menu_items')->select('*')->get();
        MenuItem::insert(self::toArray($data));

        MenuItemTranslation::truncate();
        $data = DB::connection('mysql')->table('menu_item_translations')->select('*')->get();
        MenuItemTranslation::insert(self::toArray($data));

		$command->info('Menu seeded');
	}

}
