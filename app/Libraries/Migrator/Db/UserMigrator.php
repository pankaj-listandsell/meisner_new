<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\User\Models\User;

class UserMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		User::truncate();
		$data = DB::connection('mysql')->table('users')->select('*')->get();
        User::insert(self::toArray($data));

        // Roles
        Role::truncate();
        $data = DB::connection('mysql')->table('roles')->select('*')->get();
        Role::insert(self::toArray($data));

        // User Roles
        DB::connection('sqlite')->table('user_roles')->truncate();
        $data = DB::connection('mysql')->table('user_roles')->select('*')->get();
        DB::connection('sqlite')->table('user_roles')->insert(self::toArray($data));

        // User Persistence
        DB::connection('sqlite')->table('persistences')->truncate();
        $data = DB::connection('mysql')->table('persistences')->select('*')->get();
        DB::connection('sqlite')->table('persistences')->insert(self::toArray($data));

		$command->info('User, Roles, Persistence seeded');
	}

}
