<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Tour\Models\TourHotel;

class TourHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotels = [
            '217@HKT', '2W Cafe & Hostel', '6th Avenue Surin Beach', '7 Sky Residency', '@Buasri By Ohm', 'A Casa Di Luca',
            'A2 Resort', 'Absolute Guesthouse Phuket', 'ACCA Patong', 'Access Resort & Villas', 'Add Plus Hotel & Spa',
            'Adonis Guest House', 'Allstar Guesthouse', 'Allya Patong Hotel', 'AM Surin Place', 'AMA Phuket Hostel', 'Amari patong beach Phuket',
            'Amatara Wellness Resort', 'Amaya Beach Resort & Spa Phuket', 'Amber Residence', 'Ananta Thai Pool Villas Resort Phuket',
            'Anantara Mai Khao Phuket Villas', 'Anchor Boutique House', 'Anda Beachside Hotel', 'Andakira Hotel',
            'Andaman Beach Suites Hotel', 'Andaman Sea Guesthouse', 'Andaman Seaview Hotel - Karon Beach', 'Andatel Grande Patong Phuket',
            'Andatel Grande Patong Phuket', 'Ao Po Grand Marina Pier', 'APK Resort And Spa', 'AQUA Villa Rawai', 'Arita House',
            'Armoni Patong Beach Hotel', 'Art @ Patong', 'Art at Patong, Apartments by Naresh', 'Art-C House', 'Arya Boutique Room',
            'Ascot Boutique Hotel', 'Asena Karon Resort', 'Ashlee HUB Hotel', 'At Naiharn Boutique Hotel', 'At Night Hostel',
            'At Phuket Inn Patong Beach', 'At The Tree Condominium Phuket', 'Atika Villas', 'Avantika Boutique Hotel', 'Avista Hideaway Phuket Patong, MGallery by Sofitel',
            'Ayara Hilltops', 'Azhotel Patong', 'B & L Guesthouse', 'B-Lay Tong Phuket', 'B2 Phuket', 'Baan Chaylay', 'Baan Karon Hill Phuket Resort',
            'Baan Karonburi Resort', 'Baan Laimai Beach Resort', 'Baan Phu Prana Boutique Villa', 'Baan PhuAnda Phuket', 'Baan Pron Phateep',
            'Baan Sabai', 'Baan Sailom Hotel Phuket', 'Baan Sutra Guesthouse', 'Baan Suwantawe', 'Baan Thai Break', 'Baan Vanida Garden Resort',
            'Baan Yin Dee Boutique Resort Phuket', 'Baan Yuree Resort & Spa', 'Baannaraya Exclusive Pool Villa Residence', 'Baba House Hotel',
            'Baipho Lifestyle', 'Bamboo House Phuket', 'Ban Elephant Blanc', 'Bandai Poshtel', 'Bandara Phuket Beach Resort',
            'Bangkok Residence', 'Baramee Hip Hotel', 'Baramee Resortel', 'Barefoot Hotel Kalim Beach Front', 'Bauman Grand',
            'Baumancasa Beach Resort', 'Bayshore Ocean View', 'Bed Hostel', 'Beehive Patong Hostel', 'Bel Air Condo Cape Panwa',
            'Benyada Lodge - Surin beach', 'Beyond Resort Karon', 'Bhukitta Hotel & Spa', 'Bliss Patong Studio', 'Blu Monkey Hub and Hotel',
            'Blue Ocean Resort', 'Box Poshtel Phuket', 'Buasri Phuket Hotel', 'Burasari Phuket', 'BYD Lofts Boutique Hotel & Serviced Apartments',
            'Cafe 66 Hostel', 'Cafe\' 66 House @ Patong Beach', 'Cape Panwa Hotel'
        ];


        foreach ($hotels as $hotel) {
            TourHotel::create([
                'name' => $hotel,
                'phone_no' => str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT),
                'create_user' => 1,
                'status' => 'publish',
                'created_at' =>  date("Y-m-d H:i:s")
            ]);
        }
    }
}
