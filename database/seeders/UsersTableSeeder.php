<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name'        => 'System',
            'last_name'         => 'Admin',
            'email'             => 'dhana@listandsell.de',
            'password'          => bcrypt('password'),
            'phone'             => '112 666 888',
            'status'            => 'publish',
            'city'              => 'Berlin',
            'country'            => 'Germany',
            'created_at'        => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'active_status'     => 1,
            'need_update_pw'    => 0
        ]);
        $user = \App\User::where('email', 'dhana@listandsell.de')->first();

        $user->assignRole('administrator');

        DB::table('users')->insert([
            'first_name'        => 'Vishal',
            'last_name'         => 'Rana',
            'email'             => 'vishal@listandsell.de',
            'password'          => bcrypt('password'),
            'phone'             => '112 666 888',
            'dob'               => '2000-01-01',
            'status'            => 'publish',
            'city'              => 'Berlin',
            'country'           => 'Germany',
            'active_status'     => 1,
            'created_at'        => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
        ]);
        $user = \App\User::where('email', 'vishal@listandsell.de')->first();
        $user->assignRole('customer');
        $user->save();
    }
}
