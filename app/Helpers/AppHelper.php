<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use Modules\Core\Models\Settings;
use App\Currency;
use Illuminate\Support\Facades\Cache;
use Modules\Page\Models\PageTranslation;
use Modules\Theme\ThemeManager;

//include '../../custom/Helpers/CustomHelper.php';

define( 'MINUTE_IN_SECONDS', 60 );
define( 'HOUR_IN_SECONDS', 60 * MINUTE_IN_SECONDS );
define( 'DAY_IN_SECONDS', 24 * HOUR_IN_SECONDS );
define( 'WEEK_IN_SECONDS', 7 * DAY_IN_SECONDS );
define( 'MONTH_IN_SECONDS', 30 * DAY_IN_SECONDS );
define( 'YEAR_IN_SECONDS', 365 * DAY_IN_SECONDS );

function setting_item($item,$default = '',$isArray = false){

    $res = Settings::item($item,$default);

    if($isArray and !is_array($res)){
        $res = (array) json_decode($res,true);
    }

    return $res;

}
function setting_item_array($item,$default = ''){

    return setting_item($item,$default,true);

}

function setting_item_with_lang($item,$locale = '',$default = '',$withOrigin = true){

    if(empty($locale)) $locale = app()->getLocale();

    if($withOrigin == false and $locale == setting_item('site_locale')){
        return $default;
    }

    if( empty(setting_item('site_locale'))
        OR empty(setting_item('site_enable_multi_lang'))
        OR  $locale == setting_item('site_locale')
    ) {
        $locale = '';
    }

    return Settings::item($item.($locale ? '_'.$locale : ''),$withOrigin ? setting_item($item,$default) : $default);
}
function setting_item_with_lang_raw($item,$locale = '',$default = ''){

    return setting_item_with_lang($item,$locale,$default,false);
}
function setting_update_item($item,$val, $group = ''){

    $s = Settings::where('name',$item)->first();
    if(empty($s)){
        $s = new Settings();
        $s->name = $item;
    }

    if(is_array($val) or is_object($val)) $val = json_encode($val);
    $s->val = $val;
    if (!empty($group)) {
        $s->group = $group;
    }
    $s->save();

    Cache::forget('setting_' . $item);

    return $s;
}

function app_get_locale($locale = false , $before = false , $after = false){
    if(app()->getLocale() != setting_item('site_locale')){
        return $locale ? $before.$locale.$after : $before.app()->getLocale().$after;
    }
    return '';
}

function format_money($price){

   return getAmountWithCurrency((float)$price);

}
function format_money_main($price){

   return getAmountWithCurrency((float)$price);

}

function currency_symbol(){

    /*$currency_main = get_current_currency('currency_main');

    $currency = Currency::getCurrency($currency_main);*/

    return getCurrencySymbol();
}

function generate_menu($location = '',$options = [])
{
    $options['walker'] = $options['walker'] ?? '\\Modules\\Core\\Walkers\\MenuWalker';

    $setting = json_decode(setting_item('menu_locations'),true);

    if(!empty($setting))
    {
        foreach($setting as $l=>$menuId){
            if($l == $location and $menuId){
                $menu = (new \Modules\Core\Models\Menu())->findById($menuId);
                $translation = $menu->translateOrOrigin(app()->getLocale());

                $walker = new $options['walker']($translation);
                if(!empty($translation)){
                    $walker->generate();
                }
            }
        }
    }
}

/**
 * Generate Primary Menu
 *
 * @return string
 */
function generate_primary_menu(): string
{
    return Cache::rememberForever('primary_menu_'.get_current_lang(), function () {
        $menuId = (int) Settings::item('primary_menu_id');
        if($menuId > 0)
        {
            $menu = (new \Modules\Core\Models\Menu())->findById($menuId);
            if (!$menu) {
                return '';
            }
            $translation = $menu->translateOrOrigin(app()->getLocale());
            return $translation ? ($translation->content?:'') : '';
        }
        return '';
    });
}


function generate_menu_by_id_or_slug($menu_id, $is_slug = 0, $options = [])
{
    $options['walker'] = $options['walker'] ?? '\\Modules\\Core\\Walkers\\MenuWalker';

    if ($is_slug) {
        $menu = (new \Modules\Core\Models\Menu())->where('slug', $menu_id)->first();
    } else {
        $menu = (new \Modules\Core\Models\Menu())->findById($menu_id);
    }

    if (!$menu) {
        return '';
    }
    $translation = $menu->translateOrOrigin(app()->getLocale());
    return $translation ? ($translation->content?:'') : '';
}

function generate_menu_by_slug($slug)
{
    $slug = strtolower($slug);
    return Cache::rememberForever($slug.'_'.get_current_lang(), function () use ($slug) {
        $menu = (new \Modules\Core\Models\Menu())->where('slug', $slug)->first();
        if (!$menu) {
            return '';
        }
        $translation = $menu->translateOrOrigin(app()->getLocale());
        return $translation ? ($translation->content?:'') : '';
    });
}


function set_active_menu($item){
    \Modules\Core\Walkers\MenuWalker::setCurrentMenuItem($item);
}

 function get_exceprt($string,$length=200,$more = "[...]"){
        $string=strip_tags($string);
        if(str_word_count($string)>0) {
            $arr=explode(' ',$string);
            $excerpt='';
            if(count($arr)>0) {
                $count=0;
                if($arr) foreach($arr as $str) {
                    $count+=strlen($str);
                    if($count>$length) {
                        $excerpt.= $more;
                        break;
                    }
                    $excerpt.=' '.$str;
                }
                }return $excerpt;
            }
}

function getDatefomat($value) {
    return \Carbon\Carbon::parse($value)->format('j F, Y');

}

function get_file_url($file_id,$size="thumb",$resize = true){
    if(empty($file_id)) return null;
    return \Modules\Media\Helpers\FileHelper::url($file_id,$size,$resize);
}

function get_file_details($file_id){
    if(empty($file_id)) return null;
    return \Modules\Media\Helpers\FileHelper::getMedisDetails($file_id);
}

function get_file_path_by_media_id($file_id) {
    if(empty($file_id)) return null;
    return \Modules\Media\Helpers\FileHelper::path($file_id);
}

function get_image_tag($image_id,$size = 'thumb',$options = []){
    $options = array_merge($options,[
       'lazy'=>true
    ]);

    $url = get_file_url($image_id,$size);

    if($url){
        $alt = $options['alt'] ?? '';
        $attr = '';
        $class= $options['class'] ?? '';
        if(!empty($options['lazy'])){
            $class.=' lazy';
            $attr.=" data-src=".e($url)." ";
        }else{
            $attr.=" src='".e($url)."' ";
        }
        return sprintf("<img class='%s' %s alt='%s'>",e($class),e($attr),e($alt));
    }
}
function get_date_format(){
    return setting_item('date_format','m/d/Y');
}
function get_moment_date_format(){
    return php_to_moment_format(get_date_format());
}
function php_to_moment_format($format){

    $replacements = [
        'd' => 'DD',
        'D' => 'ddd',
        'j' => 'D',
        'l' => 'dddd',
        'N' => 'E',
        'S' => 'o',
        'w' => 'e',
        'z' => 'DDD',
        'W' => 'W',
        'F' => 'MMMM',
        'm' => 'MM',
        'M' => 'MMM',
        'n' => 'M',
        't' => '', // no equivalent
        'L' => '', // no equivalent
        'o' => 'YYYY',
        'Y' => 'YYYY',
        'y' => 'YY',
        'a' => 'a',
        'A' => 'A',
        'B' => '', // no equivalent
        'g' => 'h',
        'G' => 'H',
        'h' => 'hh',
        'H' => 'HH',
        'i' => 'mm',
        's' => 'ss',
        'u' => 'SSS',
        'e' => 'zz', // deprecated since version 1.6.0 of moment.js
        'I' => '', // no equivalent
        'O' => '', // no equivalent
        'P' => '', // no equivalent
        'T' => '', // no equivalent
        'Z' => '', // no equivalent
        'c' => '', // no equivalent
        'r' => '', // no equivalent
        'U' => 'X',
    ];
    $momentFormat = strtr($format, $replacements);
    return $momentFormat;
}

function display_date($time){

    if($time){
        if(is_string($time)){
            $time = strtotime($time);
        }

        if(is_object($time)){
            return $time->format(get_date_format());
        }
    }else{
       $time=strtotime(today());
    }

    return date(get_date_format(),$time);
}

function display_datetime($time){

    if(is_string($time)){
        $time = strtotime($time);
    }

    if(is_object($time)){
        return $time->format(get_date_format().' H:i');
    }

    return date(get_date_format().' H:i',$time);
}

function human_time_diff($from,$to = false){

    if(is_string($from)) $from = strtotime($from);
    if(is_string($to)) $to = strtotime($to);

    if ( empty( $to ) ) {
        $to = time();
    }

    $diff = (int) abs( $to - $from );

    if ( $diff < HOUR_IN_SECONDS ) {
        $mins = round( $diff / MINUTE_IN_SECONDS );
        if ( $mins <= 1 ) {
            $mins = 1;
        }
        /* translators: Time difference between two dates, in minutes (min=minute). %s: Number of minutes */
        if($mins){
            $since =__(':num mins',['num'=>$mins]);
        }else{
            $since =__(':num min',['num'=>$mins]);
        }

    } elseif ( $diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS ) {
        $hours = round( $diff / HOUR_IN_SECONDS );
        if ( $hours <= 1 ) {
            $hours = 1;
        }
        /* translators: Time difference between two dates, in hours. %s: Number of hours */
        if($hours){
            $since =__(':num hours',['num'=>$hours]);
        }else{
            $since =__(':num hour',['num'=>$hours]);
        }

    } elseif ( $diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS ) {
        $days = round( $diff / DAY_IN_SECONDS );
        if ( $days <= 1 ) {
            $days = 1;
        }
        /* translators: Time difference between two dates, in days. %s: Number of days */
        if($days){
            $since =__(':num days',['num'=>$days]);
        }else{
            $since =__(':num day',['num'=>$days]);
        }

    } elseif ( $diff < MONTH_IN_SECONDS && $diff >= WEEK_IN_SECONDS ) {
        $weeks = round( $diff / WEEK_IN_SECONDS );
        if ( $weeks <= 1 ) {
            $weeks = 1;
        }
        /* translators: Time difference between two dates, in weeks. %s: Number of weeks */
        if($weeks){
            $since =__(':num weeks',['num'=>$weeks]);
        }else{
            $since =__(':num week',['num'=>$weeks]);
        }

    } elseif ( $diff < YEAR_IN_SECONDS && $diff >= MONTH_IN_SECONDS ) {
        $months = round( $diff / MONTH_IN_SECONDS );
        if ( $months <= 1 ) {
            $months = 1;
        }
        /* translators: Time difference between two dates, in months. %s: Number of months */

        if($months){
            $since =__(':num months',['num'=>$months]);
        }else{
            $since =__(':num month',['num'=>$months]);
        }

    } elseif ( $diff >= YEAR_IN_SECONDS ) {
        $years = round( $diff / YEAR_IN_SECONDS );
        if ( $years <= 1 ) {
            $years = 1;
        }
        /* translators: Time difference between two dates, in years. %s: Number of years */
        if($years){
            $since =__(':num years',['num'=>$years]);
        }else{
            $since =__(':num year',['num'=>$years]);
        }
    }

    return $since;
}

function human_time_diff_short($from,$to = false){
    if(!$to) $to = time();
    $today = strtotime(date('Y-m-d 00:00:00',$to));

    $diff = $from - $to;

    if($from > $today){
        return date('h:i A',$from);
    }

    if($diff < 5* DAY_IN_SECONDS){
        return date('D',$from);
    }

    return date('M d',$from);
}

function _n($l,$m,$count){
    if($count){
        return $m;
    }
    return $l;
}
function get_country_lists(){
    $countries = array
    (
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua And Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia And Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Congo, Democratic Republic',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote D\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island & Mcdonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic Of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle Of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States Of',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory, Occupied',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts And Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre And Miquelon',
        'VC' => 'Saint Vincent And Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome And Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia And Sandwich Isl.',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard And Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad And Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks And Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis And Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe',
    );
    return $countries;
}

function get_country_name($name){
    $all = get_country_lists();

    return $all[$name] ?? $name;
}

function get_page_url($page_id)
{
    $page = \Modules\Page\Models\Page::find($page_id);

    if($page){
        return $page->getDetailUrl();
    }
    return false;
}

function get_payment_gateway_obj($payment_gateway){

    $gateways = get_payment_gateways();

    if(empty($gateways[$payment_gateway]) or !class_exists($gateways[$payment_gateway]))
    {
        return false;
    }

    $gatewayObj = new $gateways[$payment_gateway]($payment_gateway);

    return $gatewayObj;

}

function recaptcha_field($action){
    return \App\Helpers\ReCaptchaEngine::captcha($action);
}

function add_query_arg($args,$uri = false) {

    if(empty($uri)) $uri = request()->url();

    $query = request()->query();

    if(!empty($args)){
        foreach ($args as $k=>$arg){
            $query[$k] = $arg;
        }
    }

    return $uri.'?'.http_build_query($query);
}

function is_default_lang($lang = '')
{
    return is_current_lang_default_lang($lang);
}

function get_default_lang()
{
    $locale = setting_item('site_locale');

    return in_array($locale, get_language_codes()) ? $locale : config('app.locale');
}

function get_current_lang($lang = '') {

    if(!$lang) $lang = request()->query('lang');
//    if(!$lang) $lang = request()->route('lang');

    if (in_array($lang, get_language_codes())) {
        return $lang;
    }

    return has_locale_session() ? get_locale_session() : get_default_lang();
}

function get_admin_default_lang()
{
    if (request()->input('lang') == '') {
        return get_default_lang();
    }

    return get_current_lang();
}

function is_current_lang_default_lang($lang = ''): bool
{
    return get_current_lang($lang) === get_default_lang();
}

function has_admin_default_lang(): bool
{
    if (request()->input('lang') == get_default_lang() || request()->input('lang') == '') {
        return true;
    }
    return get_current_lang() === get_default_lang();
}

function get_active_languages()
{
    return Cache::rememberForever('site_all_languages', function () {
        return \Modules\Language\Models\Language::where('status', 'publish')->get();
    });
}

function get_language_codes(): array
{
    $codes = [];
    foreach (get_active_languages() as $language) {
        $codes[] = $language->locale;
    }
    return $codes;
}

function get_language_codes_except_default(): array
{
    return array_filter(get_language_codes(), function ($locale) {
        return $locale != get_default_lang();
    });
}


function get_lang_switcher_url($locale = false){

    $request =  request();
    $data = $request->query();
    $data['set_lang'] = $locale;

    $url = url()->current();

    $url.='?'.http_build_query($data);

    return url($url);
}
function get_currency_switcher_url($code = false){

    $request =  request();
    $data = $request->query();
    $data['set_currency'] = $code;

    $url = url()->current();

    $url.='?'.http_build_query($data);

    return url($url);
}


function translate_or_origin($key,$settings = [],$locale = '')
{
    if(empty($locale)) $locale = request()->query('lang');

    if($locale and $locale == setting_item('site_locale')) $locale = false;

    if(empty($locale)) return $settings[$key] ?? '';
    else{
        return $settings[$key.'_'.$locale] ?? '';
    }
}

function get_bookable_services(){

    $all = [];

    // Modules
    $custom_modules = \Modules\ServiceProvider::getActivatedModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $moduleData){
            $moduleClass = $moduleData['class'];
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getBookableServices']);
                $all = array_merge($all,$services);
            }

        }
    }


    // Plugin Menu
    $plugins_modules = \Plugins\ServiceProvider::getModules();
    if(!empty($plugins_modules)){
        foreach($plugins_modules as $module){
            $moduleClass = "\\Plugins\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getBookableServices']);
                $all = array_merge($all,$services);
            }
        }
    }

    // Custom Menu
    $custom_modules = \Custom\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getBookableServices']);
                $all = array_merge($all,$services);
            }
        }
    }
    return $all;
}
function get_payable_services(){
    $all = get_bookable_services();

    // Modules
    $custom_modules = \Modules\ServiceProvider::getActivatedModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $moduleData){
            $moduleClass = $moduleData['class'];
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getPayableServices']);
                $all = array_merge($all,$services);
            }

        }
    }

    return $all;
}
function get_bookable_service_by_id($id){

    $all = get_bookable_services();

    return $all[$id] ?? null;
}

function file_get_contents_curl($url,$isPost = false,$data = []) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    if($isPost){
        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function size_unit_format($number=''){
    switch (setting_item('size_unit')){
        case "m2":
            return $number." m<sup>2</sup>";
            break;
        default:
            return $number." ".__('sqft');
            break;
    }
}

function get_payment_gateways(){
    //getBlocks
    $gateways = config('booking.payment_gateways');
    // Modules
    $custom_modules = \Modules\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Modules\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $gateway = call_user_func([$moduleClass,'getPaymentGateway']);
                if(!empty($gateway)){
                    $gateways = array_merge($gateways,$gateway);
                }
            }
        }
    }
    //Plugin
    $plugin_modules = \Plugins\ServiceProvider::getModules();
    if(!empty($plugin_modules)){
        foreach($plugin_modules as $module){
            $moduleClass = "\\Plugins\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $gateway = call_user_func([$moduleClass,'getPaymentGateway']);
                if(!empty($gateway)){
                    $gateways = array_merge($gateways,$gateway);
                }
            }
        }
    }

    //Custom
    $custom_modules = \Custom\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $gateway = call_user_func([$moduleClass,'getPaymentGateway']);
                if(!empty($gateway)){
                    $gateways = array_merge($gateways,$gateway);
                }
            }
        }
    }
    return $gateways;
}

function get_current_currency($need,$default = '')
{
    return Currency::getCurrent($need,$default);
}

function booking_status_to_text($status)
{
    switch ($status){
        case "draft":
            return __('Draft');
            break;
        case "unpaid":
            return __('Unpaid');
            break;
        case "paid":
            return __('Paid');
            break;
        case "processing":
            return __('Processing');
            break;
        case "completed":
            return __('Completed');
            break;
        case "confirmed":
            return __('Confirmed');
            break;
        case "cancelled":
            return __('Cancelled');
            break;
        case "cancel":
            return __('Cancel');
            break;
        case "pending":
            return __('Pending');
            break;
        case "partial_payment":
            return __('Partial Payment');
            break;
        case "fail":
            return __('Failed');
            break;
        default:
            return ucfirst($status ?? '');
            break;
    }
}
function verify_type_to($type,$need = 'name')
{
    switch ($type){
        case "phone":
            return __("Phone");
            break;
        case "number":
            return __("Number");
            break;
        case "email":
            return __("Email");
            break;
        case "file":
            return __("Attachment");
            break;
        case "multi_files":
            return __("Multi Attachments");
            break;
        case "text":
        default:
            return __("Text");
            break;
    }
}

function get_all_verify_fields(){
    return setting_item_array('role_verify_fields');
}
/*Hook Functions*/
function add_action($hook, $callback, $priority = 20, $arguments = 1){
    return \Modules\Core\Facades\Hook::addAction($hook, $callback, $priority, $arguments);
}
function add_filter($hook, $callback, $priority = 20, $arguments = 1){
    return \Modules\Core\Facades\Hook::addFilter($hook, $callback, $priority, $arguments);
}
function do_action(){
    return \Modules\Core\Facades\Hook::action(...func_get_args());
}
function apply_filters(){
    return \Modules\Core\Facades\Hook::filter(...func_get_args());
}
function is_installed(){
    return file_exists(storage_path('installed'));
}
function is_enable_multi_lang(){
    return (bool) setting_item('site_enable_multi_lang');
}

function is_enable_language_route(){
    return (is_installed() and is_enable_multi_lang() and app()->getLocale() != setting_item('site_locale'));
}

function duration_format($hour,$is_full = false)
{
    $day = floor($hour / 24) ;
    $hour = $hour % 24;
    $tmp = '';

    if($day) $tmp = $day.__('D');

    if($hour)
    $tmp .= $hour.__('H');

    if($is_full){
        $tmp = [];
        if($day){
            if($day > 1){
                $tmp[] = __(':count Days',['count'=>$day]);
            }else{
                $tmp[] = __(':count Day',['count'=>$day]);
            }
        }
        if($hour){
            if($hour > 1){
                $tmp[] = __(':count Hours',['count'=>$hour]);
            }else{
                $tmp[] = __(':count Hour',['count'=>$hour]);
            }
        }

        $tmp = implode(' ',$tmp);
    }

    return $tmp;
}
function is_enable_guest_checkout(){
    return setting_item('booking_guest_checkout');
}

function handleVideoUrl($string,$video_id = false)
{
    if($video_id && !empty($string)){
        parse_str( parse_url( $string, PHP_URL_QUERY ), $values );
        return $values['v'];
    }
    if (strpos($string, 'youtu') !== false) {
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $string, $matches);
        if (!empty($matches[0])) return "https://www.youtube.com/embed/" . e($matches[0]);
    }
    return $string;
}

function is_api(){
    return request()->segment(1) == 'api';
}

function is_demo_mode(){
    return env('DEMO_MODE',false);
}
function credit_to_money($amount){
    return $amount * setting_item('wallet_credit_exchange_rate',1);
}

function money_to_credit($amount,$roundUp = false){
    $res = $amount / setting_item('wallet_credit_exchange_rate',1);

    if($roundUp) return ceil($res);

    return $res;
}

function clean_by_key($object, $keyIndex, $children = 'children'){
    if(is_string($object)){
        return clean($object);
    }

    if(is_array($object)){
        if(isset($object[$keyIndex])){
            $newClean = clean($object[$keyIndex]);
            $object[$keyIndex] =  $newClean;
            if(!empty($object[$children])){
                $object[$children] = clean_by_key($object[$children], $keyIndex);
            }

        }else{
            foreach($object as $key => $oneObject){
                if(isset($oneObject[$keyIndex])){
                    $newClean = clean($oneObject[$keyIndex]);
                    $object[$key][$keyIndex] =  $newClean;
                }

                if(!empty($oneObject[$children])){
                    $object[$key][$children] = clean_by_key($oneObject[$children], $keyIndex);
                }
            }
        }

        return $object;
    }
    return $object;
}
function periodDate($startDate,$endDate,$day = true,$interval='1 day'){
    $begin = new \DateTime($startDate);
    $end = new \DateTime($endDate);
    if($day){
        $end = $end->modify('+1 day');
    }
    $interval = \DateInterval::createFromDateString($interval);
    $period = new \DatePeriod($begin, $interval, $end);
    return $period;
}

function _fixTextScanTranslations(){
    return __("Show on the map");
}


function is_admin(){
    if(!auth()->check()) return false;

    if(auth()->user()->hasPermissionTo('dashboard_access')) return true;
    return false;
}
function is_vendor(){
    if(!auth()->check()) return false;
    return true;
    }

function get_link_detail_services($services, $id,$action='edit'){
    if( \Route::has($services.'.admin.'.$action) ){
        return route($services.'.admin.'.$action, ['id' => $id]);
    }else{
        return '#';
    }

}

function get_link_vendor_detail_services($services, $id,$action='edit'){
    if( \Route::has($services.'.vendor.'.$action) ){
        return route($services.'.vendor.'.$action, ['id' => $id]);
    }else{
        return '#';
    }

}

function format_interval($d1, $d2 = ''){
    $first_date = new DateTime($d1);
    if(!empty($d2)){
        $second_date = new DateTime($d2);
    }else{
        $second_date = new DateTime();
    }


    $interval = $first_date->diff($second_date);

    $result = "";
    if ($interval->y) { $result .= $interval->format("%y years "); }
    if ($interval->m) { $result .= $interval->format("%m months "); }
    if ($interval->d) { $result .= $interval->format("%d days "); }
    if ($interval->h) { $result .= $interval->format("%h hours "); }
    if ($interval->i) { $result .= $interval->format("%i minutes "); }
    if ($interval->s) { $result .= $interval->format("%s seconds "); }

    return $result;
}
function generate_timezone_list()
    {
        static $regions = array(
            DateTimeZone::AFRICA,
            DateTimeZone::AMERICA,
            DateTimeZone::ANTARCTICA,
            DateTimeZone::ASIA,
            DateTimeZone::ATLANTIC,
            DateTimeZone::AUSTRALIA,
            DateTimeZone::EUROPE,
            DateTimeZone::INDIAN,
            DateTimeZone::PACIFIC,
        );

        $timezones = array();
        foreach( $regions as $region )
        {
            $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
        }

        $timezone_offsets = array();
        foreach( $timezones as $timezone )
        {
            $tz = new DateTimeZone($timezone);
            $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
        }

        // sort timezone by offset
        asort($timezone_offsets);

        $timezone_list = array();
        foreach( $timezone_offsets as $timezone => $offset )
        {
            $offset_prefix = $offset < 0 ? '-' : '+';
            $offset_formatted = gmdate( 'H:i', abs($offset) );

            $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

            $timezone_list[$timezone] = "$timezone (${pretty_offset})";
        }

        return $timezone_list;
    }

    function is_string_match($string,$wildcard){
        $pattern = preg_quote($wildcard,'/');
        $pattern = str_replace( '\*' , '.*', $pattern);
        return preg_match( '/^' . $pattern . '$/i' , $string );
    }
    function getNotify()
    {
        $checkNotify = \Modules\Core\Models\NotificationPush::query();
        if(is_admin()){
            $checkNotify->where(function($query){
                $query->where('for_admin',1);
                $query->orWhere('notifiable_id', Auth::id());
            });
        }else{
            $checkNotify->where('for_admin',0);
            $checkNotify->where('notifiable_id', Auth::id());
        }
        $notifications = $checkNotify->orderBy('created_at', 'desc')->limit(5)->get();
        $countUnread = $checkNotify->where('read_at', null)->count();
        return [$notifications,$countUnread];
    }

    function is_enable_registration(){
        return false;
    }
    function is_enable_vendor_team(){
        return false;
    }

    function is_enable_plan(){
        return setting_item('user_plans_enable') == true;
    }

    function selected($value, $newInput, $previousInput = '', $default = '') {
        if (isset($newInput)) {
            return $newInput == $value ? 'selected' : $default;
        }
        return $value == $previousInput ? 'selected' : $default;
    }

    function selected_array($value, $newInputArray, $previousInputArray = [], $default = '') {
        if (count($newInputArray) > 0) {
            return in_array($value, $newInputArray) ? 'selected' : $default;
        }
        return in_array($value, $previousInputArray) ? 'selected' : $default;
    }

    function checked($value, $newInput, $previousInput = '', $default = '') {
        if (isset($newInput)) {
            return $newInput == $value ? 'checked' : $default;
        }
        return $value == $previousInput ? 'checked' : $default;
    }

    function json_success_response($message = '', $data = [], $status = 1): \Illuminate\Http\JsonResponse
    {
        return response()->json(api_success_response($message, $data, $status));
    }

    function api_success_response($message = '', $data = [], $status = 1): array
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
    }

    function removeCookie($name) {
        if (isset($_COOKIE[$name])) {
            unset($_COOKIE[$name]);
            setcookie($name, null, -1, '/');
            return true;
        } else {
            return false;
        }
    }



    function get_creating_user($default = 1) {
        return request()->has('create_user') ? (int) request()->get('create_user') : 1;
    }



if (!function_exists('getDbWhereIn')) {
    function getDbWhereIn($table, $columns, $whereInColumns, $whereInValues, $join = '', $extraWhereClause='')
    {
        $values = implode(', ', array_map(function ($entry) {
            return '('.implode(',', array_map(function($val){return sprintf("'%s'", $val);}, $entry)).')';
        }, $whereInValues));

        $query = 'SELECT '.implode(',', $columns).' FROM '.$table.' ';
        $query .= $join. ' ';
        $query .= ' WHERE ('.implode(',', $whereInColumns).') IN ('.$values.') '.$extraWhereClause;

        return DB::select($query);
    }
}

if (!function_exists('updateDbWhereIn')) {
    function updateDbWhereIn($table, $setValues, $whereInColumns, $whereInValues, $join = '')
    {
        $values = implode(', ', array_map(function ($entry) {
            return '('.implode(',', array_map(function($val){return sprintf("'%s'", $val);}, $entry)).')';
        }, $whereInValues));

        $numItems = count($setValues);
        $i = 0;
        $valuesInQuery = '';
        foreach ($setValues as $key => $value) {
            $valuesInQuery.= $key."='".$value."'";
            if(++$i != $numItems) {
                $valuesInQuery.= ',';
            }
        }

        $query = 'UPDATE '.$table.' ';
        $query .= $join. ' ';
        $query .= ' SET '.$valuesInQuery;
        $query .= ' WHERE ('.implode(',', $whereInColumns).') IN ('.$values.')';

        return DB::update($query);
    }
}

if (!function_exists('deleteDbWhereIn')) {
    function deleteDbWhereIn($table, $whereInColumns, $whereInValues, $join = '')
    {
        $values = implode(', ', array_map(function ($entry) {
            return '('.implode(',', array_map(function($val){return sprintf("'%s'", $val);}, $entry)).')';
        }, $whereInValues));

        $query = 'DELETE FROM '.$table.' ';
        $query .= $join. ' ';
        $query .= ' WHERE ('.implode(',', $whereInColumns).') IN ('.$values.')';

        return DB::delete($query);
    }
}

if (!function_exists('dateInGlobalFormat')) {
    function dateInGlobalFormat($date = '')
    {
        if ($date == '') {
            return date('Y-m-d');
        }

        return date('Y-m-d', strtotime($date));
    }
}
if (!function_exists('isValidDate')) {
    function isValidDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
if (!function_exists('getDepositTypeReadable')) {
    function getDepositTypeReadable($depositType)
    {
        return $depositType == \Modules\Booking\Models\Booking::FULL_PAYMENT ? trans('Full Payment') : trans('Partial Payment');
    }
}

if (!function_exists('getPersonType')) {
    function getPersonType($personType)
    {
        switch ($personType) {
            case 'infant':
                return 'Infants';
            case 'child':
                return 'Children';
            default:
                return 'Adults';
        }
    }
}

if (!function_exists('getPriceFormat')) {
    function getPriceFormat($price)
    {
        return number_format((float) $price, 2);
    }
}

if (!function_exists('getInvoiceStorage')) {
    function getInvoiceStorage($path = '')
    {
        return public_path().DIRECTORY_SEPARATOR.getRelativeInvoiceStorage($path);
    }
}

if (!function_exists('getRelativeInvoiceStorage')) {
    function getRelativeInvoiceStorage($path = '')
    {
        return 'storage'.DIRECTORY_SEPARATOR.'invoice'.DIRECTORY_SEPARATOR.$path;
    }
}

if (!function_exists('getRelativeCancellationInvoiceStorage')) {
    function getRelativeCancellationInvoiceStorage($path = '')
    {
        return 'storage'.DIRECTORY_SEPARATOR.'cancelled_invoice'.DIRECTORY_SEPARATOR.$path;
    }
}

if (!function_exists('getInvoiceNoWithPrefix')) {
    function getInvoiceNoWithPrefix($invoiceNo = 0)
    {
        return '0000'.$invoiceNo;
    }
}

if (!function_exists('getCancellationInvoiceNoWithPrefix')) {
    function getCancellationInvoiceNoWithPrefix($invoiceNo = 0)
    {
        return '000'.$invoiceNo;
    }
}

if (!function_exists('avoidNewsLayouts')) {
    function avoidNewsLayouts()
    {
        return ['content_text', 'search_form', 'tag']; // category, recent_news,
    }
}


if (!function_exists('filterContentJson')) {
    function filterContentJson(&$json) {
        if (!empty($json)) {
            foreach ($json as $k => &$item) {
                if (!isset($item['type'])) {
                    unset($json[$k]);
                    continue;
                }
                $block = getBlockByType($item['type']);
                if (empty($block)) {
                    unset($json[$k]);
                    continue;
                }
                $item['is_container'] = $block['is_container'] ?? false;
                $item['component'] = $block['component'] ?? 'RegularBlock';
                if (isset($item['settings']))
                    unset($item['settings']);
                if (empty($item['model']))
                    $item['model'] = [];
                if (!empty($block['model'])) {
                    foreach ($block['model'] as $key => $val) {
                        if (!isset($item['model'][$key]))
                            $item['model'][$key] = $val;
                    }
                }
                if (!empty($item['children'])) {
                    filterContentJson($item['children']);
                }
            }
        }
        $json = array_values((array)$json);
    }
}
if (!function_exists('getBlockByType')) {
    function getBlockByType($type)
    {
        $all = getBlocks();
        if (!empty($all)) {
            foreach ($all as $block) {
                if ($type == $block['id'])
                    return $block;
            }
        }
        return false;
    }
}

if (!function_exists('getBlocks')) {
    function getBlocks()
    {
        $blocks = getAllBlocks();

        $res = [];
        foreach ($blocks as $block => $class) {
            if (!class_exists($class))
                continue;
            $obj = new $class();
            //if(!is_subclass_of($obj,"\\Module\\Template\\Block\\BaseBlock")) continue;
            $options = $obj->getOptions();
            $options['name'] = $obj->getName();
            $options['id'] = $block;
            $options['component'] = $obj->options['component'] ?? 'RegularBlock';
            parseBlockOptions($options);
            $res[] = $options;
        }
        return $res;
    }
}

if (!function_exists('parseBlockOptions')) {
    function parseBlockOptions(&$options)
    {

        $options['model'] = [];
        if (!empty($options['settings'])) {
            foreach ($options['settings'] as &$setting) {

                $setting['model'] = $setting['id'];
                $val = $setting['std'] ?? '';
                switch ($setting['type']) {
                    default:
                        break;
                }
                if (!empty($setting['multiple'])) {
                    $val = (array)$val;
                }
                $options['model'][$setting['id']] = $val;
            }
        }
    }
}

if (!function_exists('getAllBlocks')) {
    function getAllBlocks(){

        $blocks = config('template.blocks');
        // Modules
        $custom_modules = \Modules\ServiceProvider::getActivatedModules();

        if(!empty($custom_modules)){
            foreach($custom_modules as $module=>$moduleData){
                $moduleClass = $moduleData['class'];
                if(class_exists($moduleClass))
                {
                    $blockConfig = call_user_func([$moduleClass,'getTemplateBlocks']);
                    if(!empty($blockConfig)){
                        $blocks = array_merge($blocks,$blockConfig);
                    }
                }
            }
        }

        //Plugins
        $plugins_modules = \Plugins\ServiceProvider::getModules();
        if(!empty($plugins_modules)){
            foreach($plugins_modules as $module){
                $moduleClass = "\\Plugins\\".ucfirst($module)."\\ModuleProvider";
                if(class_exists($moduleClass))
                {
                    $blockConfig = call_user_func([$moduleClass,'getTemplateBlocks']);
                    if(!empty($blockConfig)){
                        $blocks = array_merge($blocks,$blockConfig);
                    }
                }
            }
        }

        //Custom
        $custom_modules = \Custom\ServiceProvider::getModules();
        if(!empty($custom_modules)){
            foreach($custom_modules as $module){
                $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
                if(class_exists($moduleClass))
                {
                    $blockConfig = call_user_func([$moduleClass,'getTemplateBlocks']);
                    if(!empty($blockConfig)){
                        $blocks = array_merge($blocks,$blockConfig);
                    }
                }
            }
        }
        $provider = ThemeManager::currentProvider();
        if(class_exists($provider)){
            $blockConfig = call_user_func([$provider,'getTemplateBlocks']);
            if(!empty($blockConfig)){
                $blocks = array_merge($blocks,$blockConfig);
            }
        }

        return $blocks;
    }
}

if (!function_exists('getDateInGermany')) {
    function getDateInGermany($date) {
        return date('d.m.Y', strtotime($date));
    }
}

if (!function_exists('getDateInThai')) {
    function getDateInThai($date) {
        return date('d/m/Y', strtotime($date));
    }
}

if (!function_exists('getDateInGlobalFormat')) {
    function getDateInGlobalFormat($date) {
        return date('Y-m-d', strtotime($date));
    }
}

if (!function_exists('checkLanguageCodeExist')) {
    function checkLanguageCodeExist($lang = '') {
        return in_array($lang, get_language_codes());
    }
}

if (!function_exists('getDateFormatAsLocale')) {

    function getDateFormatAsLocale($date, $lang = '') {
        $currentLang = in_array($lang, get_language_codes()) ? $lang : get_current_lang();
        if ($currentLang == 'de') {
            return getDateInGermany($date);
        }
        if ($currentLang == 'th') {
            return getDateInThai($date);
        }
        return getDateInGlobalFormat($date);
    }

}


if (!function_exists('getDateFormatOfBtDatePicker')) {

    function getDateFormatOfBtDatePicker() {
        $currentLang = get_default_lang();
        //dd($currentLang);
        if ($currentLang == 'de') {
            return 'DD.MM.YYYY';
        }
        if ($currentLang == 'th') {
            return 'DD/MM/YYYY';
        }
        return 'YYYY-MM-DD';
    }

}

if (!function_exists('getArrayFromString')) {

    function getArrayFromString($string) {
        if (is_array($string)) {
            return (array) $string;
        }

        if (is_string($string)) {
            $converted = json_decode($string, 1);
            if (is_string($converted)) {
                return getArrayFromString($converted);
            }

            return $converted;
        }

        return [];
    }

}


if (!function_exists('getPaypalLanguageCode')) {
    function getPaypalLanguageCode() {
        $currentLang = get_default_lang();
        if ($currentLang == 'de') {
            return 'de_DE';
        }
        if ($currentLang == 'th') {
            return 'th_TH';
        }
        return 'en_US';
    }
}


function getBookingVueConfig($additionConfig = []): array
{
    return array_merge([
        'getSearchBookingEventsUrl' => route('admin.booking.get_calendar_bookings'),
        'getDeleteBookingUrl' => route('admin.booking.delete_api'),
        'getToursByDateUrl' => route('bookings.tour.get_tours_by_date'),
        'getToursByDateInBookingEditUrl' => route('bookings.tour.get_tours_by_date_edit'),
        'getTourDiscountUrl' => route('tour.get_tour_discount'),
        'getRegisterBookingUrl' => route('admin.booking.register_api'),
        'getUpdateBookingUrl' => route('admin.booking.update_api'),
        'defaultPaymentGateway' => \Modules\Booking\Models\Booking::DEFAULT_PAYMENT,
        'defaultPaymentDepositType' => \Modules\Booking\Models\Booking::FULL_PAYMENT,
        'defaultDiscountType' => \Modules\Tour\Models\TourDiscount::DEFAULT_DISCOUNT,
        'getPaymentGateways' => \Modules\Booking\Models\Booking::getPaymentGatewaysDetail(),
        'getPaymentDepositTypes' => \Modules\Booking\Models\Booking::getPaymentDepositTypeDetails(),
        'getCouponDetailUrl' => route('booking.tour.set_coupon'),
        'getHotels' => TourHotel::where('status', 'publish')->get(),
        'getTransports' => TourTransport::where('status', 'publish')->get(),
        'getCountries' => get_country_lists(),
        'getMapDetail' => setting_item_with_lang("map"),
        'getSiteAddress' => setting_item_with_lang("address"),
        'getCurrencySymbol' => getCurrencySymbol(),
    ], $additionConfig);
}


if (! function_exists('getUserRoleName')) {
    function getUserRoleName() {
        if (auth()->check()) {
            $roles = auth()->user()->getRoleNames();
            if (count($roles)) {
                return $roles[0];
            }
        }
        return \App\User::DEFAULT_USER_GROUP;
    }
}


if (! function_exists('getUserRoleId')) {
    function getUserRoleId() {
        if (auth()->check()) {
            $roles = auth()->user()->roles;
            if (count($roles)) {
                return $roles->first()->id;
            }
        }

        return getGuestUserId();
    }
}

if (! function_exists('getGuestUserId')) {
    function getGuestUserId() {

        if(\Illuminate\Support\Facades\Session::has('guest_role_id')) {
            return \Illuminate\Support\Facades\Session::get('guest_role_id');
        }

        $role = \Spatie\Permission\Models\Role::where('is_guest', 1)->first();


        if ($role) {
            \Illuminate\Support\Facades\Session::put('guest_role_id', $role->id);
            return \Illuminate\Support\Facades\Session::get('guest_role_id');
        }

        \Illuminate\Support\Facades\Session::put('guest_role_id', 0);
        return \Illuminate\Support\Facades\Session::get('guest_role_id');
    }
}

if (! function_exists('getUserId')) {
    function getUserId() {
        if (auth()->check()) {
            return auth()->id();
        }
        return 0;
    }
}

if (! function_exists('getAmountWithCurrency')) {
    function getAmountWithCurrency($amount) {
        return priceToFloat($amount).' '.getCurrencySymbol();
    }
}

if (! function_exists('priceToFloat')) {
    function priceToFloat($s){
        // is negative number
        $neg = strpos((string)$s, '-') !== false;

        // convert "," to "."
        $s = str_replace(',', '.', $s);

        // remove everything except numbers and dot "."
        $s = preg_replace("/[^0-9\.]/", "", $s);

        // remove all seperators from first part and keep the end
        $s = str_replace('.', '',substr($s, 0, -3)) . substr($s, -3);

        // Set negative number
        if( $neg ) {
            $s = '-' . $s;
        }

        // return float
        return (float) $s;
    }
}


if (! function_exists('getCurrencyCode')) {
    function getCurrencyCode() {

        $currentLang = get_default_lang();
        if ($currentLang == 'de') {
            return 'EUR';
        }
        if ($currentLang == 'th') {
            return 'THB';
        }
        return 'EUR'; // USD
    }
}

if (! function_exists('getCurrencySymbol')) {
    function getCurrencySymbol() {
        return html_entity_decode('&#3647;')." (THB)"; // $
    }
}

if (! function_exists('getCurrencySymbolWithHtmlStyle')) {
    function getCurrencySymbolWithHtmlStyle() {
        return "<span style='font-family: DejaVu Sans;'>".html_entity_decode('&#3647;')."</span> (THB)"; // $
    }
}

if (! function_exists('getCurrencyText')) {
    function getCurrencyText() {
        return "THB"; // $
    }
}


if (! function_exists('VueLaravelLocaleArrayData')) {

    function VueLaravelLocaleArrayData() {
        return [
            'default_locale' => get_current_lang(),
            'fallback_locale' => config('app.fallback_locale'),
            'messages_locale' => \Custom\Helpers\Traits\LocaleExporter::getLocaleInArray(),
        ];
    }
}


if (! function_exists('getCurrencyCodeForPayment')) {
    function getCurrencyCodeForPayment() {
        return config('app.payment_currency_code');
    }
}

if (! function_exists('getMemberText')) {
    function getMemberText($member): string
    {
        if ($member == 'infant') {
            return 'Infants';
        }
        if ($member == 'child') {
            return 'Children';
        }
        if ($member == 'adult') {
            return 'Adults';
        }
        return '';
    }
}


if (! function_exists('isValidTime')) {
    function isValidTime($time, $format='H:i') {
        $d = DateTime::createFromFormat("Y-m-d $format", "2017-12-01 $time");
        return $d && $d->format($format) == $time;
    }
}


if (! function_exists('getReadableBookingStatus')) {
    function getReadableBookingStatus($status = 'completed')
    {
        if ($status == \Modules\Booking\Models\Booking::COMPLETED) {
            return 'Completed';
        }
        if ($status == \Modules\Booking\Models\Booking::PARTIALLY_PAID) {
            return 'Partial Payment';
        }
        if ($status == \Modules\Booking\Models\Booking::PENDING) {
            return 'Pending';
        }

        return $status;
    }
}



function isBookingCancelled($status): bool
{
    return $status == \Modules\Booking\Models\Booking::CANCELLED;
}

function isBookingCompleted($status): bool
{
    return $status == \Modules\Booking\Models\Booking::COMPLETED;
}

function isBookingPending($status): bool
{
    return $status == \Modules\Booking\Models\Booking::PENDING;
}

function isBookingPartiallyPaid($status): bool
{
    return $status == \Modules\Booking\Models\Booking::PARTIALLY_PAID;
}



if (! function_exists('generateUbCode')) {
    function generateUbCode()
    {
        return md5(uniqid() . rand(0, 99999));
    }
}

if (! function_exists('getCurrentDateTime')) {
    function getCurrentDateTime() {
        return date('Y-m-d H:i:s');
    }
}

if (! function_exists('startResponseTiming')) {
    function startResponseTiming($enableQueryLog = false) {
        if ($enableQueryLog) {
            DB::enableQueryLog();
        }
        Session::put('start_time', microtime(true));
    }
}

if (! function_exists('calculateResponseTiming')) {
    function calculateResponseTiming() {
        $startTime = (float) Session::get('start_time');
        $endTime = microtime(true);

        return ($endTime - $startTime);
    }
}

function get_locale_key(): string
{
    return 'ges_locale';
}

function has_locale_session(): bool
{
    return Session::has(get_locale_key());
}

function get_locale_session()
{
    return Session::get(get_locale_key());
}

function set_locale_session($locale)
{
    return Session::put(get_locale_key(), $locale);
}


function get_custom_frontend_routes() {
    return config('page.frontend_custom_routes');
}

function getMatchedFromPageUrls($url, $pageUrls) {

    foreach ($pageUrls as $pageUrl) {
        if ($pageUrl == trim(str_replace('/', '', $url))) {
            return $pageUrl;
        }
    }

    return false;
}

function getHomePageUrl() {
    return is_default_lang() ? url('/') : url(get_current_lang());
}

function isHomePage(): bool
{
    return request()->is('/') || request()->is(get_current_lang()) || request()->is('home') || request()->is('de/home');
}

function isOnProduction(): bool
{
    return config('app.env') === 'production';
}

function getThumbExtensions(): array
{
    return config('media.thumb_extensions');
}

function getThumbSizes(): array
{
    return config('media.thumb_sizes');
}

function getAbsoluteImagePath(string $imagePath): string
{
    return public_path('uploads').DIRECTORY_SEPARATOR.$imagePath;
}


function generateThumbnail($filePath)
{
    $folderPath = dirname($filePath);
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $filename = pathinfo($filePath, PATHINFO_FILENAME);

    if (in_array($extension, getThumbExtensions())) {
        foreach (getThumbSizes() as $thumbSize) {
            $thumbImage = Image::make($filePath);
            $thumbImage->resize($thumbSize['width'], $thumbSize['height'], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($folderPath.'/'.$filename.$thumbSize['prefix'].'.'.$extension);
        }
    }
}

function deleteThumbnail($filePath)
{
    $folderPath = dirname($filePath);
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $filename = pathinfo($filePath, PATHINFO_FILENAME);

    if (in_array($extension, getThumbExtensions())) {
        foreach (getThumbSizes() as $thumbSize) {
            $thumbPath = $folderPath.'/'.$filename.$thumbSize['prefix'].'.'.$extension;
            if (\Illuminate\Support\Facades\File::exists($thumbPath)) {
                \Illuminate\Support\Facades\File::delete($thumbPath);
            }
        }
    }
}

function generateThumbnailImageSrcSetByMediaId($mediaId): array
{
    $filePath = get_file_path_by_media_id($mediaId);

    if (!$filePath) {
        return [
            'src' => '',
            'srcset' => '',
            'alt' => '',
        ];
    }

    $folderPath = dirname($filePath);
    $relativeFolder = str_replace(public_path('uploads'), '', $folderPath);
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $baseName = pathinfo($filePath, PATHINFO_FILENAME);

    $thumbSrcSet = '';
    $numItems = count(getThumbSizes());
    $i = 0;
    foreach (getThumbSizes() as $thumbSize) {
        $thumbSrcSet .= asset('uploads'.$relativeFolder.'/'.$baseName.$thumbSize['prefix'].'.'.$extension).' '.$thumbSize['width'].'w';
        if(++$i !== $numItems) {
            $thumbSrcSet .= ', ';
        }
    }

    return [
        'src' => asset('uploads'.$relativeFolder.'/'.$baseName.'.'.$extension),
        'srcset' => $thumbSrcSet,
        'alt' => $baseName.'.'.$extension
    ];
}

function generateThumbnailImageSrcForSlider($imageId, $imageName, $images): array
{
    $mainImageUrl = get_file_url($imageId,'full');

    $thumbSrcSet = '';
    $numItems = count($images);
    $i = 0;
    foreach ($images as $image) {
        $thumbSrcSet .= get_file_url($image['bg_image'],'full'). ' '.$image['viewport'].'w';
        if(++$i !== $numItems) {
            $thumbSrcSet .= ', ';
        }
    }

    return [
        'src' => $mainImageUrl,
        'srcset' => $thumbSrcSet,
        'alt' => $imageName
    ];
}


function getImagesUrlByIds($imageIds): array
{
    return \Modules\Media\Helpers\FileHelper::urlsByFileIds($imageIds);
}

function getShortcodeContentPath($slug, $content): string
{
    $folderPath = resource_path('views'.DIRECTORY_SEPARATOR.'shortcodes');
    $filePath = $folderPath.DIRECTORY_SEPARATOR.$slug.'.blade.php';
    if (config('app.shortcode_cache')) {
        if (!\Illuminate\Support\Facades\File::exists($filePath)) {
            if (!\Illuminate\Support\Facades\File::exists($folderPath)) {
                \Illuminate\Support\Facades\File::makeDirectory($folderPath);
            }
        }
    } else {
        file_put_contents($filePath, \Illuminate\Support\Facades\Blade::compileString($content));
    }
    return $filePath;
}

function getFormSchemaByType($type): array
{
    if ($type == \Modules\Form\Enums\FormTypes::clearing->name) {
        return App\Libraries\FormSchema\Form\ClearingForm::schema();
    }
    if ($type == \Modules\Form\Enums\FormTypes::crime_cleaning->name) {
        return App\Libraries\FormSchema\Form\CrimeCleaningForm::schema();
    }
    if ($type == \Modules\Form\Enums\FormTypes::painting->name) {
        return App\Libraries\FormSchema\Form\PaintingForm::schema();
    }
    if ($type == \Modules\Form\Enums\FormTypes::mover->name) {
        return App\Libraries\FormSchema\Form\MoverForm::schema();
    }
    return [];
}

function getOptionFromSchema($schema, $key, $value): string
{
    $options = [];
    $placeholder = false;
    foreach ($schema as $form) {
        if (!isset($form['name'])) {
            continue;
        }
        if ($form['name'] == $key) {
            $options = $form['options'] ?? [];
            $placeholder = isset($form['placeholder']) ? ($form['placeholder'] != '' ? $form['placeholder'] : false) : false;
            break;
        }
    }

    $html = '';

    if ($placeholder) {
        $html .= '<option>'.$placeholder.'</option>';
    }

    foreach ($options as $option) {
        $html .= '<option value="'.$option.'"'.($option == $value ? 'selected' : '').'>'.$option.'</option>';
    }
    return $html;
}

function getRadioImageOptionFromSchema($schema, $key, $value): string
{
    $options = [];
    $placeholder = false;
    foreach ($schema as $form) {
        if (!isset($form['name'])) {
            continue;
        }
        if ($form['name'] == $key) {
            $options = $form['options'] ?? [];
            $placeholder = isset($form['placeholder']) ? ($form['placeholder'] != '' ? $form['placeholder'] : false) : false;
            break;
        }
    }

    $html = '';

    if ($placeholder) {
        $html .= '<option>'.$placeholder.'</option>';
    }

    foreach ($options as $option) {
        if (isset($option['name'])) {
            $html .= '<option value="'.$option['name'].'"'.($option['name'] == $value ? 'selected' : '').'>'.$option['name'].'</option>';
        }

    }
    return $html;
}

function getMultiSelectImageOptionFromSchema($schema, $key, array $value): string
{
    $options = [];
    $placeholder = false;
    foreach ($schema as $form) {
        if (!isset($form['name'])) {
            continue;
        }
        if ($form['name'] == $key) {
            $options = $form['options'] ?? [];
            $placeholder = isset($form['placeholder']) ? ($form['placeholder'] != '' ? $form['placeholder'] : false) : false;
            break;
        }
    }

    $html = '';

    if ($placeholder) {
        $html .= '<option>'.$placeholder.'</option>';
    }

    foreach ($options as $option) {
        if (isset($option['name'])) {
            $html .= '<option value="'.$option['name'].'"'.(in_array($option['name'], $value) ? 'selected' : '').'>'.$option['name'].'</option>';
        }

    }
    return $html;
}


function getRadioOptionFromSchema($schema, $key, $value): string
{
    $options = [];

    foreach ($schema as $form) {
        if (!isset($form['name'])) {
            continue;
        }
        if ($form['name'] == $key) {
            $options = $form['options'] ?? [];
            break;
        }
    }

    $html = '';

    foreach ($options as $option) {
        $html .= '<input name="'.$key.'" type="radio" value="'.$option.'"'.($option == $value ? 'checked' : '').'/>'.'<label class="mr-15" for="'.$key.'_'.$option.'">'.$option.'</label>';
    }
    return $html;
}

function getFormPlaceholder($schema, $key) {
    $placeholder = '';
    foreach ($schema as $form) {
        if (!isset($form['name'])) {
            continue;
        }
        if ($form['name'] == $key) {
            $placeholder = $form['placeholder'] ?? '';
            break;
        }
    }
    return $placeholder;
}

function hasInput($input) {
    return $input != '' && $input !== null;
}

function getMoverFormFolderPath($path = ''): string
{
    return 'mover_form'.($path ? DIRECTORY_SEPARATOR.$path : '');
}

function getMoverFormFileName($formId): string
{
    return 'form_'.$formId.'.pdf';
}

function doesRelativePageLanguageExists($pageId): bool
{
    $languageSlugs = get_language_codes();
    $pageLanguageSlugs = [get_default_lang()];
    $pageLanguages = PageTranslation::select('locale')->where('origin_id', $pageId)->get();
    foreach ($pageLanguages as $pageLanguage) {
        if (in_array($pageLanguage->locale, $languageSlugs) && $pageLanguage->locale != '') {
            $pageLanguageSlugs[] = $pageLanguage->locale;
        }
    }
    return count(array_intersect($pageLanguageSlugs, $languageSlugs)) == count($languageSlugs);
}

function getAdminMail()
{
    return config('site.email');
}

function priceConvert($price)
{
    return number_format($price, 2, ',', '.');
}
