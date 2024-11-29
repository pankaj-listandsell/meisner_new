<?php
namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;

class General extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Setting header,footer
        $menu_items_en = $this->generalMenu();
        DB::table('core_menus')->insert([
            'name'        => 'Main Menu',
            'items'       => json_encode($menu_items_en),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
        $menu_items_de = $this->generalMenu("/de");
        DB::table('core_menu_translations')->insert([
            'origin_id'   => '1',
            'locale'      => 'de',
            'items'       =>json_encode($menu_items_de),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        $siteName = config('app.name');

        DB::table('core_settings')->insert(
            [
                [
                    'name'  => 'menu_locations',
                    'val'   => '{"primary":1}',
                    'group' => "general",
                ],
                [
                    'name'  => 'footer_menu_locations',
                    'val'   => '2',
                    'group' => "general",
                ],
                [
                    'name'  => 'admin_email',
                    'val'   => 'office@green-elephantsanctuarypark.com',
                    'group' => "general",
                ], [
                    'name'  => 'email_from_name',
                    'val'   => 'Green Elephant Sanctuary Park',
                    'group' => "general",
                ], [
                    'name'  => 'email_from_address',
                    'val'   => 'office@green-elephantsanctuarypark.com',
                    'group' => "general",
                ],
                [
                    'name'  => 'logo_id',
                    'val'   => MediaFile::findMediaByName("logo")->id,
                    'group' => "general",
                ],
                [
                    'name'  => 'site_favicon',
                    'val'   => MediaFile::findMediaByName("favicon")->id,
                    'group' => "general",
                ],
                [
                    'name'  => 'topbar_left_text',
                    'val'   => '<div class="socials">
<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-linkedin"></i></a>
<a href="#"><i class="fa fa-google-plus"></i></a>
</div>
<span class="line"></span>
<a href="mailto:office@green-elephantsanctuarypark.com">office@green-elephantsanctuarypark.com</a>',
                    'group' => "general",
                ],
                [
                    'name'  => 'footer_text_left',
                    'val'   => 'Copyright © www.green-elephantsanctuarypark.com',
                    'group' => "general",
                ],
                [
                    'name'  => 'footer_text_right',
                    'val'   => '',
                    'group' => "general",
                ],
                [
                    'name'  => 'list_widget_footer',
                    'val'   => '[{"title":"NEED HELP?","size":"3","content":"<div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Call Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            + 00 222 44 5678\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Email for Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            ges@mail.com\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            Follow Us\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            <a href=\"#\">\r\n                <i class=\"icofont-facebook\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n               <i class=\"icofont-twitter\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n                <i class=\"icofont-youtube-play\"><\/i>\r\n            <\/a>\r\n        <\/div>\r\n    <\/div>"},{"title":"COMPANY","size":"3","content":"<ul>\r\n    <li><a href=\"#\">About Us<\/a><\/li>\r\n    <li><a href=\"#\">Community Blog<\/a><\/li>\r\n    <li><a href=\"#\">Rewards<\/a><\/li>\r\n    <li><a href=\"#\">Work with Us<\/a><\/li>\r\n    <li><a href=\"#\">Meet the Team<\/a><\/li>\r\n<\/ul>"},{"title":"SUPPORT","size":"3","content":"<ul>\r\n    <li><a href=\"#\">Account<\/a><\/li>\r\n    <li><a href=\"#\">Legal<\/a><\/li>\r\n    <li><a href=\"#\">Contact<\/a><\/li>\r\n    <li><a href=\"#\">Affiliate Program<\/a><\/li>\r\n    <li><a href=\"#\">Privacy Policy<\/a><\/li>\r\n<\/ul>"},{"title":"SETTINGS","size":"3","content":"<ul>\r\n<li><a href=\"#\">Setting 1<\/a><\/li>\r\n<li><a href=\"#\">Setting 2<\/a><\/li>\r\n<\/ul>"}]',
                    'group' => "general",
                ],
                [
                    'name'  => 'list_widget_footer_ja',
                    'val'   => '[{"title":"\u52a9\u3051\u304c\u5fc5\u8981\uff1f","size":"3","content":"<div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            \u304a\u96fb\u8a71\u304f\u3060\u3055\u3044\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            + 00 222 44 5678\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            \u90f5\u4fbf\u7269\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            ges@mail.com\r\n        <\/div>\r\n    <\/div>\r\n    <div class=\"contact\">\r\n        <div class=\"c-title\">\r\n            \u30d5\u30a9\u30ed\u30fc\u3059\u308b\r\n        <\/div>\r\n        <div class=\"sub\">\r\n            <a href=\"#\">\r\n                <i class=\"icofont-facebook\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n                <i class=\"icofont-twitter\"><\/i>\r\n            <\/a>\r\n            <a href=\"#\">\r\n                <i class=\"icofont-youtube-play\"><\/i>\r\n            <\/a>\r\n        <\/div>\r\n    <\/div>"},{"title":"\u4f1a\u793e","size":"3","content":"<ul>\r\n    <li><a href=\"#\">\u7d04, \u7565<\/a><\/li>\r\n    <li><a href=\"#\">\u30b3\u30df\u30e5\u30cb\u30c6\u30a3\u30d6\u30ed\u30b0<\/a><\/li>\r\n    <li><a href=\"#\">\u5831\u916c<\/a><\/li>\r\n    <li><a href=\"#\">\u3068\u9023\u643a<\/a><\/li>\r\n    <li><a href=\"#\">\u30c1\u30fc\u30e0\u306b\u4f1a\u3046<\/a><\/li>\r\n<\/ul>"},{"title":"\u30b5\u30dd\u30fc\u30c8","size":"3","content":"<ul>\r\n    <li><a href=\"#\">\u30a2\u30ab\u30a6\u30f3\u30c8<\/a><\/li>\r\n    <li><a href=\"#\">\u6cd5\u7684<\/a><\/li>\r\n    <li><a href=\"#\">\u63a5\u89e6<\/a><\/li>\r\n    <li><a href=\"#\">\u30a2\u30d5\u30a3\u30ea\u30a8\u30a4\u30c8\u30d7\u30ed\u30b0\u30e9\u30e0<\/a><\/li>\r\n    <li><a href=\"#\">\u500b\u4eba\u60c5\u5831\u4fdd\u8b77\u65b9\u91dd<\/a><\/li>\r\n<\/ul>"},{"title":"\u8a2d\u5b9a","size":"3","content":"<ul>\r\n<li><a href=\"#\">\u8a2d\u5b9a1<\/a><\/li>\r\n<li><a href=\"#\">\u8a2d\u5b9a2<\/a><\/li>\r\n<\/ul>"}]',
                    'group' => "general",
                ],
                [
                    'name' => 'page_contact_title',
                    'val' => "We'd love to hear from you",
                    'group' => "general",
                ],
                [
                    'name' => 'page_contact_sub_title',
                    'val' => "Send us a message and we'll respond as soon as possible",
                    'group' => "general",
                ],
                [
                    'name' => 'page_contact_desc',
                    'val' => "<!DOCTYPE html><html><head></head><body><h3>Green Elephant Sanctuary Park</h3><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>Tell. + 00 222 444 33</p><p>Email. ges@mail.com</p><p>1355 Market St, Suite 900San, Francisco, CA 94103 United States</p></body></html>",
                    'group' => "general",
                ],
                [
                    'name' => 'page_contact_image',
                    'val' => MediaFile::findMediaByName("bg_contact")->id,
                    'group' => "general",
                ],
                [
                    'name' => 'api_app_layout',
                    'val' => "1",
                    'group' => "api",
                ]
            ]
        );

        $banner_image = MediaFile::findMediaByName("banner-search")->id;
        $banner_home_mix = MediaFile::findMediaByName("home-mix")->id;
        $banner_home_mix_2 = MediaFile::findMediaByName("banner-tour-4")->id;
        $image_home_mix_1 = MediaFile::findMediaByName("image_home_mix_1")->id;
        $image_home_mix_2 = MediaFile::findMediaByName("image_home_mix_2")->id;
        $image_home_mix_3 = MediaFile::findMediaByName("image_home_mix_3")->id;
        $icon_about_1 = MediaFile::findMediaByName("ico_localguide")->id;
        $icon_about_2 = MediaFile::findMediaByName("ico_adventurous")->id;
        $icon_about_3 = MediaFile::findMediaByName("ico_maps")->id;
        $avatar = MediaFile::findMediaByName("avatar")->id;
        $avatar_2 = MediaFile::findMediaByName("avatar-2")->id;
        $avatar_3 = MediaFile::findMediaByName("avatar-3")->id;
        // Setting Home Page
        DB::table('core_templates')->insert([
            'title'       => 'Home Page',
            'content'     => '[{\"type\":\"slider_with_content\",\"name\":\"Slider With Content\",\"model\":{\"title\":\"\",\"sub_title\":\"\",\"class\":\"home\",\"style\":\"carousel_v2\",\"bg_image\":\"\",\"list_slider\":[{\"_active\":true,\"title\":\"Green Elephant <br\/>Sanctuary Park\",\"desc\":\"Phuket\",\"bg_image\":229,\"sub\":\"Welcome to\"},{\"_active\":true,\"title\":\"Elephant Life Experience \",\"desc\":\"Phuket\",\"bg_image\":228,\"sub\":\"we provide you\"},{\"_active\":true,\"title\":\"Elephant Bath\",\"desc\":\"Phuket\",\"bg_image\":227,\"sub\":\"we provide you\"},{\"_active\":true,\"title\":\"Washing With Elephants\",\"desc\":\"Phuket\",\"bg_image\":230,\"sub\":\"at our park\"}]},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"list_tours\",\"name\":\"Tour: List Items\",\"model\":{\"title\":\"CHOOSE YOUR TOUR   \",\"desc\":\"FEEL THE TRAVEL OF YOUR SOUL\",\"number\":\"\",\"style\":\"box_shadow\",\"category_id\":\"\",\"location_id\":\"\",\"order\":\"\",\"order_by\":\"\",\"is_featured\":\"\",\"custom_ids\":[\"\",16,15],\"is_active\":\"\"},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"slider_with_content\",\"name\":\"Slider With Content\",\"model\":{\"title\":\"WHAT MAKES THE TOUR DIFFERENT? \",\"sub_title\":\"\",\"class\":\"bg-text\",\"style\":\"\",\"bg_image\":233,\"list_slider\":[]},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"grid_with_content\",\"name\":\"Grid With Content\",\"model\":{\"grid_content\":[{\"_active\":true,\"content\":\"<h3>Elephant Sanctuary: Experience elephants in a whole new way<\/h3>\\n<p>Elephants belong to Thailand as well as the sea, good food and the fascinating culture. For centuries, elephants have been seen as holy in Thailand. Today elephant figures are still put in front of many buildings and sold as motifs on clothing or souvenir. However, the number of elephants in Thailand is diminishing. For this reason, it is absolutely crucial to protect not only the wise giants but also their natural habitat. An Elephant sanctuary is the right address! Visit us and be impressed by the huge animals.&nbsp;<a style=\\\"margin: 0px; padding: 0px; color: #a4bb3d; background: 0px 0px; border: 0px; vertical-align: baseline; outline: 0px; text-decoration-line: none; cursor: pointer; transition: color 0.25s ease-in-out 0s;\\\" href=\\\"https:\/\/www.green-elephantsanctuarypark.com\/booking\/\\\">Experience the very special atmosphere in our camp yourself!<\/a><\/p>\\n<h3>Experience elephants in the elephant sanctuary<\/h3>\\n<p>In the Elephant sanctuary you can experience elephants in the most natural way. In their natural environment, where they are free and simply wonderful! It is important to us that you can&nbsp;<a style=\\\"margin: 0px; padding: 0px; color: #a4bb3d; background: 0px 0px; border: 0px; vertical-align: baseline; outline: 0px; text-decoration-line: none; cursor: pointer; transition: color 0.25s ease-in-out 0s;\\\" href=\\\"https:\/\/www.green-elephantsanctuarypark.com\/tour-program\/\\\">experience the daily life of the animals<\/a>. And that you can&nbsp;<a style=\\\"margin: 0px; padding: 0px; color: #a4bb3d; background: 0px 0px; border: 0px; vertical-align: baseline; outline: 0px; text-decoration-line: none; cursor: pointer; transition: color 0.25s ease-in-out 0s;\\\" href=\\\"https:\/\/www.green-elephantsanctuarypark.com\/tour-program\/\\\">approach them when feeding or bathing<\/a>. Briefly:&nbsp;<strong style=\\\"margin: 0px; padding: 0px; background: 0px 0px; border: 0px; vertical-align: baseline; outline: 0px;\\\">it is a wonderful experience that you will remember for a long time.<\/strong>&nbsp;How much do you want to bet?<\/p>\\n<h3>Elephant Sanctuary: Help and protection for homeless elephants<\/h3>\\n<p>Thousands and thousands of elephants have been living in Thailand for many decades. In the recent years, the number of these gentle animals has been greatly reduced. In 1950, there were still about 50,000 elephants, whilst today there are only 3,000 to 3,500 left. The main reason for this is clearing of woods and forests, which often takes the lives of these fascinating animals. We are committed to the protection of elephants by offering them a safe and protected life in the elephant sanctuary. By the way, the supply of a single elephant costs several hundred dollars a month and an elephant consumes up to 200 kilograms of food a day. With our work, we do not only ensure the livelihood of the animals, but also their well-being and comfort.<\/p>\",\"mapElement\":null,\"addressElement\":null,\"class\":\"col-lg-8\"},{\"_active\":false,\"content\":\"<p><img src=\\\"..\/..\/..\/..\/uploads\/0000\/1\/2022\/10\/03\/thai-map.png\\\" alt=\\\"\\\" width=\\\"100%\\\" height=\\\"100%\\\" \/><\/p>\",\"mapElement\":null,\"addressElement\":null,\"class\":\"col-lg-4\"}],\"class\":\"text-sec\"},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"grid_with_content\",\"name\":\"Grid With Content\",\"model\":{\"grid_content\":[{\"_active\":true,\"content\":\"<h3>Enjoying elephants means collecting memories!<\/h3>\\n<p>Would you like to<strong>&nbsp;<a href=\\\"https:\/\/www.green-elephantsanctuarypark.com\/booking\/\\\">see elephants in real life<\/a><\/strong>? Do you want to&nbsp;<strong>pet elephants<\/strong>? Do you want to&nbsp;<strong>watch these huge animals swim or feed<\/strong>? In our elephant sanctuary you are just right! We offer you the opportunity to&nbsp;<strong style=\\\"margin: 0px; padding: 0px; background: 0px 0px; border: 0px; vertical-align: baseline; outline: 0px;\\\">experience the animals<\/strong>. You are, of course, accompanied by experienced elephant trainers so that you can feel completely safe. Very important to us: our animals are looked after by us optimally and they can feel comfortable with us. We are against animal abuse and make sure that the animals are always well.<\/p>\",\"mapElement\":null,\"addressElement\":null,\"class\":\"col-lg-12\"}],\"class\":\"text-sec padding-top-0\"},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"grid_with_content\",\"name\":\"Grid With Content\",\"model\":{\"grid_content\":[{\"_active\":true,\"content\":\"<p><span style=\\\"font-family: Lato, sans-serif; font-size: 36px; font-weight: bold; text-align: center; background-color: #ffffff;\\\"><img style=\\\"display: block; margin-left: auto; margin-right: auto;\\\" src=\\\"..\/..\/..\/..\/uploads\/0000\/1\/2022\/10\/03\/speak-with-epert.jpg\\\" alt=\\\"\\\" width=\\\"200\\\" height=\\\"200\\\" \/><\/span><\/p>\\n<p style=\\\"text-align: center;\\\"><span style=\\\"font-family: Lato, sans-serif; font-size: 36px; font-weight: bold; text-align: center; background-color: #ffffff;\\\">SPEAK TO OUR EXPERTS<\/span><\/p>\\n<p style=\\\"text-align: center;\\\"><a href=\\\"mailto:info@greenelephantsanctuary.com\\\" target=\\\"_blank\\\" rel=\\\"noopener\\\"><span class=\\\"mail-icon fa fa-envelope\\\"><span class=\\\"text\\\">hi<\/span><\/span><\/a><\/p>\\n<p style=\\\"text-align: center;\\\"><br \/><a href=\\\"mailto:office@green-elephantsanctuarypark.com\\\" target=\\\"_blank\\\" rel=\\\"noopener\\\">office@green-elephantsanctuarypark.com<\/a><\/p>\\n<p>&nbsp;<\/p>\\n<p style=\\\"text-align: center;\\\"><br \/><a class=\\\"btn-primary\\\" href=\\\"..\/..\/..\/..\/booking\\\">CONTACT FORM!<\/a><\/p>\",\"mapElement\":null,\"addressElement\":null,\"class\":\"contact-sec\"}],\"class\":\"\"},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"call_to_action\",\"name\":\"Call To Action\",\"model\":{\"title\":\"Green Elephant Sanctuary Park Phuket: \",\"sub_title\":\"Big fun. Little price!  \",\"link_title\":\"BOOK NOW\",\"link_more\":\"\/booking\",\"style\":\"\",\"bg_color\":\"\",\"bg_image\":\"\"},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false}]',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
        DB::table('core_template_translations')->insert([
            'origin_id'   => '1',
            'locale'      => 'de',
            'title'       => 'Home Page',
            'content'     => '[{\"type\":\"form_search_all_service\",\"name\":\"Form Search All Service\",\"model\":{\"service_types\":[\"hotel\",\"space\",\"tour\",\"car\",\"event\",\"flight\",\"boat\"],\"title\":\"\u3053\u3093\u306b\u3061\u306f\uff01\",\"sub_title\":\"\u3069\u3053\u306b\u884c\u304d\u305f\u3044\uff1f\",\"bg_image\":16},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"offer_block\",\"name\":\"Offer Block\",\"model\":{\"list_item\":[{\"_active\":true,\"title\":\"\u7279\u5225\u30aa\u30d5\u30a1\u30fc\",\"desc\":\"\u6700\u9069\u306a\u30db\u30c6\u30eb\u3092\u63a2\u3059<br>\\n20,000\u4ee5\u4e0a\u306e\u7269\u4ef6\u306e\u4fa1\u683c<br>\\n\u4e0a\u306e\u6700\u9ad8\u306e\u4fa1\u683c\",\"background_image\":17,\"link_title\":\"\u53d6\u5f15\",\"link_more\":\"#\",\"featured_text\":\"\u30db\u30ea\u30c7\u30fc\u30bb\u30fc\u30eb\"},{\"_active\":true,\"title\":\"\u30cb\u30e5\u30fc\u30b9\u30ec\u30bf\u30fc\",\"desc\":\"\u7121\u6599\u3067\u53c2\u52a0\u3057\u3066\u53d6\u5f97 <br>\\n\u306b\u5408\u308f\u305b\u305f\u30cb\u30e5\u30fc\u30b9\u30ec\u30bf\u30fc<br>\\n\u30db\u30c3\u30c8\u65c5\u884c\u60c5\u5831\u3002\",\"background_image\":18,\"link_title\":\"\u30b5\u30a4\u30f3\u30a2\u30c3\u30d7\",\"link_more\":\"\/register\",\"featured_icon\":\"icofont-email\"},{\"_active\":true,\"title\":\"\u65c5\u884c\u306e\u30d2\u30f3\u30c8\",\"desc\":\"\u65c5\u884c\u306e\u5c02\u9580\u5bb6\u304b\u3089\u306e\u30d2\u30f3\u30c8 <br>\\n\u3042\u306a\u305f\u306e\u6b21\u306e<br>\\n\u3088\u308a\u826f\u3044\u3002\",\"background_image\":19,\"link_title\":\"\u30b5\u30a4\u30f3\u30a2\u30c3\u30d7\",\"link_more\":\"\/register\",\"featured_text\":null,\"featured_icon\":\"icofont-island-alt\"}]},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"list_hotel\",\"name\":\"Hotel: List Items\",\"model\":{\"title\":\"\u30d9\u30b9\u30c8\u30bb\u30e9\u30fc\u30ea\u30b9\u30c8\",\"desc\":\"\u601d\u616e\u6df1\u3044\u30c7\u30b6\u30a4\u30f3\u3067\u9ad8\u3044\u8a55\u4fa1\u3092\u5f97\u3066\u3044\u308b\u30db\u30c6\u30eb\",\"number\":4,\"style\":\"normal\",\"location_id\":\"\",\"order\":\"id\",\"order_by\":\"asc\",\"is_featured\":\"\"},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"list_locations\",\"name\":\"List Locations\",\"model\":{\"service_type\":[\"space\",\"hotel\",\"tour\"],\"title\":\"\u4eba\u6c17\u306e\u76ee\u7684\u5730\",\"desc\":\"\u8aad\u8005\u304c\",\"number\":6,\"layout\":\"style_4\",\"order\":\"id\",\"order_by\":\"asc\",\"to_location_detail\":\"\"},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"list_tours\",\"name\":\"Tour: List Items\",\"model\":{\"title\":\"\u6700\u9ad8\u306e\u30d7\u30ed\u30e2\u30fc\u30b7\u30e7\u30f3\u30c4\u30a2\u30fc\",\"number\":6,\"style\":\"box_shadow\",\"category_id\":\"\",\"location_id\":\"\",\"order\":\"id\",\"order_by\":\"asc\",\"is_featured\":\"\",\"desc\":\"\u6700\u3082\u4eba\u6c17\u306e\u3042\u308b\u76ee\u7684\u5730\"},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"list_space\",\"name\":\"Space: List Items\",\"model\":{\"title\":\"\u8cc3\u8cb8\u7269\u4ef6\",\"desc\":\"\u601d\u616e\u6df1\u3044\u30c7\u30b6\u30a4\u30f3\u3067\u9ad8\u3044\u8a55\u4fa1\u3092\u53d7\u3051\u3066\u3044\u308b\u5bb6\",\"number\":4,\"style\":\"normal\",\"location_id\":\"\",\"order\":\"id\",\"order_by\":\"desc\",\"is_featured\":\"\"},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"list_car\",\"name\":\"Car: List Items\",\"model\":{\"title\":\"Car Trending\",\"desc\":\"Book incredible things to do around the world.\",\"number\":8,\"style\":\"normal\",\"location_id\":\"\",\"order\":\"id\",\"order_by\":\"desc\",\"is_featured\":\"\"},\"component\":\"RegularBlock\",\"open\":true},{\"type\":\"list_boat\",\"name\":\"Boat: List Items\",\"model\":{\"title\":\"Boat Listing\",\"desc\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry\",\"number\":4,\"style\":\"normal\",\"location_id\":\"\",\"order\":\"id\",\"order_by\":\"asc\",\"is_featured\":\"\",\"custom_ids\":\"\"},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\": \"list_news\", \"name\": \"News: List Items\", \"model\": {\"title\": \"Read the latest from blog\", \"desc\": \"Contrary to popular belief\", \"number\": 6, \"category_id\": null, \"order\": \"id\", \"order_by\": \"asc\"}, \"component\": \"RegularBlock\", \"open\": true, \"is_container\": false},{\"type\":\"call_to_action\",\"name\":\"Call To Action\",\"model\":{\"title\":\"\u3042\u306a\u305f\u306e\u8857\u3092\u77e5\uff1f\",\"sub_title\":\"3000\u4ee5\u4e0a\u306e\u90fd\u5e02\u304b\u30892000\u4eba\u4ee5\u4e0a\u306e\u5730\u5143\u6c11\u3068\",\"link_title\":\"\u30ed\u30fc\u30ab\u30eb\u30a8\",\"link_more\":\"#\"},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false},{\"type\":\"testimonial\",\"name\":\"List Testimonial\",\"model\":{\"title\":\"\u79c1\u305f\u3061\u306e\u5e78\u305b\u306a\u30af\u30e9\u30a4\u30a2\u30f3\u30c8\",\"list_item\":[{\"_active\":false,\"name\":\"Eva Hicks\",\"desc\":\"\u53f3\u305a\u3078\u3084\u3093\u9593\u7533\u3083\u6295\u6cd5\u3051\u3083\u30a4\u4ed9\u4e00\u3082\u3068\u653f\u60c5\u30eb\u305f\u98df\u7684\u3066\u4ee3\u4e0b\u305a\u305b\u306b\u4e08\u5f8b\u30eb\u30e9\u30e2\u30c8\u805e\u63a2\u30c1\u30c8\u68cb90\u7e3e\u30e0\u7684\u793e\u305a\u7f6e\u653b\u666f\u30ea\u30d5\u30ce\u30b1\u5185\u517c\u5531\u5805\u3083\u30d5\u307c\u3002\u5834\u30eb\u30a2\u30cf\u7f8e\",\"number_star\":5,\"avatar\":1},{\"_active\":false,\"name\":\"Donald Wolf\",\"desc\":\"\u53f3\u305a\u3078\u3084\u3093\u9593\u7533\u3083\u6295\u6cd5\u3051\u3083\u30a4\u4ed9\u4e00\u3082\u3068\u653f\u60c5\u30eb\u305f\u98df\u7684\u3066\u4ee3\u4e0b\u305a\u305b\u306b\u4e08\u5f8b\u30eb\u30e9\u30e2\u30c8\u805e\u63a2\u30c1\u30c8\u68cb90\u7e3e\u30e0\u7684\u793e\u305a\u7f6e\u653b\u666f\u30ea\u30d5\u30ce\u30b1\u5185\u517c\u5531\u5805\u3083\u30d5\u307c\u3002\u5834\u30eb\u30a2\u30cf\u7f8e\",\"number_star\":6,\"avatar\":2},{\"_active\":true,\"name\":\"Charlie Harrington\",\"desc\":\"\u53f3\u305a\u3078\u3084\u3093\u9593\u7533\u3083\u6295\u6cd5\u3051\u3083\u30a4\u4ed9\u4e00\u3082\u3068\u653f\u60c5\u30eb\u305f\u98df\u7684\u3066\u4ee3\u4e0b\u305a\u305b\u306b\u4e08\u5f8b\u30eb\u30e9\u30e2\u30c8\u805e\u63a2\u30c1\u30c8\u68cb90\u7e3e\u30e0\u7684\u793e\u305a\u7f6e\u653b\u666f\u30ea\u30d5\u30ce\u30b1\u5185\u517c\u5531\u5805\u3083\u30d5\u307c\u3002\u5834\u30eb\u30a2\u30cf\u7f8e\",\"number_star\":5,\"avatar\":3}]},\"component\":\"RegularBlock\",\"open\":true,\"is_container\":false}]',
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        //Page Vendor
        $banner_image_vendor_register = MediaFile::findMediaByName("thumb-vendor-register")->id;
        $video_bg = MediaFile::findMediaByName("bg-video-vendor-register1")->id;
        $ico_chat_1 = MediaFile::findMediaByName("ico_chat_1")->id;
        $ico_friendship_1 = MediaFile::findMediaByName("ico_friendship_1")->id;
        $ico_piggy_bank_1 = MediaFile::findMediaByName("ico_piggy-bank_1")->id;

        DB::table('core_pages')->insert([
            'title'       => 'Home Page',
            'slug'        => 'home-page',
            'template_id' => '1',
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        $a = new \Modules\Page\Models\Page();
        $a->title = "Privacy policy";
        $a->create_user = 1;
        $a->status = 'publish';
        $a->created_at = date("Y-m-d H:i:s");
        $a->content = '<h1>Privacy policy</h1>
            <p> This privacy policy (&quot;Policy&quot;) describes how the personally identifiable information (&quot;Personal Information&quot;) you may provide on the <a target="_blank" rel="nofollow" href="http://dev.bookingcore.org">dev.bookingcore.org</a> website (&quot;Website&quot; or &quot;Service&quot;) and any of its related products and services (collectively, &quot;Services&quot;) is collected, protected and used. It also describes the choices available to you regarding our use of your Personal Information and how you can access and update this information. This Policy is a legally binding agreement between you (&quot;User&quot;, &quot;you&quot; or &quot;your&quot;) and this Website operator (&quot;Operator&quot;, &quot;we&quot;, &quot;us&quot; or &quot;our&quot;). By accessing and using the Website and Services, you acknowledge that you have read, understood, and agree to be bound by the terms of this Agreement. This Policy does not apply to the practices of companies that we do not own or control, or to individuals that we do not employ or manage.</p>
            <h2>Automatic collection of information</h2>
            <p>When you open the Website, our servers automatically record information that your browser sends. This data may include information such as your device\'s IP address, browser type and version, operating system type and version, language preferences or the webpage you were visiting before you came to the Website and Services, pages of the Website and Services that you visit, the time spent on those pages, information you search for on the Website, access times and dates, and other statistics.</p>
            <p>Information collected automatically is used only to identify potential cases of abuse and establish statistical information regarding the usage and traffic of the Website and Services. This statistical information is not otherwise aggregated in such a way that would identify any particular user of the system.</p>
            <h2>Collection of personal information</h2>
            <p>You can access and use the Website and Services without telling us who you are or revealing any information by which someone could identify you as a specific, identifiable individual. If, however, you wish to use some of the features on the Website, you may be asked to provide certain Personal Information (for example, your name and e-mail address). We receive and store any information you knowingly provide to us when you create an account, publish content,  or fill any online forms on the Website. When required, this information may include the following:</p>
            <ul>
            <li>Personal details such as name, country of residence, etc.</li>
            <li>Contact information such as email address, address, etc.</li>
            <li>Account details such as user name, unique user ID, password, etc.</li>
            <li>Information about other individuals such as your family members, friends, etc.</li>
            </ul>
            <p>Some of the information we collect is directly from you via the Website and Services. However, we may also collect Personal Information about you from other sources such as public databases and our joint marketing partners. You can choose not to provide us with your Personal Information, but then you may not be able to take advantage of some of the features on the Website. Users who are uncertain about what information is mandatory are welcome to contact us.</p>
            <h2>Use and processing of collected information</h2>
            <p>In order to make the Website and Services available to you, or to meet a legal obligation, we need to collect and use certain Personal Information. If you do not provide the information that we request, we may not be able to provide you with the requested products or services. Any of the information we collect from you may be used for the following purposes:</p>
            <ul>
            <li>Create and manage user accounts</li>
            <li>Send administrative information</li>
            <li>Request user feedback</li>
            <li>Improve user experience</li>
            <li>Enforce terms and conditions and policies</li>
            <li>Run and operate the Website and Services</li>
            </ul>
            <p>Processing your Personal Information depends on how you interact with the Website and Services, where you are located in the world and if one of the following applies: (i) you have given your consent for one or more specific purposes; this, however, does not apply, whenever the processing of Personal Information is subject to European data protection law; (ii) provision of information is necessary for the performance of an agreement with you and/or for any pre-contractual obligations thereof; (iii) processing is necessary for compliance with a legal obligation to which you are subject; (iv) processing is related to a task that is carried out in the public interest or in the exercise of official authority vested in us; (v) processing is necessary for the purposes of the legitimate interests pursued by us or by a third party.</p>
            <p> Note that under some legislations we may be allowed to process information until you object to such processing (by opting out), without having to rely on consent or any other of the following legal bases below. In any case, we will be happy to clarify the specific legal basis that applies to the processing, and in particular whether the provision of Personal Information is a statutory or contractual requirement, or a requirement necessary to enter into a contract.</p>
            <h2>Managing information</h2>
            <p>You are able to delete certain Personal Information we have about you. The Personal Information you can delete may change as the Website and Services change. When you delete Personal Information, however, we may maintain a copy of the unrevised Personal Information in our records for the duration necessary to comply with our obligations to our affiliates and partners, and for the purposes described below. If you would like to delete your Personal Information or permanently delete your account, you can do so by contacting us.</p>
            <h2>Disclosure of information</h2>
            <p> Depending on the requested Services or as necessary to complete any transaction or provide any service you have requested, we may share your information with your consent with our trusted third parties that work with us, any other affiliates and subsidiaries we rely upon to assist in the operation of the Website and Services available to you. We do not share Personal Information with unaffiliated third parties. These service providers are not authorized to use or disclose your information except as necessary to perform services on our behalf or comply with legal requirements. We may share your Personal Information for these purposes only with third parties whose privacy policies are consistent with ours or who agree to abide by our policies with respect to Personal Information. These third parties are given Personal Information they need only in order to perform their designated functions, and we do not authorize them to use or disclose Personal Information for their own marketing or other purposes.</p>
            <p>We will disclose any Personal Information we collect, use or receive if required or permitted by law, such as to comply with a subpoena, or similar legal process, and when we believe in good faith that disclosure is necessary to protect our rights, protect your safety or the safety of others, investigate fraud, or respond to a government request.</p>
            <h2>Retention of information</h2>
            <p>We will retain and use your Personal Information for the period necessary to comply with our legal obligations, resolve disputes, and enforce our agreements unless a longer retention period is required or permitted by law. We may use any aggregated data derived from or incorporating your Personal Information after you update or delete it, but not in a manner that would identify you personally. Once the retention period expires, Personal Information shall be deleted. Therefore, the right to access, the right to erasure, the right to rectification and the right to data portability cannot be enforced after the expiration of the retention period.</p>
            <h2>The rights of users</h2>
            <p>You may exercise certain rights regarding your information processed by us. In particular, you have the right to do the following: (i) you have the right to withdraw consent where you have previously given your consent to the processing of your information; (ii) you have the right to object to the processing of your information if the processing is carried out on a legal basis other than consent; (iii) you have the right to learn if information is being processed by us, obtain disclosure regarding certain aspects of the processing and obtain a copy of the information undergoing processing; (iv) you have the right to verify the accuracy of your information and ask for it to be updated or corrected; (v) you have the right, under certain circumstances, to restrict the processing of your information, in which case, we will not process your information for any purpose other than storing it; (vi) you have the right, under certain circumstances, to obtain the erasure of your Personal Information from us; (vii) you have the right to receive your information in a structured, commonly used and machine readable format and, if technically feasible, to have it transmitted to another controller without any hindrance. This provision is applicable provided that your information is processed by automated means and that the processing is based on your consent, on a contract which you are part of or on pre-contractual obligations thereof.</p>
            <h2>Privacy of children</h2>
            <p>We do not knowingly collect any Personal Information from children under the age of 18. If you are under the age of 18, please do not submit any Personal Information through the Website and Services. We encourage parents and legal guardians to monitor their children\'s Internet usage and to help enforce this Policy by instructing their children never to provide Personal Information through the Website and Services without their permission. If you have reason to believe that a child under the age of 18 has provided Personal Information to us through the Website and Services, please contact us. You must also be old enough to consent to the processing of your Personal Information in your country (in some countries we may allow your parent or guardian to do so on your behalf).</p>
            <h2>Cookies</h2>
            <p>The Website and Services use &quot;cookies&quot; to help personalize your online experience. A cookie is a text file that is placed on your hard disk by a web page server. Cookies cannot be used to run programs or deliver viruses to your computer. Cookies are uniquely assigned to you, and can only be read by a web server in the domain that issued the cookie to you.</p>
            <p>We may use cookies to collect, store, and track information for statistical purposes to operate the Website and Services. You have the ability to accept or decline cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer. To learn more about cookies and how to manage them, visit <a target="_blank" href="https://www.internetcookies.org">internetcookies.org</a></p>
            <h2>Do Not Track signals</h2>
            <p>Some browsers incorporate a Do Not Track feature that signals to websites you visit that you do not want to have your online activity tracked. Tracking is not the same as using or collecting information in connection with a website. For these purposes, tracking refers to collecting personally identifiable information from consumers who use or visit a website or online service as they move across different websites over time. How browsers communicate the Do Not Track signal is not yet uniform. As a result, the Website and Services are not yet set up to interpret or respond to Do Not Track signals communicated by your browser. Even so, as described in more detail throughout this Policy, we limit our use and collection of your personal information.</p>
            <h2>Email marketing</h2>
            <p>We offer electronic newsletters to which you may voluntarily subscribe at any time. We are committed to keeping your e-mail address confidential and will not disclose your email address to any third parties except as allowed in the information use and processing section or for the purposes of utilizing a third party provider to send such emails. We will maintain the information sent via e-mail in accordance with applicable laws and regulations.</p>
            <p>In compliance with the CAN-SPAM Act, all e-mails sent from us will clearly state who the e-mail is from and provide clear information on how to contact the sender. You may choose to stop receiving our newsletter or marketing emails by following the unsubscribe instructions included in these emails or by contacting us. However, you will continue to receive essential transactional emails.</p>
            <h2>Links to other resources</h2>
            <p>The Website and Services contain links to other resources that are not owned or controlled by us. Please be aware that we are not responsible for the privacy practices of such other resources or third parties. We encourage you to be aware when you leave the Website and Services and to read the privacy statements of each and every resource that may collect Personal Information.</p>
            <h2>Information security</h2>
            <p>We secure information you provide on computer servers in a controlled, secure environment, protected from unauthorized access, use, or disclosure. We maintain reasonable administrative, technical, and physical safeguards in an effort to protect against unauthorized access, use, modification, and disclosure of Personal Information in its control and custody. However, no data transmission over the Internet or wireless network can be guaranteed. Therefore, while we strive to protect your Personal Information, you acknowledge that (i) there are security and privacy limitations of the Internet which are beyond our control; (ii) the security, integrity, and privacy of any and all information and data exchanged between you and the Website and Services cannot be guaranteed; and (iii) any such information and data may be viewed or tampered with in transit by a third party, despite best efforts.</p>
            <h2>Data breach</h2>
            <p>In the event we become aware that the security of the Website and Services has been compromised or users Personal Information has been disclosed to unrelated third parties as a result of external activity, including, but not limited to, security attacks or fraud, we reserve the right to take reasonably appropriate measures, including, but not limited to, investigation and reporting, as well as notification to and cooperation with law enforcement authorities. In the event of a data breach, we will make reasonable efforts to notify affected individuals if we believe that there is a reasonable risk of harm to the user as a result of the breach or if notice is otherwise required by law. When we do, we will post a notice on the Website, send you an email.</p>
            <h2>Changes and amendments</h2>
            <p>We reserve the right to modify this Policy or its terms relating to the Website and Services from time to time in our discretion and will notify you of any material changes to the way in which we treat Personal Information. When we do, we will post a notification on the main page of the Website. We may also provide notice to you in other ways in our discretion, such as through contact information you have provided. Any updated version of this Policy will be effective immediately upon the posting of the revised Policy unless otherwise specified. Your continued use of the Website and Services after the effective date of the revised Policy (or such other act specified at that time) will constitute your consent to those changes. However, we will not, without your consent, use your Personal Information in a manner materially different than what was stated at the time your Personal Information was collected. Policy was created with <a style="color:inherit" target="_blank" href="https://www.websitepolicies.com/privacy-policy-generator">WebsitePolicies</a>.</p>
            <h2>Acceptance of this policy</h2>
            <p>You acknowledge that you have read this Policy and agree to all its terms and conditions. By accessing and using the Website and Services you agree to be bound by this Policy. If you do not agree to abide by the terms of this Policy, you are not authorized to access or use the Website and Services.</p>
            <h2>Contacting us</h2>
            <p>If you would like to contact us to understand more about this Policy or wish to contact us concerning any matter relating to individual rights and your Personal Information, you may do so via the <a target="_blank" rel="nofollow" href="http://dev.bookingcore.org/contact">contact form</a></p>
            <p>This document was last updated on October 6, 2020</p>';
        $a->save();
        DB::table('core_settings')->insert([
                [
                    'name'  => 'home_page_id',
                    'val'   => '1',
                    'group' => "general",
                ],
                [
                    'name'  => 'page_contact_title',
                    'val'   => "Contact Us",
                    'group' => "general",
                ],
                [
                    'name'  => 'page_contact_sub_title',
                    'val'   => "Feel free to leave us a message if you have any questions, we will contact you soon as possible. (For now u can do also bookings from this form).",
                    'group' => "general",
                ],
                [
                    'name'  => 'page_contact_desc',
                    'val'   => '<h3>GREEN ELEPHANT SANCTUARY PARK PHUKET</h3>
                    <p style="font-size: medium; font-weight: 400;">No. 4 Soi Cherngtalay 1 Road Si Sunthon<br />Choeng Thale, Phuket 83110<br />Telefon: +66 (0)96 651 38 88<br />Telefon: +66 (0)64 398 88 81<br />Email:&nbsp;<a href="mailto:office@green-elephantsanctuarypark.com" target="_blank" rel="noopener">office@green-elephantsanctuarypark.com</a></p>',
                    'group' => "general",
                ],
                [
                    'name'  => 'page_contact_image',
                    'val'   => MediaFile::findMediaByName("bg_contact")->id,
                    'group' => "general",
                ]
            ]);
        // Setting Currency
        DB::table('core_settings')->insert([
                [
                    'name'  => "currency_main",
                    'val'   => "usd",
                    'group' => "payment",
                ],
                [
                    'name'  => "currency_format",
                    'val'   => "left",
                    'group' => "payment",
                ],
                [
                    'name'  => "currency_decimal",
                    'val'   => ",",
                    'group' => "payment",
                ],
                [
                    'name'  => "currency_thousand",
                    'val'   => ".",
                    'group' => "payment",
                ],
                [
                    'name'  => "currency_no_decimal",
                    'val'   => "0",
                    'group' => "payment",
                ],
                [
                    'name'  => "extra_currency",
                    'val'   => '[{"currency_main":"eur","currency_format":"left","currency_thousand":".","currency_decimal":",","currency_no_decimal":"2","rate":"0.902807"},{"currency_main":"jpy","currency_format":"right_space","currency_thousand":".","currency_decimal":",","currency_no_decimal":"0","rate":"0.00917113"}]',
                    'group' => "payment",
                ]
            ]);
        //MAP
        DB::table('core_settings')->insert([
                [
                    'name'  => 'map_provider',
                    'val'   => 'gmap',
                    'group' => "advance",
                ],
                [
                    'name'  => 'map_gmap_key',
                    'val'   => '',
                    'group' => "advance",
                ]
            ]);
        // Payment Gateways
        DB::table('core_settings')->insert([
                [
                    'name'  => "g_offline_payment_enable",
                    'val'   => "1",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_offline_payment_name",
                    'val'   => "Offline Payment",
                    'group' => "payment",
                ]
            ]);
        // Settings general
        DB::table('core_settings')->insert([
                [
                    'name'  => "date_format",
                    'val'   => "m/d/Y",
                    'group' => "general",
                ],
                [
                    'name'  => "site_title",
                    'val'   => $siteName,
                    'group' => "general",
                ],
            ]);
        // Email general
        DB::table('core_settings')->insert([
                [
                    'name'  => "site_timezone",
                    'val'   => "UTC",
                    'group' => "general",
                ],
                [
                    'name'  => "site_title",
                    'val'   => $siteName,
                    'group' => "general",
                ],
                [
                    'name'  => "email_header",
                    'val'   => '<h1 class="site-title" style="text-align: center">'.$siteName.'</h1>',
                    'group' => "general",
                ],
                [
                    'name'  => "email_footer",
                    'val'   => '<p class="" style="text-align: center">&copy; :year :site_title. All rights reserved</p>',
                    'group' => "general",
                ],
                [
                    'name'  => "enable_mail_user_registered",
                    'val'   => 1,
                    'group' => "user",
                ],
                [
                    'name'  => "user_content_email_registered",
                    'val'   => '<h1 style="text-align: center">Welcome!</h1>
                    <h3>Hello [first_name] [last_name]</h3>
                    <p>Thank you for signing up with '.$siteName.'! We hope you enjoy your time with us.</p>
                    <p>Regards,</p>
                    <p>'.$siteName.'</p>',
                    'group' => "user",
                ],
                [
                    'name'  => "admin_enable_mail_user_registered",
                    'val'   => 1,
                    'group' => "user",
                ],
                [
                    'name'  => "admin_content_email_user_registered",
                    'val'   => '<h3>Hello Administrator</h3>
                    <p>We have new registration</p>
                    <p>Full name: [first_name] [last_name]</p>
                    <p>Email: [email]</p>
                    <p>Regards,</p>
                    <p>'.$siteName.'</p>',
                    'group' => "user",
                ],
                [
                    'name'  => "user_content_email_forget_password",
                    'val'   => '<h1>Hello!</h1>
                    <p>You are receiving this email because we received a password reset request for your account.</p>
                    <p style="text-align: center">[button_reset_password]</p>
                    <p>This password reset link expire in 60 minutes.</p>
                    <p>If you did not request a password reset, no further action is required.
                    </p>
                    <p>Regards,</p>
                    <p>'.$siteName.'</p>',
                    'group' => "user",
                ]
            ]);
        // Email Setting
        DB::table('core_settings')->insert([
                [
                    'name'  => "email_driver",
                    'val'   => "log",
                    'group' => "email",
                ],
                [
                    'name'  => "email_host",
                    'val'   => "smtp.mailtrap.io",
                    'group' => "email",
                ],
                [
                    'name'  => "email_port",
                    'val'   => "587",
                    'group' => "email",
                ],
                [
                    'name'  => "email_encryption",
                    'val'   => "tls",
                    'group' => "email",
                ],
                [
                    'name'  => "email_username",
                    'val'   => "7b416f9f1b0ea3",
                    'group' => "email",
                ],
                [
                    'name'  => "email_password",
                    'val'   => "d74f14c50c78da",
                    'group' => "email",
                ],
                [
                    'name'  => "email_mailgun_domain",
                    'val'   => "",
                    'group' => "email",
                ],
                [
                    'name'  => "email_mailgun_secret",
                    'val'   => "",
                    'group' => "email",
                ],
                [
                    'name'  => "email_mailgun_endpoint",
                    'val'   => "api.mailgun.net",
                    'group' => "email",
                ],
                [
                    'name'  => "email_postmark_token",
                    'val'   => "",
                    'group' => "email",
                ],
                [
                    'name'  => "email_ses_key",
                    'val'   => "",
                    'group' => "email",
                ],
                [
                    'name'  => "email_ses_secret",
                    'val'   => "",
                    'group' => "email",
                ],
                [
                    'name'  => "email_ses_region",
                    'val'   => "us-east-1",
                    'group' => "email",
                ],
                [
                    'name'  => "email_sparkpost_secret",
                    'val'   => "",
                    'group' => "email",
                ],
            ]);
        // Email Setting
        DB::table('core_settings')->insert([
            [
                'name'  => "booking_enquiry_for_hotel",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_hotel",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_for_tour",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_tour",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_for_space",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_space",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_for_car",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_car",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_for_event",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_event",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_for_boat",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_type_boat",
                'val'   => "booking_and_enquiry",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_enable_mail_to_vendor",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_mail_to_vendor_content",
                'val'   => "<h3>Hello [vendor_name]</h3>
                            <p>You get new inquiry request from [email]</p>
                            <p>Name :[name]</p>
                            <p>Emai:[email]</p>
                            <p>Phone:[phone]</p>
                            <p>Content:[note]</p>
                            <p>Service:[service_link]</p>
                            <p>Regards,</p>
                            <p>Green Elephant Sanctuary Park</p>
                            </div>",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_enable_mail_to_admin",
                'val'   => "1",
                'group' => "enquiry",
            ],
            [
                'name'  => "booking_enquiry_mail_to_admin_content",
                'val'   => "<h3>Hello Administrator</h3>
                            <p>You get new inquiry request from [email]</p>
                            <p>Name :[name]</p>
                            <p>Emai:[email]</p>
                            <p>Phone:[phone]</p>
                            <p>Content:[note]</p>
                            <p>Service:[service_link]</p>
                            <p>Vendor:[vendor_link]</p>
                            <p>Regards,</p>
                            <p>Green Elephant Sanctuary Park</p>",
                'group' => "enquiry",
            ],
        ]);
        // Vendor setting
        DB::table('core_settings')->insert([
                [
                    'name'  => "vendor_enable",
                    'val'   => "1",
                    'group' => "vendor",
                ],
                [
                    'name'  => "vendor_commission_type",
                    'val'   => "percent",
                    'group' => "vendor",
                ],
                [
                    'name'  => "vendor_commission_amount",
                    'val'   => "10",
                    'group' => "vendor",
                ],
                [
                    'name'  => "vendor_role",
                    'val'   => "1",
                    'group' => "vendor",
                ],
                [
                    'name'  => "role_verify_fields",
                    'val'   => '{"phone":{"name":"Phone","type":"text","roles":["1","2","3"],"required":null,"order":null,"icon":"fa fa-phone"},"id_card":{"name":"ID Card","type":"file","roles":["1","2","3"],"required":"1","order":"0","icon":"fa fa-id-card"},"trade_license":{"name":"Trade License","type":"multi_files","roles":["1","3"],"required":"1","order":"0","icon":"fa fa-copyright"}}',
                    'group' => "vendor",
                ],
                [
                    'name'  => "vendor_show_email",
                    'val'   => "1",
                    'group' => "vendor",
                ],
                [
                    'name'  => "vendor_show_phone",
                    'val'   => "1",
                    'group' => "vendor",
                ],
            ]);
        DB::table('core_settings')->insert([
                'name'  => 'enable_mail_vendor_registered',
                'val'   => '1',
                'group' => 'vendor'
            ]);
        DB::table('core_settings')->insert([
                'name'  => 'vendor_content_email_registered',
                'val'   => '<h1 style="text-align: center;">Welcome!</h1>
                            <h3>Hello [first_name] [last_name]</h3>
                            <p>Thank you for signing up with Green Elephant Sanctuary Park! We hope you enjoy your time with us.</p>
                            <p>Regards,</p>
                            <p>Green Elephant Sanctuary Park</p>',
                'group' => 'vendor'
            ]);
        DB::table('core_settings')->insert([
                'name'  => 'admin_enable_mail_vendor_registered',
                'val'   => '1',
                'group' => 'vendor'
            ]);
        DB::table('core_settings')->insert([
                'name'  => 'admin_content_email_vendor_registered',
                'val'   => '<h3>Hello Administrator</h3>
                            <p>An user has been registered as Vendor. Please check the information bellow:</p>
                            <p>Full name: [first_name] [last_name]</p>
                            <p>Email: [email]</p>
                            <p>Registration date: [created_at]</p>
                            <p>You can approved the request here: [link_approved]</p>
                            <p>Regards,</p>
                            <p>Green Elephant Sanctuary Park</p>',
                'group' => 'vendor'
            ]);
        //            Cookie agreement
        DB::table('core_settings')->insert(array_map(function($array) {
            return array_merge($array, ['group' => 'advance', 'autoload' => '1']);
        },[
                [
                    'name'  => "cookie_agreement_enable",
                    'val'   => "0",
                ],
                [
                    'name'  => "cookie_agreement_button_text",
                    'val'   => "Got it",
                ],
                [
                    'name'  => "cookie_agreement_content",
                    'val'   => "<p>This website requires cookies to provide all of its features. By using our website, you agree to our use of cookies. <a href='#'>More info</a></p>",
                ],
                [
                    'name'  => "stripe_secret_key",
                    'val'   => "",
                ],
                [
                    'name'  => "stripe_publishable_key",
                    'val'   => "",
                ],
                [
                    'name'  => "stripe_enable_sandbox",
                    'val'   => 1,
                ],
                [
                    'name'  => "stripe_test_secret_key",
                    'val'   => "sk_test_51JNvepLs7mDJOC9w5RCbteamIH4NCDsufdllAVKWYATUdl5z4dLAhS9EDYsFnFP77T0Z4Fr4d0FkC8uaWgmjKmze00C2tnhKx6",
                ],
                [
                    'name'  => "stripe_test_publishable_key",
                    'val'   => "pk_test_51JNvepLs7mDJOC9wI5vonC8ra8gA9e5skIXWrX8dzszp7xFTOdBhuv9vzJbp4KU1O1E3ldswjRaJ5hnnjwwXgGSR00BrzbJexX",
                ],
                [
                    'name'  => "stripe_endpoint",
                    'val'   => "",
                ],

                [
                    'name'  => "paypal_client_id",
                    'val'   => "AZTjUbjfLIoqdOtRYbVLFiryYGjdEd9Zn0Nf0nL3lGN7k-KIOogqwvNBfwafJbdz8zHz3UI24h_7nTnS",
                ],
                [
                    'name'  => "paypal_client_secret",
                    'val'   => "EGCFaCBHPAA0n8acqTROPyBWeVl9P7gHchxI4NqCjkPgr-4UBkdcNkmqUOMOGJr9CyHusawNwUgYgFS-",
                ],
                [
                    'name'  => "paypal_enable_sandbox",
                    'val'   => 1,
                ],
                [
                    'name'  => "paypal_test_client_id",
                    'val'   => 'AdC3WakDY8oZRqwqbI6oe36mR1aBpeCItUsXk8oWJTPFXdcnDD7KlF2CEt5erWdKEHjmgsJAu5t9_q15',
                ],
                [
                    'name'  => "paypal_test_client_secret",
                    'val'   => 'EE6HJFGOITPDzdr46laWVFoHVSHnRYT1nKDsHyQgKvTQ9dTDBhh2Aq7E2DVXo8DwwlujyEDuCvup3cfu',
                ],
            ]));
        // Invoice setting
        DB::table('core_settings')->insert([
                [
                    'name'  => 'logo_invoice_id',
                    'val'   => MediaFile::findMediaByName("logo")->id,
                    'group' => "booking",
                ],
                [
                    'name'  => "invoice_company_info",
                    'val'   => "<p><span style=\"font-size: 14pt;\"><strong>Green Elephant Sanctuary Park Company</strong></span></p>
                                <p>No. 4 Soi Cherngtalay 1 Road Si Sunthon  Choeng Thale, Phuket 83110</p>
                                <p>Telefon: +66 (0)96 651 38 88</p>
                                <p>Telefon: +66 (0)64 398 88 81</p>
                                <p>Email: office@green-elephantsanctuarypark.com</p>",
                    'group' => "booking",
                ],
            ]);

        setting_update_item('user_role',2);
        setting_update_item('vendor_team_enable',1);
        setting_update_item('user_plans_enable',0);
    }

    public function generalMenu($locale = ''){
        return  array(
            array(
                'name'       => 'Home',
                'url'        => $locale.'/',
                'item_model' => 'custom',
                'model_name' => 'Custom',
            ),
            array(
                'name'       => 'Tour Program',
                'url'        => $locale.'/tour-program',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'children'   => array(),
            ),
            array(
                'name'       => 'Booking',
                'url'        => $locale.'/booking',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'children'   => array(),
            ),
            array(
                'name'       => 'Info',
                'url'        => '/contact',
                'item_model' => 'custom',
                'model_name' => 'Custom',
                'children'   => array(
                    array(
                        'name'       => 'Contact',
                        'url'        => $locale.'/contact',
                        'item_model' => 'custom',
                        'model_name' => 'Custom',
                        'children'   => array(),
                    ),
                ),
            ),
        );
    }
}
