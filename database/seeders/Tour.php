<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;
use Modules\Tour\Models\TourCategory;

use Modules\Review\Models\Review;
use Modules\Review\Models\ReviewMeta;

class Tour extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'City trips', 'content' => '', 'status' => 'publish'],
            ['name' => 'Ecotourism', 'content' => '', 'status' => 'publish'],
        ];

        foreach ($categories as $category) {
            $row = new TourCategory($category);
            $row->save();
        }

        $list_gallery = [];
        for ($i = 1; $i <= 1; $i++) {
            $list_gallery[] = MediaFile::findMediaByName("gallery-" . $i)->id;
        }
        $IDs_vendor[] = $create_user = "1";

        $IDs[] = DB::table('bravo_tours')->insertGetId([
                'title' => 'Morning Tour',
                'slug' => 'morning-tour',
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural tour Northern California Summer 2019, you have a 8 day tour package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => 349,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-1")->id,
                'category_id' => rand(1, 4),
                'max_person' => 100,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'pickup_time' => '6:30-7:45',
                'arrival_time' => '11:00-12:00',
                'gallery' => implode(",", $list_gallery),
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => $create_user,
                'created_at' => date("Y-m-d H:i:s"),
                'itinerary' => '',
                'color' => '#00FF1E',
                'transport_ids' => '[1,2,3]',
            ]);

        $IDs_vendor[] = $create_user = "1";
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'Afternoon Tour',
                'slug' => 'afternoon-tour',
                'content' => "",
                'image_id' => 350,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-1")->id,
                'max_person' => 100,
                'category_id' => rand(1, 4),
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'pickup_time' => '6:30-7:45',
                'arrival_time' => '11:00-12:00',
                'gallery' => implode(",", $list_gallery),
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => $create_user,
                'created_at' => date("Y-m-d H:i:s"),
                'itinerary' => '',
                'color' => '#0008FF',
                'transport_ids' => '[1,2,3,4]',
            ]);
        $IDs_vendor[] = $create_user = "1";
        $IDs[] = DB::table('bravo_tours')->insertGetId(
            [
                'title' => 'VIP Tour',
                'slug' => 'vip-tour',
                'content' => "",
                'image_id' => 350,
                'banner_image_id' => MediaFile::findMediaByName("banner-tour-1")->id,
                'max_person' => 100,
                'category_id' => rand(1, 4),
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'gallery' => implode(",", $list_gallery),
                'faqs' => '[{"title":"When and where does the tour end?","content":"Your tour will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the tour start?","content":"Day 1 of this tour is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this tour, however you can book for an arrival transfer in advance. In this case a tour operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This tour has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this tour. However, if you are over 70 years please contact us as you may be eligible to join the tour if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => $create_user,
                'created_at' => date("Y-m-d H:i:s"),
                'itinerary' => '',
                'color' => '#FF7300',
                'transport_ids' => '[1,2,3,4]',
                'is_vip' => 1,
            ]);

        // Add meta for tour
        foreach ($IDs as $numer_key => $tour) {
            $vendor_id = $IDs_vendor[$numer_key];
            DB::table('bravo_tour_pricing')->insertGetId(
                [
                    'tour_id'       => $tour,
                    'person_type'   => 'adult',
                    'min_persons'   => 1,
                    'price'         => 30,
                ]
            );
            DB::table('bravo_tour_pricing')->insertGetId(
                [
                    'tour_id' => $tour,
                    'person_type' => 'child',
                    'price' => 20,
                ]
            );
            DB::table('bravo_tour_pricing')->insertGetId(
                [
                    'tour_id' => $tour,
                    'person_type' => 'infant',
                    'price' => 0,
                ]
            );

        }

        // Settings Tour
        DB::table('core_settings')->insert(
            [
                [
                    'name' => 'tour_page_search_title',
                    'val' => 'Search for tour',
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_page_limit_item',
                    'val' => 9,
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_page_search_banner',
                    'val' => MediaFile::findMediaByName("banner-search")->id,
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_layout_search',
                    'val' => 'normal',
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_enable_review',
                    'val' => '1',
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_review_approved',
                    'val' => '0',
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_review_stats',
                    'val' => '[{"title":"Service"},{"title":"Organization"},{"title":"Friendliness"},{"title":"Area Expert"},{"title":"Safety"}]',
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_booking_buyer_fees',
                    'val' => '[{"name":"Service fee","desc":"This helps us run our platform and offer services like 24\/7 support on your trip.","name_ja":"\u30b5\u30fc\u30d3\u30b9\u6599","desc_ja":"\u3053\u308c\u306b\u3088\u308a\u3001\u5f53\u793e\u306e\u30d7\u30e9\u30c3\u30c8\u30d5\u30a9\u30fc\u30e0\u3092\u5b9f\u884c\u3057\u3001\u65c5\u884c\u4e2d\u306b","price":"100","type":"one_time"}]',
                    'group' => "tour",
                ],
                [
                    'name' => 'tour_map_search_fields',
                    'val' => '[{"field":"location","attr":null,"position":"1"},{"field":"category","attr":null,"position":"2"},{"field":"date","attr":null,"position":"3"},{"field":"price","attr":null,"position":"4"},{"field":"advance","attr":null,"position":"5"}]',
                    'group' => 'tour'
                ],
                [
                    'name' => 'tour_search_fields',
                    'val' => '[{"title":"Location","field":"location","size":"6","position":"1"},{"title":"From - To","field":"date","size":"6","position":"2"}]',
                    'group' => 'tour'
                ]
            ]
        );

        $a = new \Modules\Core\Models\Attributes([
            'name' => 'Travel Styles',
            'service' => 'tour'
        ]);

        $a->save();


        $a = new \Modules\Core\Models\Attributes([
            'name' => 'Facilities',
            'service' => 'tour'
        ]);
        $a->save();

        $term_ids = [];
        foreach (['Wifi', 'Bath'] as $term) {
            $t = new \Modules\Core\Models\Terms([
                'name' => $term,
                'attr_id' => $a->id
            ]);
            $t->save();
            $term_ids[] = $t->id;
        }
        foreach ($IDs as $tour_id) {
            foreach ($term_ids as $k => $term_id) {
                if (rand(0, count($term_ids)) == $k) continue;
                if (rand(0, count($term_ids)) == $k) continue;
                if (rand(0, count($term_ids)) == $k) continue;
                \Modules\Tour\Models\TourTerm::firstOrCreate([
                    'term_id' => $term_id,
                    'tour_id' => $tour_id
                ]);
            }
        }

    }
}
