<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Settings;
use Modules\Tour\Models\TourDate;

class TourDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tours = \Modules\Tour\Models\Tour::get();

        $afterDate = date('Y-m-d', strtotime('+90 days'));
        $period = periodDate(date('Y-m-d'), $afterDate);

        $tourDates = [];
        foreach ($tours as $tour) {
            foreach ($period as $dt) {
                $tourDates[] = [
                    'tour_id' => $tour->id,
                    'tour_date' => $dt->format('Y-m-d'),
                ];
            }
        }

        TourDate::insert($tourDates);
    }
}
