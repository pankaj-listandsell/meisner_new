<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Tour\Models\TourTransport;

class TourTransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // types : 'own_pickup', 'own_travel', 'hotel_not_booked', 'hotel'
        $transports = [
            [
                'name' => 'Own Pickup Location',
                'type' => 'own_pickup',
            ],
            [
                'name' => 'Own Travel',
                'type' => 'own_travel',
            ],
            [
                'name' => 'Hotel not booked yet',
                'type' => 'hotel_not_booked',
            ],
            [
                'name' => 'Hotel',
                'type' => 'hotel',
            ]
        ];

        foreach ($transports as $transport) {
            TourTransport::insert(array_merge($transport, [
                'create_user' => 1,
                'status' => 'publish',
                'created_at' =>  date("Y-m-d H:i:s")
            ]));
        }
    }
}
