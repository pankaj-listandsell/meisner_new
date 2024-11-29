<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Core\Models\Settings;
use Modules\Location\Models\LocationCategory;
use Modules\User\Emails\CreditPaymentEmail;

class LocationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $argv = [
            [
                'name' => 'Education',
                'icon_class' => 'icofont-education',
                'status' => 'publish'
            ],
            [
                'name' => 'Health',
                'icon_class' => 'fa fa-hospital-o',
                'status' => 'publish'
            ],
            [
                'name' => 'Transportation',
                'icon_class' => 'fa fa-subway',
                'status' => 'publish'
            ],
        ];

        LocationCategory::insert($argv);
    }
}
