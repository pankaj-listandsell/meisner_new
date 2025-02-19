<?php
/**
 * Created by PhpStorm.
 * User: h2 gaming
 * Date: 7/3/2019
 * Time: 11:45 PM
 */
namespace Modules\Language\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Modules\FrontendController;
use Modules\Language\Models\Language;

class LanguageController extends FrontendController
{
    public function setLang(\Illuminate\Http\Request $request,$locale){

        $oldLocale = \App::getLocale();

        $path = $request->query('path');

        $this->setLocale($locale, $request);

        if(empty($path)){
            return redirect('/');
        }

        if(strpos($path,$oldLocale) === 0){
            return redirect(str_replace($oldLocale,$locale,$path));
        }
        return redirect($locale.'/'.$path);
    }

    public function setAdminLang(\Illuminate\Http\Request $request,$locale){

        if (in_array($locale, get_language_codes())) {
            Cookie::queue('bc_admin_locale', $locale, 60*24*365);// one year
            set_locale_session($locale);
        }

        return redirect()->back();

    }


    private function setLocale($locale, $request)
    {
        $lang = Language::where('locale',$locale)->first();

        if(empty($lang)){
            $locale = setting_item('site_locale');
        }

        $request->session()->put('website_locale', $locale);
//
//        return redirect(add_query_arg([
//            'set_lang'=>
//        ]))

    }

}
