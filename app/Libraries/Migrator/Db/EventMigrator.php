<?php

namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\Event\Entities\Event;
use Modules\Event\Entities\EventTranslation;

class EventMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		Event::truncate();
		$data = DB::connection('mysql')->table('events')->select('*')->get();
        Event::insert(self::toArray($data));

        // Ebook Translation
        EventTranslation::truncate();
        $data = DB::connection('mysql')->table('event_translations')->select('*')->get();
        EventTranslation::insert(self::toArray($data));

		$command->info('Event seeded');
	}

}
