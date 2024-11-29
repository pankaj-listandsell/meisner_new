<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Settings;

class TourSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::whereIn('name',
            ['tour_highlights', 'tour_price_detail', 'tour_timing', 'tour_program', 'tour_vip_info',])
            ->delete();

        Settings::insert([
            [
                'name' => 'tour_highlights',
                'group' => 'general',
                'val' => '<ul>
                            <li><strong>Feeding the elephants</strong></li>
                            <li><strong>Information about the vision of the park and the past of the elephant</strong></li>
                            <li><strong>Mud Spa Pool</strong></li>
                            <li><strong>Wash the Elephant in the Fresh Water Pool</strong></li>
                            <li><strong>XXL Elephant shower</strong></li>
                            <li><strong>Delicious Thai Buffet</strong></li>
                            </ul>',
                'autoload' => 1,
                'create_user' => 1,
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'tour_price_detail',
                'group' => 'general',
                'val' => '<div class="wpb_wrapper">
                    <p style="text-align: left;">By visiting the «Green Elephant Sanctuary Park Phuket» you also <strong><a style="color: white; text-decoration: underline white;" href="https://www.green-elephantsanctuarypark.com/vision-elephant-sanctuary-park-phuket-2/">contribute to animal protection</a></strong>&nbsp;and to our <a style="color: white; text-decoration: underline white;" href="https://www.green-elephantsanctuarypark.com/vision-elephant-clinic-phuket/">vision «Green <strong>Elephant Clinic Phuket</strong>»</a>.</p>
                    <ul style="text-align: left;">
                    <li>Adults: 2.500 THB(฿)</li>
                    <li>Children (5-10 years): 1.900 THB(฿)</li>
                    <li>Infants (0-4 years): free</li>
                    <li>For special arrangements or larger groups please <a style="color: white; text-decoration: underline white;" href="https://www.green-elephantsanctuarypark.com/contact/">get in touch with us</a></li>
                    </ul>
                    <p style="text-align: left;">In the price included:</p>
                    <ul style="text-align: left;">
                    <li>Pick-up from your hotel</li>
                    <li>Short presentation and introduction to our project and vision</li>
                    <li>Authentic and delicious Thai buffet</li>
                    <li>Free soft drinks</li>
                    <li>During the whole tour we take professional photos and provide them to our attendees on our <a style="color: white; text-decoration: underline white;" href="https://www.facebook.com/greenelephantsanctuarypark/">Facebook-channel</a>.</li>
                    <li>Great fun with our elephants</li>
                    </ul>
                </div>',
                'autoload' => 1,
                'create_user' => 1,
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'tour_timing',
                'group' => 'general',
                'val' => '<div class="wpb_wrapper">
                        <div><img src="/uploads/0000/1/2022/11/15/maedchenmitbabyelo.jpg" alt=""></div>
                        <h2 style="color: #a8b74b; text-align: left;"><strong>HALF-DAY VISIT</strong></h2>
                        <p><strong>Adults 2‘500 baht / person</strong><br>
                        <strong>Children 5 – 10 years 1‘900 baht / person</strong><br>
                        <strong>Children 0 – 4 years free</strong></p>
                        <h2 style="color: #a8b74b; text-align: left;"><strong>MORNING</strong></h2>
                        <p><strong>Pick-up at hotel 6:30 – 7:00</strong><br>
                        <strong>Arrival at hotel 12:00 – 12:30</strong></p>
                        <h2 style="color: #a8b74b; text-align: left;"><strong>AFTERNOON</strong></h2>
                        <p><strong>Pick-up at hotel 12:30 – 13:00</strong><br>
                        <strong>Arrival at hotel 18:00 – 18:30</strong></p>
                    </div>',
                'autoload' => 1,
                'create_user' => 1,
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'tour_program',
                'group' => 'general',
                'val' => '<div class="wpb_wrapper">
                    <h2 style="color: #a8b74b; text-align: left;"><strong>PROGRAM</strong></h2>
                    <p>We pick you up directly from your hotel and you enjoy a ride through remote rolling hills past idyllic beaches directly into the jungle in north-west Phuket. After arriving at the “Green Elephant Sanctuary Park” you will have the opportunity to <strong>feed the large elephants and young animals</strong>. We then continue to <strong>a short presentation</strong> in English of our vision, the park and the Asian elephant. After changing, you can <strong>rub the elephants</strong> and yourself with mud in the spa pool. It makes for the most <strong>beautiful souvenir photo</strong> taken by park photographers during the entire visit. Then you can <strong>wash the mud off the elephants</strong> and yourself in the freshwater pool before <strong>having fun with the elephants under the XXL adventure shower</strong>. After showering, you can enjoy a <strong>rich, authentic Thai buffet</strong>. And finally you can say your goodbyes to the elephants before we bring you back to your hotel.</p>
                    <h2 style="color: #a8b74b; text-align: left;"><strong>WHAT TO BRING</strong></h2>
                    <ul>
                        <li><strong>A change of clothing and good shoes or sandals that can<br>
                        get wet and dirty</strong></li>
                        <li><strong>Swimsuit and towel</strong></li>
                        <li><strong>Sunscreen &amp; Insect repellent</strong></li>
                        <li><strong>Personal medication</strong></li>
                    </ul>
                    <h2 style="color: #a8b74b; text-align: left;"><strong>PICKUP TIMES</strong></h2>
                    <h4><strong>Morning-Tour :&nbsp;</strong></h4>
                    <ul>
                        <li class="p1"><span class="s1">Kata 6.30 – 6.45</span></li>
                        <li class="p1"><span class="s1">Karon 6.45 – 7.00</span></li>
                        <li class="p1"><span class="s1">Patong Zone 7.00 – 7.20</span></li>
                        <li class="p1"><span class="s1">Kamala 7.30 – 7.45</span></li>
                        <li class="p1"><span class="s1">Surin, Bang-tao 7.45 – 8.00</span></li>
                        <li class="p1"><span class="s1">Phuket Town, Chalong, Rawaii 6.00&nbsp;– 6.20</span></li>
                    </ul>
                    <h4><strong>Afternoon-Tour:</strong></h4>
                    <ul>
                        <li class="p1"><span class="s1">Kata 12.30 – 12.45</span></li>
                        <li class="p1"><span class="s1">Karon 12.45 – 13.00</span></li>
                        <li class="p1"><span class="s1">Patong Zone 13.00 – 13.20</span></li>
                        <li class="p1"><span class="s1">Kamala 13.30 – 13.45</span></li>
                        <li class="p1"><span class="s1">Surin, Bang-tao 13.45 – 14.00</span></li>
                        <li class="p1"><span class="s1">Phuket Town, Chalong, Rawaii 12.00 – 12.20</span></li>
                    </ul>
                </div>',
                'autoload' => 1,
                'create_user' => 1,
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'tour_vip_info',
                'group' => 'general',
                'val' => '<div class="wpb_wrapper">
                            <div><strong><img src="/uploads/0000/1/2022/12/15/karte-phuket-1.jpg" alt="" width="100%" height="auto"></strong></div>
                            <h2 style="color: #a8b74b; text-align: left;"><strong>VIP EVENTS AND TOURS</strong></h2>
                            <p><strong>For a personal and greater experience with the elephants,<br>
                            we offer various special programmes for small groups.</strong></p>
                            <h3 style="color: #a8b74b; text-align: left;">Programmes:</h3>
                            <ul>
                            <li><strong>VIP programs</strong></li>
                            <li><strong>Honeymoon</strong></li>
                            <li><strong>Marriage Fotoshooting</strong></li>
                            <li><strong>Team Building Events</strong></li>
                            </ul>
                            <p>Don‘t hestitate to <a href="https://www.green-elephantsanctuarypark.com/contact/">contact us to express your wishes</a>. We<br>
                            offer you your special event gladly.</p>
                        </div>',
                'autoload' => 1,
                'create_user' => 1,
                'created_at' =>  date("Y-m-d H:i:s")
            ],
        ]);
    }
}
